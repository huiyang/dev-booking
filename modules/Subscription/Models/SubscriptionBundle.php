<?php

namespace Ant\Subscription\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ant\Payment\Models\PaymentInvoice;
use App\Models\User;

class SubscriptionBundle extends Model
{
    use HasFactory;

    public $table = 'subscription_bundle';

    protected $fillable = [
      'old_id',
      'note',
      'name',
      'price',
      'package_id',
      'invoice_id',
      'organization_id',
      'owned_by',
    ];

    protected $casts = [
      'is_paid' => 'boolean',
    ];

    public function owner() {
      return $this->belongsTo(User::class, 'owned_by');
    }

    public function invoice() {
      return $this->belongsTo(PaymentInvoice::class, 'invoice_id');
    }

    public function subscriptions() {
      return $this->hasMany(Subscription::class, 'bundle_id');
    }

    public function markAsPaid() {
      $this->is_paid = true;
      $this->save();

      if (isset($this->invoice)) {
        return $this->invoice->markAsPaid();
      }
    }

    public function isPaid() {
      if (isset($this->invoice)) {
        return $this->invoice->isPaid();
      }
      return $this->is_paid;
    }

}
