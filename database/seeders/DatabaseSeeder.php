<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Client;
use App\Models\Invoice;
use App\Models\Item;



class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //User::factory(2)->create();
        Client::factory(4)->create();
        Invoice::factory(6)->create();
        Item::factory(10)->create();
    }
}
