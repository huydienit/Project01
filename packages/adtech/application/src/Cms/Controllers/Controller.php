<?php

namespace Adtech\Application\Cms\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Auth;

class Controller extends BaseController
{
    use ValidatesRequests;
    protected $user;

    public function __construct()
    {
        //
        $this->user = Auth::user();
        $email = $this->user ? $this->user->email : null;
        $id = Auth::id();
        $share = [
            'USER_LOGGED' => $this->user,
            'USER_LOGGED_EMAIL' => $email,
            'USER_LOGGED_ID' => $id,
            'group_name'  => config('site.group_name'),
            'template'  => config('site.desktop.template'),
            'skin'  => config('site.desktop.skin'),
            'mtemplate'  => config('site.mobile.template'),
            'mskin'  => config('site.mobile.skin'),
        ];
        view()->share($share);
    }
}
