<?php

namespace Adtech\Application\Cms\Traits;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use ReCaptcha\ReCaptcha;

trait CaptchaTrait
{

    public function captchaCheck()
    {
        $response = Input::get('g-recaptcha-response');
        $remoteIp = Request::ip();
        $secret = config('site.google_recaptcha.secret');

        $reCaptcha = new ReCaptcha($secret);
        $response = $reCaptcha->verify($response, $remoteIp);

        if ($response->isSuccess()) {
            return true;
        }
        return false;
    }

}