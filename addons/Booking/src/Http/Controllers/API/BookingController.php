<?php
namespace Addons\Booking\Http\Controllers\API;

use Illuminate\Http\Request;
use Ant\Booking\Models\Booking;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Addons\Booking\Http\Requests\BookingRequest;
use Addons\Booking\Http\Resources\BookingResource;

class BookingController extends Controller {
    public function store(BookingRequest $request) {
        $user = auth()->user();

        $request->entry->deleteExpiredNotCompleteBooking();

        $booking = $request->entry->checkAvailabilityThenNewBooking($user, $request->starts_at, $request->ends_at);
        return $booking;
    }

    public function show(Booking $booking) {
        return new BookingResource($booking);
    }

    public function destroy(Booking $booking) {
        DB::transaction(function () use($booking) {
            if (isset($booking->detail)) {
                $booking->detail->delete();
            }
            $booking->delete();
        });
    }
}