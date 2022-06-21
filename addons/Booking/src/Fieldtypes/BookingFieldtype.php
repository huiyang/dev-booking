<?php

namespace Addons\Booking\Fieldtypes;

use Fusion\Models\Field;
use Illuminate\Support\Str;
use Fusion\Fieldtypes\Fieldtype;

class BookingFieldtype extends Fieldtype
{
    /**
     * @var string
     */
    public $name = 'Booking';

    /**
     * @var string
     */
    public $icon = 'check';

    /**
     * @var string
     */
    public $description = 'Has bookings';

    public $cast = 'string';

    public $column = null;

    /**
     * @var string
     */
    // public $relationship = 'morphToMany';

    /**
     * @var array
     */
    public $settings = [
    ];

    /**
     * Field setting validation rules (FieldRequest).
     *
     * @var array
     */
    public $rules = [
    ];

    public $traits = [
        'Ant\Booking\Traits\Bookable',
    ];

    /**
     * @var array
     */
    public $validation = [];  // no validation

    /**
     * @var string
     */
    // public $namespace = 'Fusion\Models\File';

    /**
     * @var mixed
     */
    protected $default = null;

    public function rules($field, $value = null)
    {
        return [];
    }

    /**
     * Generate relationship methods for associated Model.
     *
     * @param Fusion\Models\Field $field
     *
     * @return string
     */
    // public function generateRelationship($field)
    // {
    //     $stub = File::get(fusion_path("/stubs/relationships/{$this->relationship}.stub"));

    //     return strtr($stub, [
    //         '{handle}'            => $field->handle,
    //         '{studly_handle}'     => Str::studly($field->handle),
    //         '{related_pivot_key}' => 'file_id',
    //         '{related_namespace}' => $this->namespace,
    //         '{related_table}'     => 'files_pivot',
    //         '{where_clause}'      => "->where('field_id', {$field->id})",
    //         '{order_clause}'      => "->orderBy('order')",
    //     ]);
    // }

    /**
     * Update relationship data in storage.
     *
     * @param Illuminate\Eloquent\Model $model
     * @param Fusion\Models\Field       $field
     *
     * @return void
     */
    // public function persistRelationship($model, Field $field)
    // {
    //     $oldValues = $model->{$field->handle}->pluck('id');
    //     $newValues = collect(request()->input($field->handle))->mapWithKeys(function ($item, $key) use ($field) {
    //         return [
    //             $item['id'] => [
    //                 'field_id' => $field->id,
    //                 'order'    => $key + 1,
    //             ], ];
    //     });

    //     $model->{$field->handle}()->detach($oldValues);
    //     $model->{$field->handle}()->attach($newValues);
    //     $model->flush();
    // }

    /**
     * Returns resource object of field.
     *
     * @param Illuminate\Eloquent\Model $model
     * @param Fusion\Models\Field       $field
     *
     * @return FileResource
     */
    // public function getResource($model, Field $field)
    // {
    //     return FileResource::collection($this->getValue($model, $field));
    // }
}
