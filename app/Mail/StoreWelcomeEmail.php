<?php

namespace App\Mail;

use App\Models\Store;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StoreWelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;

    public Store $store;
    public string $password;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Store $store, $password)
    {
        $this->store = $store;
        $this->password = $password;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.store_welcome_email')
            ->from('hr@qaren.com', 'Qaren System');
    }
}
