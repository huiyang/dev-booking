<?php
namespace Ant\Booking\Models;

class Availability extends \Rinvex\Bookings\Models\BookableAvailability {
	use \Ant\Core\Traits\DateRelatedQuery;
	
	protected $table = 'bookable_availabilities';

	protected $fillable = [
        'bookable_id',
        'bookable_type',
        'range',
        'from',
        'to',
        'is_bookable',
		'priority',
		'starts_at',
		'ends_at',
    ];

    protected $rules = [
        'bookable_id' => 'required|integer',
        'bookable_type' => 'required|string',
        //'range' => 'required|in:datetimes,dates,months,weeks,days,times,sunday,monday,tuesday,wednesday,thursday,friday,saturday',
        //'from' => 'required|string|max:150',
        //'to' => 'required|string|max:150',
        'is_bookable' => 'required|boolean',
        'priority' => 'nullable|integer',
    ];
}