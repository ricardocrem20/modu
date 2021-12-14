<?php

namespace Ricardo\Modu\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoRoleSeeder extends Seeder
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
                'tipo_role' => 'Administrativos',
                'slug'      => 'administrativos'
            ]
        ];

        foreach ($requests as $valor) {
            DB::table('tipo_role')->insert([
                'tipo_role' => $valor['tipo_role'],
                'slug'      => $valor['slug']
            ]);
        }
    }
}
