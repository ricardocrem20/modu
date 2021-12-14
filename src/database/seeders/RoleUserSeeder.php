<?php

namespace Ricardo\Modu\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleUserSeeder extends Seeder
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
				'role_id' => 1,
				'user_id' => 1
			]
		];

		foreach ($requests as $valor) {
	        DB::table('role_user')->insert([
	            'role_id' => $valor['role_id'],
	            'user_id' => $valor['user_id']
	        ]);
    	}
    }
}
