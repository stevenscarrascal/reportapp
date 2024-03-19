<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'name' => 'Administrador',
            'guard_name' => 'web',
            'estado' => 1,
        ]);
        Role::create([
            'name' => 'Coordinador',
            'guard_name' => 'web',
            'estado' => 1,
        ]);
        Role::create([
            'name' => 'Agente de campo',
            'guard_name' => 'web',
            'estado' => 1,
        ]);
    }
}
