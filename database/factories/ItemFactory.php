<?php

namespace Database\Factories;

use App\Models\Invoice;
use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Item::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $collectionOfIds = Invoice::all()->pluck('id');
        foreach ($collectionOfIds as $id) {
            $invoicesIds[] = $id;
        }
        return [
            'invoice_id' => array_rand(array_flip($invoicesIds)),
            'service' => $this->faker->jobTitle(),
            'price'=> $this->faker->randomFloat(2, 20, 9999999),
            'quantity' => rand(0, 100),
            'pdv' => 20
        ];
    }
}
