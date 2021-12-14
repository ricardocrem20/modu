<?php

namespace Ricardo\Modu\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermisoUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($x = 1; $x <= 25; $x++) {
	        DB::table('permiso_user')->insert([
	            'permiso_id' => $x,
	            'user_id'    => 1
	        ]);
    	}
    }
}
