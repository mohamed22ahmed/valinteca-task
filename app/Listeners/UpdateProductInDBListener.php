<?php

namespace App\Listeners;

use App\Models\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateProductInDBListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        Product::find($event->data['id'])->update([
            'sku' => $event->data['sku'],
            'name' => $event->data['name'],
            'price' => $event->data['price'],
            'description' => $event->data['description'],
            'main_image' => $event->data['new_image']
        ]);
    }
}
