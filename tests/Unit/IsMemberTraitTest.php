<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Ant\Subscription\Models\SubscriptionPackage;
use Ant\Subscription\Models\SubscriptionItem;

class IsMemberTraitTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testIsMember()
    {
        $user = User::factory()->create();
        $user = \App\Models\User::find($user->id);

        $this->assertFalse($user->isMember());
    }

    public function testMembershipExpireAt()
    {
        $user = User::factory()->create();
        $user = \App\Models\User::find($user->id);

        $this->assertFalse(isset($user->membershipExpireAt));
    }

    public function testSubscribeMembershipPackage()
    {
        $membershipDays = 8;

        // Create a membership package
        $package = SubscriptionPackage::factory()
            ->has(SubscriptionItem::factory()->activeMembership()->state(['valid_period' => $membershipDays]))
            ->create();

        $user = User::factory()->create();
        $user = \App\Models\User::find($user->id);

        $this->assertFalse($user->isMember());
        
        $bundle = $user->subscribeMembershipPackage($package->id);
        $bundle->markAsPaid();

        $this->assertTrue($user->isMember());
        $this->assertEquals(\Carbon\Carbon::now()->addDays($membershipDays)->endOfDay()->toDateTimeString(), $user->membershipExpireAt);
    }

    public function testSubscribeMembershipPackageNonPaid()
    {
        $membershipDays = 8;

        // Create a membership package
        $package = SubscriptionPackage::factory()
            ->has(SubscriptionItem::factory()->activeMembership()->state(['valid_period' => $membershipDays]))
            ->create();

        $user = User::factory()->create();
        $user = \App\Models\User::find($user->id);

        $bundle = $user->subscribeMembershipPackage($package->id);

        $this->assertFalse($user->isMember());
    }
    
    public function testSubscribeMembershipPackageExtendMembershipTwice()
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
        
        $bundle = $user->subscribeMembershipPackage($package->id);
        $bundle->markAsPaid();

        $this->assertTrue($user->isMember());
        // Subscribed and paid twice to the same package, hence the expire date should be 2 times $membershipDays from now
        $this->assertEquals(\Carbon\Carbon::now()->addDays($membershipDays * 2)->endOfDay()->toDateTimeString(), $user->membershipExpireAt);
    }
    
    public function testSubscribeMembershipPackageExtendMembership3Times()
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
        
        $bundle = $user->subscribeMembershipPackage($package->id);
        $bundle->markAsPaid();
        
        $bundle = $user->subscribeMembershipPackage($package->id);
        $bundle->markAsPaid();

        $this->assertTrue($user->isMember());
        // Subscribed and paid 3 times to the same package, hence the expire date should be 3 times $membershipDays from now
        $this->assertEquals(\Carbon\Carbon::now()->addDays($membershipDays * 3)->endOfDay()->toDateTimeString(), $user->membershipExpireAt);
    }
}
