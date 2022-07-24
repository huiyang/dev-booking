<?php

namespace Database\Factories\Fusion\Models;

use Fusion\Models\Field;
use Fusion\Models\Matrix;
use Fusion\Models\Section;
use Fusion\Models\Blueprint;
use Fusion\Models\Replicator;
use Illuminate\Database\Eloquent\Factories\Factory;

class MatrixFactory extends Factory
{
    protected $model = 'Fusion\Models\Matrix';

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $handle = 'test'.uniqid();

        return [
            //
            'name' => 'Test',
            'handle' => $handle,
            'type' => 'collection',
            'slug' => $handle,
        ];
    }

    /**
     * 1. Create matrix
     * 2. Create blueprint for matrix
     * 3. Create section for matrix
     * 4. Create field for matrix's section
     * 5. Create section for replicator
     * 6. Create field for replicator
     */
    public function withReplicatorField($attributes = []) {
        return $this->withSection()->afterCreating(function(Matrix $matrix) {
            $replicatorField = [
                'type' => [
                    'id' => 'input',
                    'name' => 'Input',
                    'icon' => 'i-cursor',
                    'handle' => 'input',
                    'description' => 'Simple text input field.',
                    'cast' => 'string',
                    'column' => [
                        'type' => 'string',
                    ],
                    'exclude' => [
                    ],
                    'messages' => [
                    ],
                    'field' => NULL,
                    'settings' => [
                        'placeholder' => '',
                    ],
                    'validation' => [
                        'value' => '',
                    ],
                    'data' => [
                    ],
                    'structures' => [
                    ],
                ],
                'name' => 'Input',
                'handle' => 'input',
                'help' => '',
                'settings' => [
                    'placeholder' => '',
                ],
                'validation' => [
                    'value' => 'required',
                ]
            ];

            $section = $matrix->blueprint->sections->first();

            // 4. Create field for matrix's section
            $field = Field::make([
                'name' => 'Replicator',
                'handle' => 'replicator',
                'type' => 'replicator',
                'settings' => [
                    'sections' => [
                        $replicatorField,
                    ],
                ],
            ]);
            $field->fieldable_id = $section->id;
            $field->fieldable_type = Section::class;
            $field->save();

            $field->refresh();

            // 5. Create section for replicator
            $replicator = Replicator::find($field->settings['replicator']);

            $section = $replicator->sections->first();

            // 6. Create fields for replicator section
            $replicatorField['type'] = $replicatorField['type']['id'];
            $section->fields()->create($replicatorField);
        });
    }

    public function withSection($attributes = []) {
        return $this->afterCreating(function(Matrix $matrix) {
            $blueprint = $matrix->blueprint;
            $section = Section::create([
                'name' => 'General',
                'handle' => 'general',
                'blueprint_id' => $blueprint->id,
            ]);
        });
    }

    public function withBlueprint($attributes = []) {
        return $this->afterCreating(function (Matrix $matrix) use($attributes) {
            //
            $structure = 'Collections';

            $blueprint = Blueprint::make([
                'structure' => $structure,
                'name' => $matrix->name,
                'blueprintable_type' => get_class($matrix),
                'blueprintable_id' => $matrix->id,
            ]);
            $blueprint->blueprintable_type = get_class($matrix);
            $blueprint->blueprintable_id = $matrix->id;
            $blueprint->save();
            
            $matrix->load('blueprint');
        });
    }
}
