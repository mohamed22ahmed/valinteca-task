<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Http;

class UpdateProductInSallaApiListener
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
        Http::withToken(env('SALLA_API_KEY'))
            ->put(env('SALLA_API_URL').'/products/'.$event->data['id'], [
                'sku' => $event->data['sku'],
                'name' => $event->data['name'],
                'price.amount' => $event->data['price'],
                'description' => $event->data['description'],
                'main_image' => $event->data['new_image']
            ]);
    }
}
