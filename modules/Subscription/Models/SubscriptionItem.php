<?php

namespace Ant\Subscription\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionItem extends Model
{
    use HasFactory;

    public $table = "subscription_package_item";  

    const PERIOD_TYPE_DAYS = 3;

    protected $fillable = [
      'old_id',
      'subscription_identity',
      'name',
      'unit',
      'valid_period',
      'valid_period_type',
      'content_valid_period',
      'content_valid_period_type',
      'status',
      'package_id',
      'priority',
      'book_limit',
      'expiry_date',
      'max_cant_reserve_period',
      'max_collectable_period',
      'max_no_of_renew',
      'max_no_of_reservations',
      'max_uncollected_no',
      'min_renewable_period',
      'resume_borrowable_period',
      'start_date'
    ];

    protected static function newFactory()
    {
        return new \Database\Factories\SubscriptionItemFactory;
    }
}
