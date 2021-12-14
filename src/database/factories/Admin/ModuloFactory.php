<?php

namespace Database\Factories\Admin;
use Models\Admin\Modulo;

use Illuminate\Database\Eloquent\Factories\Factory;

class ModuloFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Modulo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'modulo'      => 'Modulo test',
            'url'         => '/modulo_test',
            'icono'       => 'mdi-account-cog-outline',
            'orden'       => '2',
            'activo'      => '1',
            'descripcion' => 'Modulo para la administración del sistema'
        ];
    }
}
