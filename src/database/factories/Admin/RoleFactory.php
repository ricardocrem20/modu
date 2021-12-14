<?php

namespace Database\Factories\Admin;
use Models\Admin\Role;

use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Role::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'role'        => 'Role test',
            'slug'        => 'role_test',
            'descripcion' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
        ];
    }
}
