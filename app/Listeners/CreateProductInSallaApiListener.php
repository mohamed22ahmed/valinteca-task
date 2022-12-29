<?php

namespace App\Listeners;

use App\Jobs\CreateProductLocalDB;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Http;

class CreateProductInSallaApiListener
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
        $response = Http::withToken(env('SALLA_API_KEY'))
            ->post(env('SALLA_API_URL').'/products', [
                'sku' => $event->data['sku'].'5566',
                'name' => $event->data['name'],
                'price' => $event->data['price'],
                'description' => $event->data['description'],
                'main_image' => $event->data['new_image'],
                'product_type' => 'product'
            ]);
            
        dispatch(new CreateProductLocalDB($response->json()['data']));
    }
}
