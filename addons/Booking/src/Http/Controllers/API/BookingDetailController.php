<?php
namespace Addons\Booking\Http\Controllers\API;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Ant\Booking\Models\Booking;
use Illuminate\Routing\Controller;
use Fusion\Http\Resources\EntryResource;
use Fusion\Http\Requests\CollectionRequest;
use Addons\Booking\Http\Requests\BookingRequest;
use Addons\Booking\Http\Resources\BookingResource;
use Addons\Booking\Http\Requests\BookingDetailRequest;

class BookingDetailController extends Controller {
    public function create() {

    }

    public function store(BookingDetailRequest $request, Booking $booking) {
        $user = auth()->user();
        $entry = null;
        
        if (isset($booking->detail)) {
            throw new \Exception('Booking detail is already stored.');
        }
        
        \DB::transaction(function() use($request, $booking, &$entry) {
                
            $entry  = $request->model->create($request->validated());
            $matrix = $request->matrix;

            // persist relationships..
            foreach ($request->relationships as $relationship) {
                $relationship->type()->persistRelationship($entry, $relationship);
            }

            $booking->updateBookingDetail($entry);
        });

        // Autogenerate name/slug
        // if (!$matrix->show_name_field) {
        //     $entry->name = compile_blade_template($matrix->name_format, $entry);
        //     $entry->slug = Str::slug($entry->name);

        //     $entry->save();
        // }

        return new EntryResource($entry);

    }

    public function update(BookingDetailRequest $request, Booking $booking) {
        $user = auth()->user();
        
        \DB::transaction(function() use($request, $booking) {
            $startsAt = Carbon::parse($request->starts_at)->setTimezone(config('app.timezone'));
            $endsAt = Carbon::parse($request->ends_at)->setTimezone(config('app.timezone'));
                
            $booking->detail->update($request->validated());

            // persist relationships..
            foreach ($request->relationships as $relationship) {
                $relationship->type()->persistRelationship($booking->detail, $relationship);
            }

            if ($booking->bookable->isAvailableBetween($request->starts_at, $request->ends_at, [$booking->id])) {
                $booking->update([
                    'starts_at' => $startsAt,
                    'ends_at' => $endsAt,
                ]);
            } else {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'starts_at' => ['Not available'],
                    'ends_at' => ['Not available'],
                ]);
            }
        });

        // Autogenerate name/slug
        // if (!$matrix->show_name_field) {
        //     $entry->name = compile_blade_template($matrix->name_format, $entry);
        //     $entry->slug = Str::slug($entry->name);

        //     $entry->save();
        // }

        return new EntryResource($booking->detail);

    }
}