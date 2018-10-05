<?php

namespace App\Http\Controllers;

use App\Models\UserPersonalFields;
use App\Services\GeoService;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KycController extends Controller
{
    protected $geoService;

    public function __construct(GeoService $geoService)
    {
        $this->geoService = $geoService;
    }

    public function index()
    {
        $region = $this->geoService->getCurrentLocation();

        if ($region === 'RU') {
            return view('kyc.indexRu');
        }

        return view('kyc.index');
    }

    public function userUpdate(Request $request)
    {
        Auth::user()->update([
            'kyc_step' => 3,
            'kyc_token' => $request->token
        ]);

        return ['status' => 'ok'];
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        UserPersonalFields::where('user_id', $user->id)->update([
            'user_id' => $user->id,
            'name_surname' => $request->name_surname,
            'telegram' => $request->telegram,
            'promo' => $request->emergency_email,
            'permanent_address' => $request->permanent_address,
            'contact_number' => $request->contact_number,
            'date_place_birth' => $request->date_place_birth,
            'nationality' => $request->nationality,
            'source_of_funds' => $request->source_of_funds,
        ]);

        $user->update([
            'kyc_step' => 3
        ]);

        return [
            'kyc_success' => 'ok'
        ];
    }

    public function uploadImg(Request $request)
    {
        $user = Auth::user();
        $personal = UserPersonalFields::where('user_id', $user->id)->first();
        $path = $request->upl->store('public/uploads');
        $path = explode('/', $path);

        if ($personal){
            $imgPersonal = $personal->doc_img_path;
            $imgPersonal[] = $path[1] . '/' . $path[2];
            $personal->doc_img_path = $imgPersonal;
            $personal->save();
        }else{
            UserPersonalFields::create([
                'user_id' => $user->id,
                'doc_img_path' => [$path[1] . '/' . $path[2]],
            ]);
        }

        return [
            'status' => 'ok'
        ];
    }
}
