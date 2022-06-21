<?php
namespace Addons\Booking\Http\Requests;

use Fusion\Models\Matrix;
use Fusion\Http\Requests\Request;
use Fusion\Services\Builders;

class BookingRequest extends Request {
    public function __construct()
    {
        $this->matrix        = Matrix::where('slug', request()->route('slug'))->firstOrFail();
        $this->model         = Builders\Matrix::resolve($this->matrix->handle);
        $this->entry         = $this->model->find(request()->route('entry'));
    }

    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $this->merge([
        ]);
    }
    
    public function rules()
    {
        $rules = [
            'starts_at' => 'required',
            'ends_at' => 'required',
        ];
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