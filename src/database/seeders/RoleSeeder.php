<?php

namespace Ricardo\Modu\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $request = [
            [
                'id'          => 1,
                'role'        => 'Admin',
                'slug'        => 'admin',
                'descripcion' => 'Permite administrar el sistema.'
            ]
        ];   

        foreach ($request as $value) {
            DB::table('roles')->insert([
                'id'          => $value['id'],
                'role'        => $value['role'],
                'slug' 	      => $value['slug'],
                'descripcion' => $value['descripcion']
            ]);
        }
    }
}
