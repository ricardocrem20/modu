<?php

namespace Database\Factories\Admin;
use Models\Admin\PermisoUser;

use Illuminate\Database\Eloquent\Factories\Factory;

class PermisoUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PermisoUser::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'permiso_id' => 26,
            'user_id'    => 1
        ];
    }
}
