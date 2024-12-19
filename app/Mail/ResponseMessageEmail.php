<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResponseMessageEmail extends Mailable
{
    use Queueable, SerializesModels;
    public User $user;
    public string $response;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $response)
    {
        $this->user = $user;
        $this->response = $response;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.respnse_message_email')
            ->from('hr@qaren.com', 'Qaren System');
    }
}
