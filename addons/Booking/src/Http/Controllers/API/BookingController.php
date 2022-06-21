<?php
namespace Addons\Booking\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Addons\Booking\Http\Requests\BookingRequest;

class BookingController extends Controller {
    public function store(BookingRequest $request) {
        $user = auth()->user();
        if (!$request->entry->isAvailableBetween($request->starts_at, $request->ends_at)) {
            throw new \Exception('Not available');
        }
        $booking = $request->entry->newBooking($user, $request->starts_at, $request->ends_at);
        return $booking;
    }
}