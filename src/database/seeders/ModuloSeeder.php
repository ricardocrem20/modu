<?php

namespace Ricardo\Modu\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModuloSeeder extends Seeder
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
				'id'     	  => 1,
				'modulo' 	  => 'Admin',
				'url'    	  => 'admin',
				'icono'  	  => 'mdi-account-cog-outline',
				'orden'  	  => 1,
				'activo' 	  => true,
				'descripcion' => 'Modulo para la administración del sistema'
			]
		];

		foreach ($requests as $valor) {
	        DB::table('modulos')->insert([
	        	'id' 		  => $valor['id'],
	            'modulo' 	  => $valor['modulo'],
	            'url' 		  => $valor['url'],
	            'icono' 	  => $valor['icono'],
	            'orden' 	  => $valor['orden'],
	            'activo' 	  => $valor['activo'],
	            'descripcion' => $valor['descripcion'],
	        ]);
    	}
    }
}
