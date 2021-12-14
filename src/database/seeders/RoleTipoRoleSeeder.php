<?php

namespace Ricardo\Modu\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleTipoRoleSeeder extends Seeder
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
                'role_id'      => 1,
                'tipo_role_id' => 1
            ]
        ];   

        foreach ($request as $value) {
            DB::table('role_tipo_role')->insert([
                'role_id'      => $value['role_id'],
                'tipo_role_id' => $value['tipo_role_id']
            ]);
        }
    }
}
