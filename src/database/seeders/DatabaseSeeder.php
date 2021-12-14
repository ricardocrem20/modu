<?php

namespace Ricardo\Modu\Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ModuloSeeder::class);
        $this->call(AreaSeeder::class);
        $this->call(PermisoSeeder::class);
        $this->call(TipoRoleSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(RoleTipoRoleSeeder::class);
        $this->call(ModuloRoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(RoleUserSeeder::class);
        $this->call(PermisoUserSeeder::class);
    }
}
