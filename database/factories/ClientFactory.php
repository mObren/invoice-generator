<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Client::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $collectionOfIds = User::all()->pluck('id');
        foreach ($collectionOfIds as $id) {
            $usersIds[] = $id;
        }
        return [
            'user_id' => array_rand(array_flip($usersIds)),
            'email' => $this->faker->safeEmail(),
            'company_name' => $this->faker->company(),
            'address' => $this->faker->streetAddress(),
            'city' => $this->faker->city(),
            'country' => $this->faker->country(),
            'registration_number' => rand(10000, 102002),
            'tax_number' => rand(100203, 999999),
            'zip_code' => rand(11000, 17000)

        ];
    }
}
