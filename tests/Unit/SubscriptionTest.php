<?php

namespace Tests\Unit;

use Carbon\Carbon;
use App\Models\User;
use Tests\TestCase;
use Ant\Subscription\Models\Subscription;
use Ant\Subscription\Models\SubscriptionItem;
use Ant\Subscription\Models\SubscriptionPackage;

class SubscriptionTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $validDays = 7;
        $user = User::factory()->create();
        $user = User::find($user->id);

        $package = SubscriptionPackage::factory()
            ->has(SubscriptionItem::factory()->activeMembership()->state(['valid_period' => $validDays]))
            ->create();

        $package->subscribe($user);
        
        Carbon::setTestNow(now()->addDays($validDays - 1));

        $subscriptionCount = Subscription::nonExpiredForUser($user->id)->count();

        $this->assertEquals(1, $subscriptionCount);
    }
}
