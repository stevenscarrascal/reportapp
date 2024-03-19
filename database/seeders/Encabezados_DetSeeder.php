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
        encabezados_dets::create([
            'encabezados_id' => '3',
            'nombre' => 'Sin Anomalias',
            'nomenclatura'=>'NA'
        ]);
        encabezados_dets::create([
            'encabezados_id' => '3',
            'nombre' => 'Bypass',
            'nomenclatura'=>'BY'
        ]);

        encabezados_dets::create([
            'encabezados_id' => '3',
            'nombre' => 'Medidor al revés (invertido)',
            'nomenclatura'=>'MRI'
        ]);

        encabezados_dets::create([
            'encabezados_id' => '3',
            'nombre' => 'Medidor manipulado (sellos)',
            'nomenclatura'=>'MMS'
        ]);

        encabezados_dets::create([
            'encabezados_id' => '3',
            'nombre' => 'Medidor sin sellos o rotos',
            'nomenclatura'=>'MSSR'
        ]);

        encabezados_dets::create([
            'encabezados_id' => '3',
            'nombre' => 'Medidor sin talco',
            'nomenclatura'=>'MST'
        ]);

        encabezados_dets::create([
            'encabezados_id' => '3',
            'nombre' => 'Medidor enterrado',
            'nomenclatura'=>'ME'
        ]);

        encabezados_dets::create([
            'encabezados_id' => '3',
            'nombre' => 'Conexión directa',
            'nomenclatura'=>'CD'
        ]);

        encabezados_dets::create([
            'encabezados_id' => '3',
            'nombre' => 'Medidor frenado',
            'nomenclatura'=>'MF'
        ]);

        encabezados_dets::create([
            'encabezados_id' => '3',
            'nombre' => 'Medidor gira hacia atrás',
            'nomenclatura'=>'MGHA'
        ]);

        encabezados_dets::create([
            'encabezados_id' => '3',
            'nombre' => 'Medidor fuera de ruta',
            'nomenclatura'=>'MFR'
        ]);

        encabezados_dets::create([
            'encabezados_id' => '3',
            'nombre' => 'Medidor trocado',
            'nomenclatura'=>'MT'
        ]);


    }
}
