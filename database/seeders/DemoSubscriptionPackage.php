<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Ant\Subscription\Models\SubscriptionPackage;
use Ant\Subscription\Models\SubscriptionItem;

class DemoSubscriptionPackage extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement("SET foreign_key_checks=0");
        SubscriptionPackage::truncate();
        SubscriptionItem::truncate();
        \DB::statement("SET foreign_key_checks=1");

        //
        $data = [
            [
                'subscription_identity' => 'member',
                'name' => 'Demo Package 1',
                'price' => '50',
                'created_at' => now(),
                'updated_at' => now(),
                'short_description' => 'Demo Package 1 description',
            ],
            [
                'subscription_identity' => 'member',
                'name' => 'Demo Package 2',
                'price' => '100',
                'created_at' => now(),
                'updated_at' => now(),
                'short_description' => 'Demo Package 2 description',
            ],
        ];
        
        // Model::insert($data); // Eloquent approach
        // DB::table('table')->insert($data); // Query Builder approach

        SubscriptionPackage::insert($data[0]);
        SubscriptionPackage::insert($data[1]);

        $data = [
            [
                'subscription_identity' => 'member',
                'name' => 'Membership',
                'unit' => 0,
                'valid_period' => '365',
                'valid_period_type' => 3,
                'content_valid_period' => 28,
                'content_valid_period_type' => 3,
                'status' => 0,
                'created_at' => now(),
                'updated_at' => now(),
                'package_id' => SubscriptionPackage::where('name', 'Demo Package 1')->first()->id,
                // 'priority' => '',
                // 'old_id' => '',
                'book_limit' => 16,
                'max_cant_reserve_period' => 7,
                'max_collectable_period' => 3,
                'max_no_of_renew' => 2,
                'max_no_of_reservations' => 5,
                'max_uncollected_no' => 3,
                'min_renewable_period' => 3,
                'resume_borrowable_period' => 0,
                'start_date' => '2018-01-01',
                // 'renew_days' => '',
            ],
            [
                'subscription_identity' => 'member',
                'name' => 'Membership',
                'unit' => 0,
                'valid_period' => '30',
                'valid_period_type' => 3,
                'content_valid_period' => 28,
                'content_valid_period_type' => 3,
                'status' => 0,
                'created_at' => now(),
                'updated_at' => now(),
                'package_id' => SubscriptionPackage::where('name', 'Demo Package 2')->first()->id,
                // 'priority' => '',
                // 'old_id' => '',
                'book_limit' => 16,
                'max_cant_reserve_period' => 7,
                'max_collectable_period' => 3,
                'max_no_of_renew' => 2,
                'max_no_of_reservations' => 5,
                'max_uncollected_no' => 3,
                'min_renewable_period' => 3,
                'resume_borrowable_period' => 0,
                'start_date' => '2018-01-01',
                // 'renew_days' => '',
            ],
            
        ];

        SubscriptionItem::insert($data[0]);
        SubscriptionItem::insert($data[1]);
    }
}
