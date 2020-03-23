<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Auth;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        //
        $this->data = $data;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
        if(Auth::user()) {
            
            $image = (public_path("/_profiles") . DIRECTORY_SEPARATOR . Auth::user()->image);
            
            return $this->view('emails.contactForm.contact-form')
                ->replyTo($this->data['email'])
                ->attach($image);

        } else {
            
            return $this->view('emails.contactForm.contact-form')
                ->replyTo($this->data['email']);
        }

        // return $this->markdown('emails.contactForm.contact-form');
    }


    //     public function build()
    // {
    //     $address = 'test@codebriefly.com';
    //     $name = 'Test Mail';
    //     $subject = 'Test Mail';
    //     return $this->view('emails.test-mail')
    //         ->from($address, $name)
    //         ->cc($address, $name)
    //         ->bcc($address, $name)
    //         ->replyTo($address, $name)
    //         ->subject($subject)
    //         ->with([
    //           'CustomOption' => 'CustomValue',
    //           'CustomOption' => 'CustomValue'
    //         ]);
    // }
}
