<?php

namespace App\Mail;

use App\Models\Product;
use Illuminate\Mail\Mailable;

class ProductCreatedMail extends Mailable
{
    public $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function build()
    {
        return $this->subject('New Product Created')
            ->view('emails.product_created');
    }
}
