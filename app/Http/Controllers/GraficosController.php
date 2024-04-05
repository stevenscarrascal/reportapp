<?php

namespace App\Http\Controllers;

use App\Models\personals;
use App\Models\reportes;
use App\Models\vs_anomalias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GraficosController extends Controller
{
        public function ConteoRegistrosxDia()
    {
        //variables para obtener la fecha actual y el rango de la semana
        $today = date('Y-m-d');
        $inicioSemana = date('Y-m-d', strtotime('monday this week'));
        $finSemana = date('Y-m-d', strtotime('sunday this week'));

        // Consulta para obtener el conteo de reportes por día de la semana
        $dia = DB::table('reportes')
            ->select(DB::raw("count(*) as count,
        CASE
            WHEN DAYOFWEEK(created_at) = 1 THEN 'Domingo'
            WHEN DAYOFWEEK(created_at) = 2 THEN 'Lunes'
            WHEN DAYOFWEEK(created_at) = 3 THEN 'Martes'
            WHEN DAYOFWEEK(created_at) = 4 THEN 'Miércoles'
            WHEN DAYOFWEEK(created_at) = 5 THEN 'Jueves'
            WHEN DAYOFWEEK(created_at) = 6 THEN 'Viernes'
            WHEN DAYOFWEEK(created_at) = 7 THEN 'Sábado'
        END as day"))
            ->whereBetween('created_at', [$inicioSemana, $finSemana])
            ->groupBy('day')
            ->get();
        // fin de la consulta

        //consulta para obtener el conteo de anomalías por día
        $anomalis = DB::table('reportes')
            ->whereDate('created_at', $today)
            ->select('anomalia', 'created_at')
            ->get();

        $counts = [];
        $anomaliaNames = [];

        foreach ($anomalis as $row) {
            $anomalias = json_decode($row->anomalia);
            foreach ($anomalias as $anomalia) {
                if (!isset($counts[$anomalia])) {
                    $counts[$anomalia] = 0;
                    // Aquí utilizamos la relación para obtener el nombre de la anomalía
                    $anomaliaNames[$anomalia] = vs_anomalias::find($anomalia)->nombre;
                }
                $counts[$anomalia]++;
            }
        }

        // Aquí combinamos los nombres de las anomalías con sus respectivos conteos
        $anomalia = [];
        foreach ($counts as $anomalia => $count) {
            $anomalies[] = ['nombre' => $anomaliaNames[$anomalia], 'count' => $count];
        }
        // fin de la consulta

        //consulta para obtener el conteo de reportes por personal
        $personals = DB::table('reportes')
            ->join('personals', 'reportes.personal_id', '=', 'personals.id') // Unir con la tabla personals
            ->whereDate('reportes.created_at', '=', date('Y-m-d')) // Filtrar por la fecha actual
            ->select(DB::raw("count(*) as count, personal_id, personals.nombres as personal_name")) // Incluir el nombre del personal
            ->groupBy('personal_id')
            ->get();


        // fin de la consulta
        // dd($personals);

        return view('informes.informeDia', compact('dia', 'anomalies', 'personals'));
    }

    public function ReportesTotalesxmes()
    {
        $reportes = reportes::select(DB::raw('count(lectura) as total'), DB::raw('MONTH(created_at) as mes'))
            ->whereYear('created_at', date('Y'))
            ->groupBy('mes')
            ->get();

        return view('informes.informeGeneral', compact('reportes'));
    }
}
