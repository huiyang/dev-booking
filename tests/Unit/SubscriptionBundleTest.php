<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Ant\Subscription\Models\SubscriptionPackage;
use Ant\Subscription\Models\SubscriptionItem;

class SubscriptionBundleTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testMarkAsPaid()
    {
        $membershipDays = 8;

        // Create a membership package
        $package = SubscriptionPackage::factory()
            ->has(SubscriptionItem::factory()->activeMembership()->state(['valid_period' => $membershipDays]))
            ->create();

        $user = User::factory()->create();
        $user = \App\Models\User::find($user->id);
        
        $bundle = $user->subscribeMembershipPackage($package->id);
        $bundle->markAsPaid();
        
        $this->assertTrue($bundle->isPaid());

        $bundle->refresh();

        $this->assertTrue($bundle->isPaid());
    }
}
