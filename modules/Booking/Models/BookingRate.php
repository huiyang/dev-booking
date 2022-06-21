<?php
namespace Ant\Booking\Models;

class BookingRate extends \Rinvex\Bookings\Models\BookableRate {
    protected $appends = ['calculatedPrice'];
	
    protected $fillable = [
        'bookable_id',
        'bookable_type',
        'range',
        'from',
        'to',
        'base_cost',
        'unit_cost',
        'priority',
		'starts_at',
		'ends_at',
    ];
	
	
    /**
     * Get the administrator flag for the user.
     *
     * @return bool
     */
    public function getCalculatedPriceAttribute()
    {
        return $this->attributes['calculatedPrice'];
    }
	
	public function scopeCalculatePrice($builder, $startsAt, $endsAt) {
		$days = $this->getDiffInDays($startsAt, $endsAt);
		return $builder->join('vehicle', 'vehicle.id', '=', 'bookable_rates.bookable_id')
			->select('bookable_id', \DB::raw('IF(bookable_rates.from <= '.$days.' AND bookable_rates.to >= '.$days.', bookable_rates.base_cost + (bookable_rates.unit_cost * '.$days.'), vehicle.base_cost + (vehicle.unit_cost * '.$days.')) AS customPrice'))
			->where('from', '<=', $days)
			->where('to', '>=', $days);
	}
	
	public function calculateRatePrice($bookable, $startsAt, $endsAt, $quantity) {
		$days = $this->getDiffInDays($startsAt, $endsAt);
		$basePrice = isset($this->base_cost) ? $this->base_cost : $bookable->base_cost;
		return [
            'base_cost' => $basePrice,
            'unit_cost' => $this->unit_cost,
            'unit' => $bookable->unit,
            'currency' => $bookable->currency,
            'total_units' => $days,
            'total_price' => $basePrice + ($this->unit_cost * $days),
        ];
	}
	
	public function match($bookable, $startsAt, $endsAt, $quantity) {
		$matcher = 'range'.ucwords($this->range);
		return $this->{$matcher}($bookable, $startsAt, $endsAt, $quantity);
		
	}
	
	protected function rangeDays($bookable, $startsAt, $endsAt, $quantity) {
		$days = $this->getDiffInDays($startsAt, $endsAt);
		return $this->from <= $days && $this->to >= $days;
	}
	
	protected function getDiffInDays($startsAt, $endsAt) {
		return Booking::calculateUnit('days', $startsAt, $endsAt);
	}
}