<?php

namespace Ricardo\Modu\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreaSeeder extends Seeder
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
        		'id' 	      => 1,
        		'area'		  => 'Modulos',
        		'icono'		  => 'mdi-cube-outline',
        		'url'		  => 'admin/modulos',
        		'orden'	      => 1,
        		'menu'		  => true,
        		'activo'	  => true,
        		'descripcion' => 'Area para administrar los modulos del sistema',
        		'modulo_id'	  => 1
        	],
        	[
        		'id' 	      => 2,
        		'area'		  => 'Areas',
        		'icono'		  => 'mdi-chemical-weapon',
        		'url'		  => 'admin/areas',
        		'orden'	      => 2,
        		'menu'		  => false,
        		'activo'	  => true,
        		'descripcion' => 'Area para administrar las areas del sistema',
        		'modulo_id'	  => 1
        	],
        	[
        		'id' 	      => 3,
        		'area'		  => 'Usuarios',
        		'icono'		  => 'mdi-account',
        		'url'		  => 'admin/usuarios',
        		'orden'	      => 3,
        		'menu'		  => true,
        		'activo'	  => true,
        		'descripcion' => 'Area para administrar los usuarios del sistema',
        		'modulo_id'	  => 1
        	],
        	[
        		'id' 	      => 4,
        		'area'		  => 'Roles',
        		'icono'		  => 'mdi-account-key',
        		'url'		  => 'admin/roles',
        		'orden'	      => 4,
        		'menu'		  => true,
        		'activo'	  => true,
        		'descripcion' => 'Area para administrar los roles del sistema',
        		'modulo_id'	  => 1
        	],
        	[
        		'id' 	      => 5,
        		'area'		  => 'Permisos',
        		'icono'		  => 'mdi-account-check',
        		'url'		  => 'admin/permisos',
        		'orden'	      => 5,
        		'menu'		  => false,
        		'activo'	  => true,
        		'descripcion' => 'Area para administrar los permisos del sistema',
        		'modulo_id'	  => 1
        	]
        ];

        foreach ($requests as $valor) {
	        DB::table('areas')->insert([
	        	'id' 		  => $valor['id'],
	            'area' 	      => $valor['area'],
	            'icono' 	  => $valor['icono'],
	            'url' 		  => $valor['url'],
	            'orden' 	  => $valor['orden'],
	            'menu' 	      => $valor['menu'],
	            'activo' 	  => $valor['activo'],
	            'descripcion' => $valor['descripcion'],
	            'modulo_id'	  => $valor['modulo_id']
	        ]);
    	}
    }
}
