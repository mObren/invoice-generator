<?php

namespace Database\Factories;

use App\Models\Invoice;
use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Invoice::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $collectionOfClients = Client::all()->pluck('id');
        foreach ($collectionOfClients as $id) {
            $clientsIds[] = $id;
        }
        return [
            'client_id' => array_rand(array_flip($clientsIds)),
            'date' => $this->faker->date(),
            'valute' => $this->faker->date(),
            'status' => rand(0, 1),


        ];
    }
}
