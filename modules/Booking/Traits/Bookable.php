<?php
namespace Ant\Booking\Traits;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Rinvex\Bookings\Models\BookableBooking;

trait Bookable {
	use \Rinvex\Bookings\Traits\Bookable;

	public function getQuantityAttribute($value) {
		return $value ?? 1;
	}
	
	public static function getBookingModel() : string {
		return \Ant\Booking\Models\Booking::class;
		
	}
	
	public static function getRateModel() : string {
		return \Ant\Booking\Models\BookingRate::class;
		
	}
	
	public static function getAvailabilityModel() : string {
		return \Ant\Booking\Models\Availability::class;
	}
	
    public function newBooking(Model $customer, string $startsAt, string $endsAt, int $quantity =  1): BookableBooking
    {
		$startsAt = new \Carbon\Carbon($startsAt);
		$endsAt = new \Carbon\Carbon($endsAt);

		if ($endsAt->lessThanOrEqualTo($startsAt)) {
			throw new \Exception("End time should be greater than start time.");
		}

        $booking = $this->bookings()->make([
            'bookable_id' => static::getKey(),
            'bookable_type' => static::getMorphClass(),
            'customer_id' => $customer->getKey(),
            'customer_type' => $customer->getMorphClass(),
            'starts_at' => $startsAt->toDateTimeString(),
            'ends_at' => $endsAt->toDateTimeString(),
            'quantity' => $quantity,
            'total_paid' => 0,
			'currency' => $this->currency,
        ]);

		$price = $booking->calculatePrice($this, $startsAt, $endsAt, $quantity);
		
		$booking->price = $price['total_price'];
		$booking->save();

		return $booking;
    }

	public function deleteExpiredNotCompleteBooking() {
		$this->bookings()->oldThanMinutes(10)
			->where('state', \Ant\Booking\States\NewBooking::class)
			->delete();
	}

	public function checkAvailabilityThenNewBooking(Model $customer, string $startsAt, string $endsAt, int $quantity =  1) {
        if (!$this->isAvailableBetween($startsAt, $endsAt)) {
            throw new \Exception('Not available');
        }
        return $this->newBooking($customer, $startsAt, $endsAt, $quantity);
	}
    
    public function isAvailableBetween($startsAt, $endsAt) {
		return static::availableBetween($startsAt, $endsAt)->where('id', $this->id)->count() > 0;
	}

    public function scopeAvailableBetween($builder, $startsAt, $endsAt) {
		$builder->notFullyBookedBetween($startsAt, $endsAt)
			->notBlockedBetween($startsAt, $endsAt);
	}

    public function scopeNotBlockedBetween($builder, $startsAt, $endsAt) {
		$builder->whereDoesntHave('availabilities', function($q) use($startsAt, $endsAt) {
			$q->where('is_bookable', 0)->whereOverlapped($startsAt, $endsAt);
		});
	}
	
	public function scopeNotFullyBookedBetween($builder, $startsAt, $endsAt) {
		return $builder->has('bookings', '<', DB::raw('`quantity`'), 'and', function($builder) use($startsAt, $endsAt)  {
			$builder->startsBetweenOrEndsBetween($startsAt, $endsAt);
		});
	}
	
	public function scopeNotBookedBetween($builder, $startsAt, $endsAt) {
		return $builder->doesnthave('bookings', 'and', function($builder) use($startsAt, $endsAt)  {
			$builder->startsBetweenOrEndsBetween($startsAt, $endsAt);
		});
	}
}