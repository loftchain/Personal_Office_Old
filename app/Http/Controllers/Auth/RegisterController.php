<?php

namespace App\Http\Controllers\Auth;

use App\Mail\ConfirmRegistration;
use App\Traits\ChangeUserFieldTrait;
use App\Traits\SendDataServerTrait;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\UserHistoryFields;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Traits\Auth\RegistersUsers;
use phpDocumentor\Reflection\Types\Null_;
use ReCaptcha\ReCaptcha;
use App\Traits\CaptchaTrait;
use App\Traits\RegisterMailTrait;
use Illuminate\Support\Facades\Mail;
use GuzzleHttp\Client;
use App\Traits\RemoteHistoryTrait;
use App\Models\Conversion;


class RegisterController extends Controller
{
    use CaptchaTrait, RegisterMailTrait, ChangeUserFieldTrait, SendDataServerTrait;
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers, RemoteHistoryTrait;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $token = Input::get('code');
        $this->middleware('guest');

    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data, $subscription)
    {
        return Validator::make($data, [
            'email' => 'required|string|email|min:7|max:255|unique:users',
            'password' => ($subscription != true) ? 'required|alpha_num|min:3|max:255' : 'nullable',
            'g-recaptcha-response' => 'required'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\Models\User
     */

    protected function create(array $data)
    {
        $referred_by = Cookie::get('referred_by');
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/ref_log.txt', $referred_by . "\n");
        if (!User::find($referred_by)) $referred_by = null;

        $user = User::create([
            'email' => $data['email'],
            'password' => $data['password'],
            'referred_by' => $referred_by,
        ]);
        $conversion = Cookie::get('conversion');
        if ($conversion = Conversion::find($conversion)) {
            if ($conversion->user_id) {
                Conversion::create([
                    'user_id' => $user->id,
                    'link_id' => $conversion->link_id,
                    'user_agent' => $_SERVER['HTTP_USER_AGENT'],
                    'ip' => $_SERVER['REMOTE_ADDR'],
                ]);
            } else
                $conversion->update(['user_id' => $user->id]);
        }
        return $user;
    }

    protected function registration_history_make($user)
    {
        $r = [
            'user_id' => $user->id,
            'reg_email' => $user->email,
            'reg_pwd' => $user->password,
            'reg_at' => Carbon::now()
        ];
        UserHistoryFields::create($r);
        $this->remote_history($r, 'registration', null);
    }

    public function successRegister()
    {
        return view('auth.successful_registration');
    }

    public function resend($email)
    {
        $subscription = (Input::has('subscription')) ? true : false;
        $user = User::where('email', $email)->first();

        if ($user->reg_attempts == 5) {
            return response()->json(['reg_limit_exceeded' => trans('home/register.reg_limit_exceeded')]);
        }
        $this->thisConfirmationEmailSend($user, 3, $subscription);
        $user->reg_attempts++;
        $user->save();
        return response()->json(['resend' => Lang::get('controller/register.pwd_resent')]);
    }

    public function thisConfirmationEmailSend($data, $timeout, $subscription)
    {
        $regObj = $this->sendConfirmationEmail($data, $timeout, $subscription);

        for ($i = 0; $i < 4; $i++) {
            $timeout *= 3;
            if ($regObj['code'] != 200 || strlen($regObj['result']) < 10 || $regObj['jsonObj'] != json_decode($regObj['result'])) {
                Log::info('Connection failed, trying to reconnect');
                Log::info('Server respond with code: ' . $regObj['code']);
                Log::info('Result of curl operation: ' . $regObj['result']);
                Log::info('Session Id: ' . Session::getId());
                Log::info('Client`s ip: ' . $_SERVER['REMOTE_ADDR']);
                Log::info('Timeout value: ' . $timeout);
                Log::info('Iteration: ' . $i);

                if ($i == 3) {
                    $data->forceDelete();
                    return response()->json(['invalid_post_service' => Lang::get('auth.invalid_post_service')]);
                    break;
                } else {
                    $regObj = $this->sendConfirmationEmail($data, $timeout, $subscription);
                }
            } else {
                break;
            }
        }

        if (null === $regObj['jsonObj']) {
            Log::info('An error occured: jsonObj = null');
            $data->forceDelete();
            return response()->json(['smth_went_wrong' => Lang::get('auth.smth_went_wrong')]);
        }

        if (!empty($regObj['jsonObj']->error)) {
            Log::info('An error occured:' . $regObj['jsonObj']->error . ', code: ' . $regObj['code']);
            $data->forceDelete();
            return response()->json(['smth_went_wrong' => Lang::get('auth.smth_went_wrong')]);
        }
    }

    public function confirmation($token, $host)
    {


        return redirect((isset($_SERVER['HTTPS']) ? "https://" : "http://") . $host .
            '/login?token=' . $token);
    }


    protected function register(Request $request)
    {
        $subscription = (Input::has('subscription')) ? true : false;
        $input = $request->all();
        $validator = $this->validator($input,$subscription);

        $user = User::where('email', $input['email'])->first();
        if ($user) {
          $passwordIsVerified = password_verify($request['password'], $user->password);
          if ($user && $passwordIsVerified && $user->confirmed == 0) {
            if ($user->reg_attempts == 5) {
              return response()->json(['reg_limit_exceeded' => trans('home/register.reg_limit_exceeded')]);
            }
            $this->thisConfirmationEmailSend($user, 3, $subscription);
            $user->reg_attempts++;
            $user->save();
            return response()->json(['not_confirmed_resend' => Lang::get('auth.not_confirmed_resend')]);
          }
          if ($validator->fails()) {
            return response()->json(['validation_error' => $validator->errors()]);
          }
        } else {
          if ($validator->fails()) {
            return response()->json(['validation_error' => $validator->errors()]);
          }
          $data = $this->create($input)->toArray();
          $user = User::find($data['id']);
        }


        $data['token'] = str_random(10);
        $data['ip_token'] = 'ID:' . str_random(10) . $_SERVER['REMOTE_ADDR'];
        $user->token = $data['token'];
        $user->remember_token = str_random(32);
        $user->reg_attempts = 1;
        if ($subscription) {
          $user['password'] = str_random(10);
        }
//        $this->thisConfirmationEmailSend($user, 3,$subscription);
        $user->password = ($subscription) ? bcrypt($user['password']) : bcrypt($data['password']);
        $user->valid_step = 1;
        $request->session()->put('this_email', $data['email']);
        $user->save();
        Log::info($data['email']);
	      Mail::to($data['email'])->send(new ConfirmRegistration());
//        $this->registration_history_make($user);
        return response()->json(['success_register' => Lang::get('controller/register.pwd_sent'), 'email' => $data['email']]);
    }



}
