<?php

namespace Ant\Subscription\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Ant\Subscription\Models\Subscription;
use Ant\Subscription\Models\SubscriptionBundle;
use Ant\Subscription\Models\SubscriptionItem;
use Carbon\Carbon;

use Ant\Subscription\Events\UserSubscribes;

class SubscriptionPackage extends Model
{
    use HasFactory;

    public $table = 'subscription_package';

    protected $fillable = [
      'old_id',
      'subscription_identity',
      'name',
      'price',
      'app_id',
      'show_in_signup',
      'short_description',
      'admin_note',
      'options'
    ];

    protected $casts = [
      'options' => 'array',
    ];

    public function subscriptionItems() {
      return $this->hasMany(SubscriptionItem::class, 'package_id');
    }

    public function subscribe($user) {
      //$subscriptionItem = SubscriptionItem::where('id', 1)->first();
      $subscriptionItem = SubscriptionItem::where('package_id', $this->id)->first();
      $subscription = Subscription::where('package_id', $this->id)->get();

      $extendFrom = $user->isMember() ? $user->membershipExpireAt : Carbon::now();
      
      // if(count($subscription) > 0){
      //     $extendFrom = $currentDate->addDays($subscriptionItem->valid_period)->endOfDay()->toDateTimeString();
      // }
      // else{
          $expireAt = $extendFrom->addDays($subscriptionItem->valid_period)->endOfDay()->toDateTimeString();
      // }

      $bundle = SubscriptionBundle::create([
        'name' => $this->name,
        'price' => $this->price,
        'package_id' => $this->id,
        'owned_by' => $user->id,
      ]);

      Subscription::updateOrCreate([
        'subscription_identity' => 'member',
        'price' => $this->price,
        'purchased_unit' => 0,
        'used_unit' => 0,
        'content_valid_period' => $subscriptionItem->content_valid_period,
        'content_valid_period_type' => $subscriptionItem->content_valid_period_type,
        'status' => 1,
        'owned_by' => $user->id,
        'expire_at' => $expireAt,
        'package_id' => $this->id,
        'bundle_id' => $bundle->id,
        'priority' => 0
      ]);

      //Create invoice
      UserSubscribes::dispatch($bundle, $this, $user);

      return $bundle;

    }

    protected static function newFactory()
    {
        return new \Database\Factories\SubscriptionPackageFactory;
    }
}
