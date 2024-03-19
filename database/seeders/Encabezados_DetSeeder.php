<?php

namespace Database\Seeders;

use App\Models\encabezados_dets;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Encabezados_DetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Campos a seleccionar en las diferentes opciones de registro
        encabezados_dets::create([
            'encabezados_id' => '1',
            'nombre' => 'Cedula de Ciudadania',
            'nomenclatura'=>'CC'
        ]);
        encabezados_dets::create([
            'encabezados_id' => '1',
            'nombre' => 'Permiso de Permanencia',
            'nomenclatura'=>'PPT'
        ]);
        encabezados_dets::create([
            'encabezados_id' => '2',
            'nombre' => 'Activo',
            'nomenclatura'=>'AC'
        ]);
        encabezados_dets::create([
            'encabezados_id' => '2',
            'nombre' => 'Inactivo',
            'nomenclatura'=>'IN'
        ]);
        encabezados_dets::create([
            'encabezados_id' => '2',
            'nombre' => 'Pendiente',
            'nomenclatura'=>'PD'
        ]);
        encabezados_dets::create([
            'encabezados_id' => '2',
            'nombre' => 'Revisado',
            'nomenclatura'=>'RV'
        ]);
        encabezados_dets::create([
            'encabezados_id' => '2',
            'nombre' => 'Rechazado',
            'nomenclatura'=>'RC'
        ]);


    }
}
