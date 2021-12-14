<?php

namespace Ricardo\Modu\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $requests = [
			[
				'tipo_identificacion' => 'CC',
				'identificacion'      => '123456789',
				'nombre'  	          => 'Ricardo Garcia',
				'nombres'  	          => 'Ricardo',
				'apellidos' 	        => 'Garcia',
				'email'               => 'ricardo@app.io',
        'password'            => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
			]
		];

		foreach ($requests as $valor) {
	        DB::table('users')->insert([
	            'tipo_identificacion' => $valor['tipo_identificacion'],
	            'identificacion' 	   => $valor['identificacion'],
	            'nombre' 	           => $valor['nombre'],
	            'nombres' 	           => $valor['nombres'],
	            'apellidos' 	       => $valor['apellidos'],
	            'email'                => $valor['email'],
	            'password'             => $valor['password']
	        ]);
    	}
    }
}
