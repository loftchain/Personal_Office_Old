<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
Use Illuminate\Support\Facades\Log;
use App\Models\User;

class ValidateUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $user = User::find(Auth::id());
        switch ($user['valid_step']) {
            case 0:
                return redirect('logout');
                break;
            case 1:
                return redirect('agreement1');
                break;
            default:
                return $next($request);
                break;
        }
}}
