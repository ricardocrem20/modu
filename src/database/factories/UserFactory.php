<?php

namespace Database\Factories;
use Models\User;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'tipo_identificacion' => 'CC',
            'identificacion'      => '123456798',
            'nombre'              => 'Daniela Ariza',
            'nombres'  	          => 'Daniela',
            'apellidos' 	      => 'Ariza',
            'email'               => 'daniela@app.io',
            'password'            => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token'      => Str::random(10),
        ];
    }
}
