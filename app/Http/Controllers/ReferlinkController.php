<?php
/**
 * Created by PhpStorm.
 * User: 4erk
 * Date: 19.12.2017
 * Time: 16:49
 */

namespace App\Http\Controllers;

use App\Models\Link;
use App\Models\Conversion;
use Illuminate\Http\Request;


class ReferlinkController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function linkReferal(Request $request, $refer = null)
    {
        if (!$request->hasCookie('referred_by') && $refer) {
//            if ($link = Link::where('affiliate_id', $refer)->firstOrFail()) {
            if ($link = Link::findOrFail($refer)) {
                $user = $link->user_id;
                $conversion = Conversion::create([
                    'user_id' => null,
                    'link_id' => $link->id,
                    'user_agent' => $_SERVER['HTTP_USER_AGENT'],
                    'ip' => $_SERVER['REMOTE_ADDR'],
                ]);
                return redirect(route('root'))
                    ->withCookie(cookie()->forever('referred_by', $user))
                    ->withCookie(cookie()->forever('conversion', $conversion->id));
            }
            return abort(404);
        }
        return redirect(route('root'));
    }
}