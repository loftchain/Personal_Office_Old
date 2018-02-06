<?php

namespace App\Http\Controllers\Lk;

use App\Http\Controllers\Controller;
use App\Models\Link;
use App\Services\Lk\LinksService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

#use App\Http\Requests;


class ReferalsController extends Controller
{
    /**
     * Экземпляр LinksService.
     * @var LinksService
     */
    protected $links;

    /**
     * ReferalsController constructor.
     * @param LinksService $links
     */
    public function __construct(LinksService $links)
    {
        $this->links = $links;
    }

    /**
     * Показать список всех реферальных ссылок пользователя, и статистику по ним.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|\Illuminate\Http\Response
     */
    public function index(Request $request)
    {
//        return view('lk.referals.list', [
//            'links' => $this->links->forUser($request->user()),
//            'affiliate_id' => $this->links->getUniqueAffiliate()
//        ]);
    }


    /**
     * Создание новой реферальной ссылки в ЛК
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'comment' => 'max:255',
            ]);

        if ($validator->fails()) {
            return response()->json(['validation_error' => $validator->errors()]);
        }

        Link::create([
            'affiliate_id' => str_random(10),
            'comment' => request('comment') ? request('comment') : '',
            'user_id' => auth()->id()
        ]);

        return response()->json(['ref_link_added' => trans('controller/register.pwd_sent')]);
    }

    /**
     * Удаление реферальной ссылки из ЛК (SoftDelete!)
     * @param Link $link
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete(Link $link)
    {

        $link->delete();

        return response()->json(['ref_link_deleted' => trans('controller/register.pwd_sent')]);

    }

}