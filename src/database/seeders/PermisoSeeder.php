<?php

namespace Ricardo\Modu\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermisoSeeder extends Seeder
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
        		'permiso'     => 'Crear modulos',
        		'slug'        => 'crear_modulos',
        		'descripcion' => 'Permite crear los modulos del sitema',
        		'area_id' => 1
        	],
        	[
        		'permiso'     => 'Listar modulos',
        		'slug'        => 'listar_modulos',
        		'descripcion' => 'Permite listar los modulos del sistema',
        		'area_id' => 1
        	],
        	[
        		'permiso'     => 'Obtener un modulo',
        		'slug'        => 'obtener_modulo',
        		'descripcion' => 'Permite obtener un modulo del sistema',
        		'area_id' => 1
        	],
        	[
        		'permiso'     => 'Editar un modulo',
        		'slug'        => 'editar_modulos',
        		'descripcion' => 'Permite editar un modulo del sistema',
        		'area_id' => 1
        	],
        	[
        		'permiso'     => 'Eliminar un modulo',
        		'slug'        => 'eliminar_modulos',
        		'descripcion' => 'Permite eliminar un modulo del sistema',
        		'area_id' => 1
        	],
			[
        		'permiso'     => 'Crear areas',
        		'slug'        => 'crear_areas',
        		'descripcion' => 'Permite crear las areas del sitema',
        		'area_id' => 2
        	],
        	[
        		'permiso'     => 'Listar areas',
        		'slug'        => 'listar_areas',
        		'descripcion' => 'Permite listar las areas del sistema',
        		'area_id' => 2
        	],
        	[
        		'permiso'     => 'Obtener un areas',
        		'slug'        => 'obtener_area',
        		'descripcion' => 'Permite obtener un area del sistema',
        		'area_id' => 2
        	],
        	[
        		'permiso'     => 'Editar un areas',
        		'slug'        => 'editar_areas',
        		'descripcion' => 'Permite editar un area del sistema',
        		'area_id' => 2
        	],
        	[
        		'permiso'     => 'Eliminar un areas',
        		'slug'        => 'eliminar_areas',
        		'descripcion' => 'Permite eliminar un area del sistema',
        		'area_id' => 2
        	],
			[
        		'permiso'     => 'Crear usuarios',
        		'slug'        => 'crear_usuarios',
        		'descripcion' => 'Permite crear los usuarios del sitema',
        		'area_id' => 3
        	],
        	[
        		'permiso'     => 'Listar usuarios',
        		'slug'        => 'listar_usuarios',
        		'descripcion' => 'Permite listar los usuarios del sistema',
        		'area_id' => 3
        	],
        	[
        		'permiso'     => 'Obtener un usuario',
        		'slug'        => 'obtener_usuario',
        		'descripcion' => 'Permite obtener un usuario del sistema',
        		'area_id' => 3
        	],
        	[
        		'permiso'     => 'Editar un usuario',
        		'slug'        => 'editar_usuarios',
        		'descripcion' => 'Permite editar un usuario del sistema',
        		'area_id' => 3
        	],
        	[
        		'permiso'     => 'Eliminar un usuario',
        		'slug'        => 'eliminar_usuarios',
        		'descripcion' => 'Permite eliminar un usuario del sistema',
        		'area_id' => 3
        	],
			[
        		'permiso'     => 'Crear roles',
        		'slug'        => 'crear_roles',
        		'descripcion' => 'Permite crear los roles del sitema',
        		'area_id' => 4
        	],
        	[
        		'permiso'     => 'Listar roles',
        		'slug'        => 'listar_roles',
        		'descripcion' => 'Permite listar los roles del sistema',
        		'area_id' => 4
        	],
        	[
        		'permiso'     => 'Obtener un rol',
        		'slug'        => 'obtener_rol',
        		'descripcion' => 'Permite obtener un rol del sistema',
        		'area_id' => 4
        	],
        	[
        		'permiso'     => 'Editar un rol',
        		'slug'        => 'editar_roles',
        		'descripcion' => 'Permite editar un rol del sistema',
        		'area_id' => 4
        	],
        	[
        		'permiso'     => 'Eliminar un rol',
        		'slug'        => 'eliminar_roles',
        		'descripcion' => 'Permite eliminar un rol del sistema',
        		'area_id' => 4
        	],
			[
        		'permiso'     => 'Crear permisos',
        		'slug'        => 'crear_permisos',
        		'descripcion' => 'Permite crear los permisos del sitema',
        		'area_id' => 5
        	],
        	[
        		'permiso'     => 'Listar permisos',
        		'slug'        => 'listar_permisos',
        		'descripcion' => 'Permite listar los permisos del sistema',
        		'area_id' => 5
        	],
        	[
        		'permiso'     => 'Obtener un permiso',
        		'slug'        => 'obtener_permiso',
        		'descripcion' => 'Permite obtener un permiso del sistema',
        		'area_id' => 5
        	],
        	[
        		'permiso'     => 'Editar un permiso',
        		'slug'        => 'editar_permisos',
        		'descripcion' => 'Permite editar un permiso del sistema',
        		'area_id' => 5
        	],
        	[
        		'permiso'     => 'Eliminar un permiso',
        		'slug'        => 'eliminar_permisos',
        		'descripcion' => 'Permite eliminar un permiso del sistema',
        		'area_id' => 5
        	]
        ];

        foreach ($requests as $valor) {
            DB::table('permisos')->insert([
                'permiso'     => $valor['permiso'],
                'slug'        => $valor['slug'],
                'descripcion' => $valor['descripcion'],
                'area_id'     => $valor['area_id'],
            ]);
        }
    }
}