<?php

namespace App\Mail;

use App\Models\ContactMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMessageMail extends Mailable
{
    use Queueable, SerializesModels;

    public ContactMessage $contact;

    public function __construct(ContactMessage $contact)
    {
        $this->contact = $contact;
    }

    public function build()
    {
        return $this->subject('📩 New Contact Form Submission')
            ->view('emails.contact-mail')->with([
                'first_name' => $this->contact->first_name,
                'last_name'  => $this->contact->last_name,
                'email'      => $this->contact->email,
                'phone'      => $this->contact->phone,
                'subject'    => $this->contact->subject,
                'user_message' => $this->contact->message,
            ]);
    }
}
