<?php
namespace Addons\Booking\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Addons\Booking\Http\Requests\BookingRequest;
use Addons\Booking\Http\Requests\BookingDetailRequest;
use Addons\Booking\Http\Resources\BookingResource;
use Fusion\Http\Requests\CollectionRequest;
use Ant\Booking\Models\Booking;
use Fusion\Http\Resources\EntryResource;

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
}