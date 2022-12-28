<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SallaProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'salla:pull-products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'pull products data from Salla using their API and sync data';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // authenticate api
        // get Products
        // map on products to sync product in db
        
    }
}