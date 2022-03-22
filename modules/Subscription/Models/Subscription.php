<?php

namespace Ant\Subscription\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ant\Payment\Models\PaymentInvoice;

use Carbon\Carbon;

class Subscription extends Model
{
    use HasFactory;

    public $table = 'subscription';

    protected $fillable = [
      'old_id',
      'subscription_identity',
      'price',
      'purchased_unit',
      'used_unit',
      'content_valid_period',
      'content_valid_period_type',
      'status',
      'owned_by',
      'expire_at',
      'created_at',
      'updated_at',
      'invoice_id',
      'app_id',
      'package_id',
      'bundle_id',
      'priority',
      'item_id',
      'item_class_id'
    ];

    protected $appends = ['statusHtml', 'expireDaysFromCreatedAt'];

    protected $casts = [
      'created_at' => 'datetime',
      'expire_at' => 'datetime',
    ];

    public function package() {
      return $this->belongsTo(SubscriptionPackage::class, 'package_id');
    }

    public function subscriptionBundle(){
      return $this->belongsTo(SubscriptionBundle::class, 'bundle_id');
    }

    public function invoice() {
      return $this->belongsTo(PaymentInvoice::class, 'invoice_id');
    }

    public function isActive() {
      if (isset($this->invoice)) {
        return $this->invoice->isPaid();
      }
    }

    public function isExpired() {
      return $this->expire_at < Carbon::now();
    }

    public function scopeOwnedBy($query, $ownerId){
      $query->where('owned_by', $ownerId);
    }

    public function scopeNonExpiredForUser($query, $ownerId) {
      return $query->currentlyActiveForUser($ownerId);
    }

    /**
     * @deprecated
     * currentlyActive is ambigous, should use nonExpired
     */
    public function scopeCurrentlyActiveForUser($query, $ownerId){
      $currentDate = Carbon::today()->toDateString();
      $query->where([['expire_at', '>=', $currentDate], ['owned_by', $ownerId]]);
    }

    public function scopeType($query, $identity){
      $query->where("subscription_identity", $identity);
    }

    public function scopePaidOnly($query){
      $query->where(function($query) {
        $query->whereHas('invoice', function($q) {
            $q->where('status', PaymentInvoice::STATUS_PAID)
              ->orWhere('status', PaymentInvoice::STATUS_PAID_MANUALLY);
        });
        $query->orWhereHas('subscriptionBundle', function($q) {
          $q->where('is_paid', 1);
        });
      });
    }

    public function scopeExpirationLengthSinceCreatedLessThan($query, int $days) {
      $query
        ->whereNull('subscription.old_id')
        ->whereRaw('datediff(subscription.expire_at, subscription.created_at) < '.$days);
    }

    public function getExpireDaysFromCreatedAtAttribute() {
      return $this->expire_at->diffInDays($this->created_at);
    }

    public function getStatusHtmlAttribute() {
      if ($this->isActive()) {
        return '<span class="badge badge-success">'.$this->statusText.'</span>';
      }
      return '<span class="badge">'.$this->statusText.'</span>';
    }

    public function getStatusTextAttribute() {
      if ($this->isExpired()) {
        return 'Expired';
      } else if ($this->isActive()) {
        return 'Active';
      }
      return 'Pending';
    }
}
