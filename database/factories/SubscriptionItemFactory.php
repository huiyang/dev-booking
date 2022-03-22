<?php

namespace Database\Factories;

use Ant\Subscription\Models\SubscriptionItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubscriptionItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SubscriptionItem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'name' => 'Test Subscription Item',
            'subscription_identity' => 'test',
            'unit' => 0,
            'status' => 0,
            'book_limit' => 16,
            'max_cant_reserve_period' => 0,
            'max_collectable_period' => 0,
            'max_no_of_renew' => 0,
            'max_no_of_reservations' => 0,
            'max_uncollected_no' => 0,
            'min_renewable_period' => 0,
            'resume_borrowable_period' => 0,
            'start_date' => '2018-01-01',
            'valid_period' => 7,
            'content_valid_period' => 28,
            'content_valid_period_type' => 3
        ];
    }

    public function activeMembership() {
        return $this->state(['subscription_identity' => 'member']);
    }
}
