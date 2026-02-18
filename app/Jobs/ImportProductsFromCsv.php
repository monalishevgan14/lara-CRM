<?php

namespace App\Jobs;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ImportProductsFromCsv implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $path;

    public function __construct($path)
    {
        $this->path = $path;
    }

    public function handle(): void
    {
        $file = Storage::get($this->path);
        $rows = array_map('str_getcsv', explode("\n", $file));

        foreach ($rows as $index => $row) {

            if ($index == 0) continue; // skip header

            if (count($row) < 3) continue;

            Product::create([
                'name' => $row[0],
                'price' => $row[1],
                'stock' => $row[2],
                'user_id' => 1
            ]);
        }
    }
}
