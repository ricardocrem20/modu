<?php

namespace Database\Factories\Admin;
use Models\Admin\Area;

use Illuminate\Database\Eloquent\Factories\Factory;

class AreaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Area::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'area'        => 'Area test',
            'icono'       => 'Lorem ipsum dolor.',
            'url'         => '/area_test',
            'orden'       => '2',
            'menu'        => '1', 
            'activo'      => '1',
            'descripcion' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'modulo_id'   => '2'
        ];
    }
}
