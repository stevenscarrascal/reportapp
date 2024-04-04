<?php

namespace App\Http\Controllers;

use App\Models\reportes;
use App\Models\vs_anomalias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GraficosController extends Controller
{
    public function ConteoRegistrosxMes()
    {
        $mes = DB::table('reportes')
            ->select(DB::raw("count(*) as count, DATE_FORMAT(created_at, '%M') as month"))
            ->groupBy('month')
            ->get();

        $monthsInEnglish = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $monthsInSpanish = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

        $labels = $mes->pluck('month')->map(function ($month) use ($monthsInEnglish, $monthsInSpanish) {
            $index = array_search($month, $monthsInEnglish);
            return $monthsInSpanish[$index];
        });

        return json_encode(['mes' => $mes, 'labels' => $labels]);
    }

    public function ConteoRegistrosxDia()
    {
        $dia = DB::table('reportes')
            ->select(DB::raw("count(*) as count, DATE_FORMAT(created_at, '%W') as day"))
            ->groupBy('day')
            ->get();

        $daysInEnglish = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        $daysInSpanish = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];

        $labels = $dia->pluck('day')->map(function ($day) use ($daysInEnglish, $daysInSpanish) {
            $index = array_search($day, $daysInEnglish);
            return $daysInSpanish[$index];
        });

        return json_encode(['dia' => $dia, 'labels' => $labels]);
    }

    public function ConteoAnomaliasxMes()
    {
        $reportes = reportes::select(DB::raw("DATE_FORMAT(created_at, '%M') as month, anomalia"))
            ->get();

        $anomalias = collect();
        foreach ($reportes as $reporte) {
            $anomaliasDecoded = json_decode($reporte->anomalia);
            foreach ($anomaliasDecoded as $anomalia) {
                if ($anomalia != 8) {
                    $anomalias->push(['month' => $reporte->month, 'anomalia' => $anomalia]);
                }
            }
        }

        $data = $anomalias->groupBy(['month', 'anomalia'])->map(function ($items, $key) {
            return count($items);
        });

        $monthsInEnglish = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $monthsInSpanish = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

        $labels = $data->keys()->map(function ($month) use ($monthsInEnglish, $monthsInSpanish) {
            $index = array_search($month, $monthsInEnglish);
            return $monthsInSpanish[$index];
        });
        return response()->json(['data' => $data, 'labels' => $labels]);
    }

    public function ConteoPersonasDia()
    {
        $result = DB::table('reportes')
            ->join('personals', 'reportes.personal_id', '=', 'personals.id') // Unir con la tabla personals
            ->whereDate('reportes.created_at', '=', date('Y-m-d')) // Filtrar por la fecha actual
            ->select(DB::raw("count(*) as count, personal_id, personals.nombres as personal_name")) // Incluir el nombre del personal
            ->groupBy('personal_id')
            ->get();

        $data = $result->pluck('count'); // Extraer solo el conteo
        $personalNames = $result->pluck('personal_name'); // Extraer solo los nombres del personal

        $daysInEnglish = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        $daysInSpanish = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];

        $dayInEnglish = date('l'); // Obtener el día actual en inglés
        $index = array_search($dayInEnglish, $daysInEnglish);
        $labels = $daysInSpanish[$index]; // Traducir el día al español

        return json_encode(['data' => $data, 'names' => $personalNames, 'label' => $labels]);
    }
}
