<?php

namespace App\Mail;

use App\Models\Customer;
use App\Models\Promotion;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PromotionMail extends Mailable
{
    use Queueable, SerializesModels;

    public $promotion;
    public $customer;
    public $subject;
    public $title;
    public $description;

    public function __construct(Customer $customer, Promotion $promotion)
    {
        $this->customer = $customer;
        $this->promotion = $promotion;
        $this->subject = 'Promosi Spesial untuk Anda!';
        $this->title = $promotion->title;
        $this->description = $promotion->description;
    }

    public function build()
    {
        return $this->subject($this->subject)
                    ->view('emails.promotion')
                    ->with([
                        'customer' => $this->customer,
                        'promotion' => $this->promotion,
                        'subject' => $this->subject,
                        'title' => $this->title,
                        'description' => $this->description
                    ]);
    }
}
