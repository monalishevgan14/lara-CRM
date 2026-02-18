<?php

namespace App\Jobs;

use App\Models\Product;
use App\Mail\ProductCreatedMail;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;


class SendProductCreatedMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function handle(): void
    {
        info('Queue reached successfully');

        Mail::to('monalishevgan14@gmail.com')  // 👈 PUT YOUR EMAIL HERE
            ->send(new ProductCreatedMail($this->product));
    }
}
