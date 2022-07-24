<?php
namespace Addons\Booking\Http\Requests;

use Fusion\Models\Matrix;
use Fusion\Http\Requests\Request;
use Fusion\Services\Builders;

class BookingDetailRequest extends Request {
    public function __construct()
    {
        $slug = 'booking-detail';

        $this->matrix        = Matrix::where('slug', $slug )->firstOrFail();
        $this->model         = Builders\Matrix::resolve($this->matrix->handle);
        $this->blueprint     = $this->matrix->blueprint;
        $this->fields        = $this->blueprint->fields ?? collect();
        $this->relationships = $this->blueprint ? $this->blueprint->relationships() : [];
    }

    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'matrix_id'  => $this->matrix->id,
            'name' => $this->booking->bookable->name.': '.$this->booking->starts_at->toDateTimeString().' - '.$this->booking->ends_at->toDateTimeString(),
        ]);
    }
    
    public function rules()
    {
        $rules = [
            'matrix_id'  => 'required|integer',
            'name' => 'nullable',
        ];

        $rules += $this->fields->flatMap(function ($field) {
            return $field->type()->rules($field, $this->{$field->handle});
        })->toArray();

        return $rules;
    }

    public function withValidator($validator)
    {
    }

    public function attributes() {
        return [

        ];
    }

}