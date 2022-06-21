<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BookableResource extends Model
{
    use HasFactory;
	use \Ant\Booking\Traits\Bookable;

	public function getUnitCostAttribute() {
		return 1;
	}

	public function getUnitAttribute() {
		return 'day';
	}

	public function getCurrencyAttribute() {
		return 'MYR';
	}
}
