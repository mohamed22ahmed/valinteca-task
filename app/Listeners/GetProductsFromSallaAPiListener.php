<?php

namespace App\Listeners;

use App\Jobs\SyncProductsWithLocalDB;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Http;

class GetProductsFromSallaAPiListener implements ShouldQueue
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
        $indx = 1;
        do{
            $response = Http::withToken(env('SALLA_API_KEY'))
                ->get(env('SALLA_API_URL').'/products?page='.$indx++);

            $results = $response->json();

            dispatch(new SyncProductsWithLocalDB($results['data']));
        }while($results['pagination']['count'] == 20);
    }
}
