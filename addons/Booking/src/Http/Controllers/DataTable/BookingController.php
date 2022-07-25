<?php
namespace Addons\Booking\Http\Controllers\DataTable;

use Fusion\Models\Matrix;
use Fusion\Services\Builders;
use Illuminate\Http\Request;
use Ant\Booking\Models\Booking;
use Illuminate\Routing\Controller;
use Addons\Booking\Http\Requests\BookingRequest;
use Fusion\Http\Controllers\DataTableController;
use Addons\Booking\Http\Resources\BookingResource;

class BookingController extends DataTableController {
    public function builder() {
        $slug = request()->slug;
        $matrixId = request()->entry;
        $matrix = Matrix::where('slug', $slug )->firstOrFail();
        $model = Builders\Matrix::resolve($matrix->handle);

        return Booking::with('bookable', 'detail')
            ->whereBookedStateOnly()
            ->where('bookable_type', get_class($model))->where('bookable_id', $matrixId);
    }

    public function getDisplayableColumns()
    {
        return [
          'id',
          'bookable_name',
          'starts_at',
          'ends_at',
          'created_at',
          'state_name',
        ];
    }

    public function getFilterable()
    {
        return [
          'id',
        ];
    }
  
    public function getSortable()
    {
        return [
            'id',
            'starts_at',
            'ends_at',
            'created_at',
            'status',
        ];
    }

    public function getRelationships()
    {
        return [
          'bookable',
          'detail',
        ];
    }
}