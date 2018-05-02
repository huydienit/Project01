<?php

namespace Adtech\Application\Cms\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AdtechMailable extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var string
     */
    private $_viewFile = 'view.name';

    public function __construct()
    {
        //
    }

    /**
     * @param $viewFile
     * @return AdtechMailable
     */
    public function setViewFile($viewFile)
    {
        $this->_viewFile = $viewFile;
        return $this;
    }

    /**
     * @return string
     */
    public function getViewFile()
    {
        return $this->_viewFile;
    }

    public function build()
    {
        return $this->view($this->_viewFile);
//                        ->from($address, $name)
//                        ->cc($address, $name)
//                        ->bcc($address, $name)
//                        ->replyTo($address, $name)
//                        ->subject($subject);
    }
}