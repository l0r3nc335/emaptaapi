<?php

namespace App\Jobs;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class MailSendingJob extends Mailable
{
    /**
     * Create a new job instance.
     *
     * @return void
     */


    private $resetpasswordurl;
    private $websiteurl;
    private $bimageurl;

    public function __construct($resetpasswordurl, $websiteurl, $bimageurl)
    {

        $this->resetpasswordurl = $resetpasswordurl;
        $this->websiteurl = $websiteurl;
        $this->bimageurl = $bimageurl;
    }

    public function build()
    {
        return $this->view('emailpasswordreset',['link'=>$this->resetpasswordurl, 
            'websiteurl'=>$this->websiteurl, 'bimageurl'=>$this->bimageurl]);

        
    }
}
