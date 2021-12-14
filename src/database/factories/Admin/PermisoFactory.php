<?php

namespace Database\Factories\Admin;
use Models\Admin\Permiso;

use Illuminate\Database\Eloquent\Factories\Factory;

class PermisoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Permiso::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'permiso'     => 'Crear permiso test',
            'slug'        => 'crear_permioso_test',
            'descripcion' => 'Creación de permisos tests',
            'area_id'     => 6
        ];
    }
}
