<?php

namespace App\Jobs;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SyncProductsWithLocalDB implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $data;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach($this->data as $record){
            Product::updateOrInsert(
                [
                    'id' => $record['id']
                ],
                [
                    'sku' => $record['sku'],
                    'name' => $record['name'] ?? 'name',
                    'price' => $record['price']['amount'],
                    'description' => $record['description'] ?? 'description',
                    'main_image' => $record['main_image'] ?? 'default.jpg',
                ]
            );
        }
    }
}
