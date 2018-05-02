<?php

namespace Adtech\Application\Cms\Libraries\Firebase;

use GuzzleHttp\Client;

class Message
{
    private static $_instance = null;

    protected $domain = null;

    protected $appKey = null;

    protected $messageUrl = null;

    public static function getInstance()
    {
        if (null == self::$_instance) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    public function __construct()
    {
        $this->domain = config('site.firebase.domain');
        $this->appKey = config('site.firebase.app_key');
        $this->messageUrl = config('site.firebase.url_message');
    }

    public function send($data)
    {
        if (null == $this->domain || null == $this->appKey || null == $this->messageUrl) {
            return null;
        }

        $headers = [
            'Authorization' => 'key=' . $this->appKey
        ];

        $data['domain'] = $this->domain;

        $client = new Client();
        $response = $client->request("POST", $this->messageUrl, [
            'headers' => $headers,
            'form_params' => $data,
        ]);

        return $response->getBody();
    }
}