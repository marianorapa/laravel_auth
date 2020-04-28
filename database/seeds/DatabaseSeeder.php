<?php

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
        $this->call(PersonaTableSeeder::class);
        $this->call(PermisoTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(RolePermisosSeeder::class);

        $this->call(TipoDocumentoTableSeeder::class);
        $this->call(ProvinciaTableSeeder::class);
    }
}
