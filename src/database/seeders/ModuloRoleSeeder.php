<?php

namespace Ricardo\Modu\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModuloRoleSeeder extends Seeder
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
        		'modulo_id' => 1,
        		'role_id'   => 1
        	]
        ];

        foreach ($requests as $valor) {
	        DB::table('modulo_role')->insert([
	        	'modulo_id' => $valor['modulo_id'],
	            'role_id' 	=> $valor['role_id']
	        ]);
    	}
    }
}
