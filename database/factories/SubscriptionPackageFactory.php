<?php

namespace Database\Factories;

use Ant\Subscription\Models\SubscriptionPackage;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubscriptionPackageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SubscriptionPackage::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'name' => 'Test Subscription Package',
            'price' => 5,
            'subscription_identity' => 'member',
            // 'options' => '{"depositAmount": 100}',
            'options' => [
                // {"depositAmount": 100}
                'depositAmount' => 100,
            ],
        ];
    }
}
