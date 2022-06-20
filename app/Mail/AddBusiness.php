<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AddBusiness extends Mailable
{
    use Queueable, SerializesModels;

    protected $business;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($business)
    {
        //
        $this->business = $business;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('support@420finder.net')
                     ->subject('Your business has been created')
                     ->markdown('emails.business.add-business')
                     ->with('business', $this->business);
    }
}
