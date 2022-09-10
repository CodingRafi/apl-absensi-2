<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegisterMail extends Mailable
{
    use Queueable, SerializesModels;
    public $sekolah;
    public $user;
    public $yayasan;
    public $password;
    public $password_yayasan;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($sekolah, $user, $yayasan, $password, $password_yayasan)
    {
        $this->sekolah = $sekolah;
        $this->user = $user;
        $this->yayasan = $yayasan;
        $this->password = $password;
        $this->password_yayasan = $password_yayasan;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.index');
    }
}
