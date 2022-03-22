<?php
  namespace Ant\Member\Traits;

  use Carbon\Carbon;
  use Ant\Subscription\Models\Subscription;
  use Ant\Subscription\Models\SubscriptionPackage;
  use Ant\Subscription\Models\SubscriptionItem;

  trait IsMember{

    public $subscriptionIdentity = 'member';

    public function isMember(){
      $currentDate = Carbon::today()->toDateString();
      $expiryDate = $this->membershipExpireAt;

      return ($expiryDate >= $currentDate) ? true : false;
    }

    public function getIsMemberAttribute() {
      return $this->isMember();
    }

    public function subscription(){
      return Subscription::where("owned_by", $this->id);
    }

    public function subscriptions() {
      return Subscription::where("owned_by", $this->id);
    }

    public function membershipSubscription() {
      return $this->subscriptions()->type($this->subscriptionIdentity);
    }

    public function getMembershipExpireAtAttribute() {
      $subscription = $this->getLastExpireAndActiveAndPaidSubscription($this->subscriptionIdentity);

  		if (isset($subscription)) {
  			return $subscription->expire_at;
  		} else if ($subscription = $this->getLastExpireAndPaidSubscription($this->subscriptionIdentity)) {
  			return $subscription->expire_at;
  		}

      /*return $this->subscription()
      ->type($this->subscriptionIdentity)
      ->paidOnly()
      ->latest('expire_at')
      ->value('expire_at');*/
    }

    protected function getLastExpireAndActiveAndPaidSubscription() {
  		return Subscription::currentlyActiveForUser($this->id)
  			->type($this->subscriptionIdentity)
  			->paidOnly()
  			->latest('expire_at')
  			->first();
  	}

    protected function getLastExpireAndPaidSubscription() {
  		return Subscription::ownedBy($this->id)
  			->type($this->subscriptionIdentity)
  			->paidOnly()
  			->latest('expire_at')
  			->first();
  	}

    public function subscribeMembershipPackage($subscriptionPackageId) {
  			$package = SubscriptionPackage::find($subscriptionPackageId);

  			if (!isset($package)) throw new \Exception('Package "'.$subscriptionPackageId.'" does not exist. ');

  			$bundle = $package->subscribe($this);
  			return $bundle;
  	}

    public function getMemberTypeName() {
      $subscription = $this->getLastExpireAndPaidSubscription();
      return $subscription->package->name;
    }
  }
