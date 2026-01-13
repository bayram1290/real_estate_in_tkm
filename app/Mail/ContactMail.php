<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Complaint;
use App\ComplaintDetail;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

	protected $mailData;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mailData)
    {
        $this->mailData = $mailData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $address = $this->mailData['email'];
        //if contact form is submitted
        if( isset( $this->mailData['firstname'] ) ){

            $subject = $this->mailData['subject'];
            $name = $this->mailData['firstname'] . ' ' . $this->mailData['lastname'];

            return $this->view('email.contact')
                ->from($address, $name)
                ->cc($address, $name)
                ->bcc($address, $name)
                ->replyTo($address, $name)
                ->subject($subject)
                ->with(['mail' => $this->mailData['message'] ])
                ->with('name', $name)
                ->with('email', $address);
        }else if( isset( $this->mailData['full_name'] ) ){
            //else if, send mail to the property owner in single living/commercial property page
            return $this->view('email.conactPropertyOwner')
                ->from($address, $this->mailData['full_name'])
                ->replyTo($address, $this->mailData['full_name'])
                ->subject($this->mailData['subject'])
                ->with([ 'subject' => $this->mailData['subject'] ])
                ->with([ 'mail' => $this->mailData['message'] ])
                ->with([ 'phone' => $this->mailData['phone'] ])
                ->with([ 'name' => $this->mailData['full_name'] ])
                ->with([ 'email' => $address ]);
        }else{
            //else, complaint form is submitted
            $subject = 'Уведомление: Новая жалоба отправлена от example.com';
            $message = Complaint::find($this->mailData['subject'])->pluck('ru')->first() . ': ' . ComplaintDetail::find($this->mailData['detail'])->pluck('ru')->first();

            return $this->view('email.complaintReport')
                ->from($address, $this->mailData['fullName'])
                ->subject($subject)
                ->with([ 'mail' => $message ])
                ->with('name', $this->mailData['fullName'])
                ->with('phone', $this->mailData['phone'])
                ->with('email', $address);
        }
        
    }
}
