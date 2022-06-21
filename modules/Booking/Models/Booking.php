<?php
namespace Ant\Booking\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;
use Ant\Booking\Models\Driver;
use Ant\State\Traits\HasStates;
use Gabievi\Promocodes\Facades\Promocodes;
use Gabievi\Promocodes\Exceptions\InvalidPromocodeException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Booking extends \Rinvex\Bookings\Models\BookableBooking {
    // use HasStates;
	
    protected $rules = [
        'bookable_id' => 'required|integer',
        'bookable_type' => 'required|string',
        //'customer_id' => 'required|integer',
        //'customer_type' => 'required|string',
        'starts_at' => 'required|date',
        'ends_at' => 'required|date',
        'price' => 'required|numeric',
        'quantity' => 'required|integer',
        'total_paid' => 'required|numeric',
        'currency' => 'required|alpha|size:3',
        'formula' => 'nullable|array',
        'canceled_at' => 'nullable|date',
        //'options' => 'nullable|array',
        'notes' => 'nullable|string|max:10000',
    ];

    // protected function registerStates(): void
    // {
    //     $this
    //         ->addState('state', \Ant\State\Base\State::class)
    //         ->allowTransition(\Ant\State\PendingPayment::class, \Ant\State\Paid::class, \Ant\Booking\State\Transitions\Payment::class)
    //         ->allowTransition(\Ant\State\Paid::class, \Ant\State\Confirmed::class)
	// 		->allowTransition(\Ant\State\Paid::class, \Ant\State\Paid::class)
	// 		->allowTransition(\Ant\State\PendingPayment::class, \Ant\State\Canceled::class, \Ant\State\Transitions\Cancel::class)
	// 		->allowTransition(\Ant\State\PendingPayment::class, \Ant\State\ConfirmedButNotPaid::class)
	// 		->default(\Ant\State\PendingPayment::class);
    // }
	
	// public function getPickupLocationAttribute() {
	// 	return $this->detail->pickup;
	// }
	
	// public function getDropOffLocationAttribute() {
	// 	return $this->detail->dropoff;
	// }
	
	public function getDaysAttribute() {
		return static::calculateUnit('days', $this->starts_at, $this->ends_at);
	}
	
	// public function getBranch() {
		
	// }
	
	// public function getPrice() {
		
	// }
	
	public function scopeStartsBetweenOrEndsBetween(Builder $builder, string $startsAt = null, string $endsAt = null): Builder {
		$builder->where(function($builder) use($startsAt, $endsAt) {
			if ($startsAt) {
				$builder->orWhere(function($builder) use($startsAt, $endsAt) {
					$builder->startsBetween($startsAt, $endsAt);
				});
			}
			if ($endsAt) {
				$builder->orWhere(function($builder) use($startsAt, $endsAt) {
					$builder->endsBetween($startsAt, $endsAt);
				});
			}
		});
		return $builder;
	}

	/**
     * Needed cause of a bug https://github.com/rinvex/laravel-bookings/issues/31
     */
    // protected static function boot()
    // {
    //     parent::bootTraits();
    //     Model::boot();

    //     static::validating(function (self $booking) {
	// 		//if (!$booking->exists) { // We need to validate when the booking is updated, especially when it is updated before payment 
	// 			Validator::make([
	// 				'starts_at' => $booking->starts_at, 
	// 				'options[addon]' => $booking->options
	// 			], [
	// 				'*' => [
	// 					function ($attribute, $value, $fail) use($booking) {
	// 						if (!$booking->bookable->isAvailableBetween($booking->starts_at, $booking->ends_at)) {
	// 							$fail('Vehicle is not available during the period selected. ');
	// 						}
	// 					},
	// 				],
	// 				'starts_at' => [
	// 					function($attribute, $value, $fail) {
	// 						if (!isset($value)) {
	// 							$fail('Start time for booking is required. ');
	// 						}
	// 						if (isset($value) && $value->diffInHours(Carbon::now()) <= 6) {
	// 							$fail('Vehicle can only be availabled after 6 hours. Please select a time 6 hours from now.');
	// 						}
	// 					}
	// 				],
	// 				'options[addon]' => [
	// 					function($attribute, $value, $fail) {
	// 						if (isset($value['items'])) {
	// 							$addons = BookableResource::whereIn('id', array_keys($value['items']))->get()->keyBy('id');
	// 							$items = $value['items'];
								
	// 							foreach ($items as $optionId => $item) {
	// 								$addon = $addons[$optionId];
	// 								$quantity = $item['quantity'] ?? 1;
	// 								if ((isset($addon->maximum_quantity) && $quantity > $addon->maximum_quantity) || (isset($addon->minimum_quantity) && $quantity < $addon->minimum_quantity)) {
	// 									$fail('Quantity of '.$addon->item->name.' should be between '.$addon->minimum_quantity.' and '.$addon->maximum_quantity);
	// 								}
	// 							}
	// 						}
	// 					}
						
	// 				],
	// 			])->validate();
			
	// 			if (!$booking->price) {
	// 				$formula = $booking->calculatePrice(
	// 					$booking->bookable,
	// 					$booking->starts_at,
	// 					$booking->ends_at
	// 				);
	// 				$price = $formula['total_price'];
	// 				$currency = $formula['currency'];
	// 				$quantity = $formula['total_units'];
	// 			} else {
	// 				$price = $booking->price;
	// 				$formula = $booking->formula;
	// 				$currency = $booking->currency;
	// 				$quantity = $booking->quantity;
	// 			}
	// 			$booking->currency = $currency;
	// 			$booking->formula = $formula;
	// 			$booking->price = $price;
	// 			$booking->quantity = $quantity;
	// 			if (!$booking->exists) $booking->total_paid = 0;
	// 		//}
    //     });
    // }
	
	public function pay($amount) {
		$this->total_paid += $amount;
		return $this;
	}
	
	public function isPaid() {
		return $this->total_paid >= $this->price && $this->total_paid > 0;
	}
	
	// public function calculatePrice(Model $bookable, Carbon $startsAt, Carbon $endsAt = null, int $quantity = 1) : array {
	// 	$calculated = $this->calculatePriceForProduct($bookable, $startsAt, $endsAt, $quantity);
	// 	$this->options->set('catalogPrice', $calculated['total_price']);
		
	// 	// Init value
	// 	$calculated['promocode_discount'] = 0;
		
	// 	// Catalog Discount
	// 	$bookable->calculatedPrice = $calculated['total_price']; // NOTE: This is need for $bookable->getDiscount() to be calculted correctly.
	// 	$this->options->set('catalogDiscount', $bookable->getDiscount());
	// 	$calculated['total_price'] -= $this->options->get('catalogDiscount');
		
	// 	// Catalog Charges
	// 	$this->options->set('afterHourChages', $this->getAdditionalPriceAfterHour($startsAt, $endsAt));
	// 	$calculated['total_price'] += $this->options->get('afterHourChages');
		
	// 	// Promo Code Discount
	// 	$promoDiscount = $this->calculatePromoCodeDiscount();
	// 	$calculated['promocode_discount'] += $promoDiscount;
	// 	$calculated['total_price'] -=  $promoDiscount;
		
	// 	// Addon Price
	// 	$calculated['total_price'] += $this->calculatePriceForOptions($startsAt, $endsAt);
		
	// 	return $calculated;
	// }
	
	public function isPickupAfterHour() {
		return $this->isAfterHour($this->startsAt);
	}
	
	public function isDropoffAfterHour() {
		return $this->isAfterHour($this->endsAt);
	}
	
	protected function getAdditionalPriceAfterHour($startsAt, $endsAt) {
		$additionalCharge = 0;
		$pickup = ($this->pickupPoint) ? $this->pickupPoint->branch->first() : Branch::find(request()->pickup);
		if (isset($pickup) && $pickup->checkExtraHours($startsAt)) {
			$additionalCharge += $pickup->extra_rate;
		}
		$dropoff = ($this->dropoffPoint) ? $this->dropoffPoint->branch->first() : Branch::find(request()->dropoff);
		if (isset($pickup) && $dropoff->checkExtraHours($endsAt)) {
			$additionalCharge += $dropoff->extra_rate;
		}
		return $additionalCharge;
	}

	public function isPriceToBeConfirmed() {
		$price = $this->calculatePriceForProduct($this->bookable, $this->starts_at, $this->ends_at);
		$price = $price['total_price'];
		return $price == 0 || !isset($price);
	}
	
	public function updateAddonItemsQuantity($options) {
		$items = [];
		foreach ($options as $optionId => $quantity) {
			$items[$optionId] = ['quantity' => $quantity];
		}
		$this->options->set('items', $items);
		
		return $this;
	}
	
	public function updateDriver($driver) {
		if (is_object($driver)) {
			// Assign new driver regardless booking have already associated with driver or not
			$this->customer()->associate($driver)->save();
		} else {
			if (isset($this->customer)) {
				// Booking associated with driver, update the driver
				$this->customer->update($driver);
			} else {
				// Booking not associated with driver, create new driver
				$this->customer()->associate(Driver::create($driver))->save();
			}
		}
	}
	
	public function getBasePrice() {
		return $this->options['basePrice'];
	}
	
	public function getUnitPriceAttribute() {
		return $this->catalogPrice - $this->catalogDiscount + $this->catalogCharges;
	}
	
	public function getCatalogPriceAttribute() {
		return $this->options->get('catalogPrice');
	}
	
	public function getCatalogChargesAttribute() {
		return $this->afterHourCharges;
	}
	
	public function getAfterHourChargesAttribute() {
		return $this->options->get('afterHourChages');
	}
	
	// Total before additional charges
	public function getDiscountPriceAttribute() {
		return $this->unitPrice - $this->discount;
	}
	
	public function getNetPriceAttribute() {
		return $this->discountPrice + $this->addonPrice;
	}
	
	public function getDiscountAttribute() {
		return $this->promoCodeDiscount;
	}
	
	public function getPromoCodeDiscountAttribute() {
		return $this->formula['promocode_discount'] ?? $this->calculatePromoCodeDiscount();
	}
	
	public function getCatalogDiscountAttribute() {
		return $this->options->get('catalogDiscount');
	}
	
	public function getAddonPriceAttribute() {
		return $this->calculatePriceForOptions($this->starts_at, $this->ends_at);
	}
	
	public function getUsedPromoCode() {
		return $this->options->get('promoCode');
	}
	
	public function getAddons() {
		return $this->options['items'];
	}
	
	public function updatePromoCode($promoCode) {
		if ($promoCode) {
			$validator = Validator::make(['promoCode' => $promoCode], [
				'promoCode' => function($attribute, $value, $fail) {
					try {
						$promo = Promocodes::check($value);
						if ($promo === false) throw new InvalidPromocodeException;
					} catch (InvalidPromocodeException $ex) {
						$fail('Invalid :attribute');
					}
				}
			]);
			
			if ($validator->validate()) {
				$this->options->set('promoCode', $promoCode);
			}
		} else {
			// Valid to update promo code to empty - to clear the promo code
			$this->options->forget('promoCode');
		}
		
		$this->price = null; // Need to clear the old price so that when save it will calculate the new price.
	}
	
	public function pickupPoint() {
		return $this->hasOneThrough('Ant\Booking\Models\MeetPoint', BookingDetail::class, 'booking_id', 'id', 'id', 'pickup_point_id');
	}
	
	public function dropoffPoint() {
		return $this->hasOneThrough('Ant\Booking\Models\MeetPoint', BookingDetail::class, 'booking_id', 'id', 'id', 'dropoff_point_id');
	}
	
	public function detail() : HasOne {
		return $this->hasOne(BookingDetail::class, 'booking_id');
	}
	
	// protected function calculatePriceForProduct(Model $bookable, Carbon $startsAt, Carbon $endsAt = null, int $quantity = 1, $options = []) {
	// 	if (isset($bookable->rates)) {
	// 		foreach ($bookable->rates as $rate) {
	// 			if ($rate->match($bookable, $startsAt, $endsAt, $quantity)) {
	// 				return $rate->calculateRatePrice($bookable, $startsAt, $endsAt, $quantity);
	// 			}
	// 		}
	// 	}
	// 	return $this->_calculatePrice($bookable, $startsAt, $endsAt, $quantity);
	// }

	protected function calculatePromoCodeDiscount() {
		$discount = 0;
		if (isset($this->options['promoCode'])) {
			try {
				$promo = Promocodes::check($this->options['promoCode']);
				if ($promo) {
					$discount += $promo->reward;
				} else {
					throw new InvalidPromocodeException;
				}
			} catch (InvalidPromocodeException $ex) {
				unset($this->options['promoCode']);
			}
		}
		return $discount;
	}	
	
	protected function calculatePriceForOptions($startsAt, $endsAt) {
		$price = 0;
		if (isset($this->options['items'])) {
			$addons = BookableResource::whereIn('id', array_keys($this->options['items']))->get()->keyBy('id');
			
			$items = $this->options['items'];
			foreach ($items as $optionId => &$option) {
				if (isset($option['price'])) {
					// If have price mean it is intialized before 
					$price += $option['price'];
				} else {
					// If dont have price mean it is not initialized before
					if (!isset($addons[$optionId])) throw new \Exception('Invalid option selected. ');
					
					$calculated = $this->calculatePriceForProduct($addons[$optionId], $startsAt, $endsAt, $option['quantity'] ?? 0);
					
					$option['calculated'] = $calculated;
					$option['name'] = isset($addons[$optionId]->item) ? $addons[$optionId]->item->name : null;
					$option['price'] = $calculated['total_price'];
					
					$price += $option['price'];
				}
			}
			$this->options->set('items', $items);
		}
		//if ($price > 0) dd($price);
		return $price;
	}
	
	public static function calculateUnit($unit, $startsAt, $endsAt) {
		$startsAt = is_object($startsAt) ? $startsAt : Carbon::create($startsAt);
		$endsAt = is_object($endsAt) ? $endsAt : Carbon::create($endsAt);
		
		if ($unit == "use") return 1;
		
		$totalUnits = 0;
		$method = 'add'.ucfirst($unit);

		for ($date = clone $startsAt; $date->lt($endsAt ?? $date->addDay()); $date->{$method}()) {
			$totalUnits++;
		}
		return $totalUnits;
	}
	
	// protected function _calculatePrice(Model $bookable, Carbon $startsAt, Carbon $endsAt = null, int $quantity = 1): array
    // {
	// 	if (!isset($startsAt)) throw new \Exception('Value for startsAt is missing. ');
	// 	if (!isset($endsAt)) throw new \Exception('Value for endsAt is missing. ');
	// 	if (!isset($bookable->unit) || trim($bookable->unit) == '') throw new \Exception('Unit for bookable (ID: '.$bookable->id.') "'.($bookable->unit ?? '').'" is not setup correctly. ');
		
    //     $totalUnits = 0;
    //     $totalUnits = self::calculateUnit($bookable->unit, $startsAt, $endsAt);
	// 	$totalPrice = $bookable->base_cost + ($bookable->unit_cost * $totalUnits * $quantity);

    //     return [
    //         'base_cost' => $bookable->base_cost,
    //         'unit_cost' => $bookable->unit_cost,
    //         'unit' => $bookable->unit,
    //         'currency' => $bookable->currency,
    //         'total_units' => $totalUnits,
    //         'total_price' => $totalPrice,
    //     ];
    // }
}