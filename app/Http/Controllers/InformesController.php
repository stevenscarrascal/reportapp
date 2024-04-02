<?php

namespace App\Http\Controllers;

use App\Models\reportes;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Fx\Chartjs\Factory\Chartjs;
use Illuminate\Support\Facades\DB;

class InformesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // Obtén los informes de cada mes
        $reports = reportes::select(DB::raw('MONTH(created_at) as month'), DB::raw('count(*) as count'))
            ->groupBy('month')
            ->get();

        // Prepara los datos para el gráfico
        $labels = [];
        $data = [];
        foreach ($reports as $report) {
            $labels[] = date('F', mktime(0, 0, 0, $report->month, 15)); // Convierte el número del mes a nombre del mes
            $data[] = $report->count;
        }

        // Define los colores para cada mes
        $backgroundColors = [
            "rgba(255, 99, 132, 0.2)", // Enero
            "rgba(54, 162, 235, 0.2)", // Febrero
            "rgba(255, 206, 86, 0.2)", // Marzo
            "rgba(75, 192, 192, 0.2)", // Abril
            "rgba(153, 102, 255, 0.2)", // Mayo
            "rgba(255, 159, 64, 0.2)", // Junio
            "rgba(255, 99, 132, 0.2)", // Julio
            "rgba(54, 162, 235, 0.2)", // Agosto
            "rgba(255, 206, 86, 0.2)", // Septiembre
            "rgba(75, 192, 192, 0.2)", // Octubre
            "rgba(153, 102, 255, 0.2)", // Noviembre
            "rgba(255, 159, 64, 0.2)" // Diciembre
        ];

        $borderColors = [
            "rgba(255, 99, 132, 1)", // Enero
            "rgba(54, 162, 235, 1)", // Febrero
            "rgba(255, 206, 86, 1)", // Marzo
            "rgba(75, 192, 192, 1)", // Abril
            "rgba(153, 102, 255, 1)", // Mayo
            "rgba(255, 159, 64, 1)", // Junio
            "rgba(255, 99, 132, 1)", // Julio
            "rgba(54, 162, 235, 1)", // Agosto
            "rgba(255, 206, 86, 1)", // Septiembre
            "rgba(75, 192, 192, 1)", // Octubre
            "rgba(153, 102, 255, 1)", // Noviembre
            "rgba(255, 159, 64, 1)" // Diciembre
        ];

        // Crea el gráfico
        $rpgenerales = app()->chartjs
            ->name('lineChartTest2')
            ->type('line')
            ->size(['width' => 400, 'height' => 200])
            ->labels($labels)
            ->datasets([
                [
                    "label" => "Reportes por mes",
                    'backgroundColor' => $backgroundColors,
                    'borderColor' => $borderColors,
                    "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                    "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                    "pointHoverBackgroundColor" => "#fff",
                    "pointHoverBorderColor" => "rgba(220,220,220,1)",
                    'data' => $data,
                ]
            ])
            ->options([
                'scales' => [
                    'x' => [
                        'title' => [
                            'display' => true,
                            'text' => 'Mes'
                        ],
                    ]
                ]
            ]);


        $reports = reportes::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->get()
            ->groupBy(function ($date) {
                return Carbon::parse($date->created_at)->format('l'); // Agrupa por día de la semana
            });

        // Prepara los datos para el gráfico
        $labels = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        $data = [];

        foreach ($labels as $label) {
            $data[] = $reports->get($label) ? $reports->get($label)->count() : 0; // Si no hay informes para un día específico, añade 0
        }

        $backgroundColors = [
            "rgba(255, 99, 132, 0.2)", // Lunes
            "rgba(54, 162, 235, 0.2)", // Martes
            "rgba(255, 206, 86, 0.2)", // Miércoles
            "rgba(75, 192, 192, 0.2)", // Jueves
            "rgba(153, 102, 255, 0.2)", // Viernes
            "rgba(255, 159, 64, 0.2)", // Sábado
            "rgba(255, 99, 132, 0.2)" // Domingo
        ];

        $borderColors = [
            "rgba(255, 99, 132, 1)", // Lunes
            "rgba(54, 162, 235, 1)", // Martes
            "rgba(255, 206, 86, 1)", // Miércoles
            "rgba(75, 192, 192, 1)", // Jueves
            "rgba(153, 102, 255, 1)", // Viernes
            "rgba(255, 159, 64, 1)", // Sábado
            "rgba(255, 99, 132, 1)" // Domingo
        ];

        // Crea el gráfico
        $chartjs = app()->chartjs
            ->name('lineChartTest')
            ->type('bar')
            ->size(['width' => 400, 'height' => 200])
            ->labels($labels)
            ->datasets([
                [
                    "label" => "Reportes diarios",
                    'backgroundColor' => $backgroundColors,
                    'borderColor' => $borderColors,
                    "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                    "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                    "pointHoverBackgroundColor" => "#fff",
                    "pointHoverBorderColor" => "rgba(220,220,220,1)",
                    'data' => $data,
                ]
            ])
            ->options([
                'scales' => [
                    'x' => [
                        'title' => [
                            'display' => true,
                            'text' => 'Días de la semana'
                        ],
                    ]
                ]
            ]);

        // Obtén los reportes
        $reportes = reportes::all();

        // Inicializa un array para almacenar los conteos de anomalías
        $anomaliesCounts = [];

        // Recorre los reportes
        foreach ($reportes as $reporte) {
            // Decodifica el campo de anomalías
            $anomalies = json_decode($reporte->anomalia);

            // Obtiene la fecha del reporte
            $date = $reporte->created_at->toDateString();

            // Inicializa un contador para las anomalías que no son "8"
            $count = 0;

            // Recorre las anomalías
            foreach ($anomalies as $anomaly) {
                // Si la anomalía no es "8", incrementa el contador
                if ($anomaly != 8) {
                    $count++;
                }
            }

            // Si la fecha ya existe en el array de conteos, incrementa el conteo
            // por el número de anomalías en este reporte que no son "8"
            if (isset($anomaliesCounts[$date])) {
                $anomaliesCounts[$date] += $count;
            }
            // Si no, inicializa el conteo para esa fecha con el número de anomalías que no son "8"
            else {
                $anomaliesCounts[$date] = $count;
            }
        }

        // Ordena el array de conteos por fecha
        ksort($anomaliesCounts);

        // Extrae las fechas y los conteos
        $dates = array_keys($anomaliesCounts);
        $counts = array_values($anomaliesCounts);
        // Transforma las fechas en días de la semana
        $daysOfWeek = array_map(function ($date) {
            return date('l', strtotime($date));
        }, $dates);


        // Crea el gráfico
        $chartjs3 = app()->chartjs
            ->name('anomaliesChart')
            ->type('line')
            ->size(['width' => 400, 'height' => 200])
            ->labels($daysOfWeek)
            ->datasets([
                [
                    "label" => "Anomalías diarias",
                    'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                    'borderColor' => "rgba(38, 185, 154, 0.7)",
                    "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                    "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                    "pointHoverBackgroundColor" => "#fff",
                    "pointHoverBorderColor" => "rgba(220,220,220,1)",
                    'data' => $counts,
                ]
            ])
            ->options([
                'scales' => [
                    'x' => [
                        'title' => [
                            'display' => true,
                            'text' => 'Días de la semana'
                        ],
                    ]
                ]
            ]);

            $today = Carbon::now()->format('Y-m-d');
           $reports = reportes::select(DB::raw('DATE(created_at) as date'), 'personal_id', DB::raw('count(*) as count'))
            ->whereDate('created_at', $today)
            ->groupBy('date', 'personal_id')
            ->get();

        // Prepara los datos para el gráfico
        $labels = [];
        $data = [];
        foreach ($reports as $report) {
            $labels[] = $report->personal->nombres . ' - ' . date('d-m-Y', strtotime($report->date)); // Convierte la fecha a formato día-mes-año
            $data[] = $report->count;
        }

        $backgroundColors = [
            "rgba(255, 99, 132, 0.2)", // Lunes
            "rgba(54, 162, 235, 0.2)", // Martes
            "rgba(255, 206, 86, 0.2)", // Miércoles
            "rgba(75, 192, 192, 0.2)", // Jueves
            "rgba(153, 102, 255, 0.2)", // Viernes
            "rgba(255, 159, 64, 0.2)", // Sábado
            "rgba(255, 99, 132, 0.2)" // Domingo
        ];

        $borderColors = [
            "rgba(255, 99, 132, 1)", // Lunes
            "rgba(54, 162, 235, 1)", // Martes
            "rgba(255, 206, 86, 1)", // Miércoles
            "rgba(75, 192, 192, 1)", // Jueves
            "rgba(153, 102, 255, 1)", // Viernes
            "rgba(255, 159, 64, 1)", // Sábado
            "rgba(255, 99, 132, 1)" // Domingo
        ];

        // Crea el gráfico
        $gfpersonald = app()->chartjs
            ->name('lineChartTest4')
            ->type('bar')
            ->size(['width' => 400, 'height' => 200])
            ->labels($labels)
            ->datasets([
                [
                    "label" => "Reportes diarios",
                    'backgroundColor' => $backgroundColors,
                    'borderColor' => $borderColors,
                    "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                    "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                    "pointHoverBackgroundColor" => "#fff",
                    "pointHoverBorderColor" => "rgba(220,220,220,1)",
                    'data' => $data,
                ]
            ])
            ->options([
                'scales' => [
                    'x' => [
                        'title' => [
                            'display' => true,
                            'text' => 'Días de la semana'
                        ],
                    ]
                ]
            ]);

        return view('informes.informeGeneral', compact('rpgenerales', 'chartjs', 'chartjs3','gfpersonald'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
