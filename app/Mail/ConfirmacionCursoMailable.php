<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmacionCursoMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = "Confirmación de compra";
    public $msg;

    public function __construct($msg) {
        $this->msg = $msg;
    }

  
    public function build()
    {
        return $this->view('admin.inicio.email_confirmacion');
    }
}
