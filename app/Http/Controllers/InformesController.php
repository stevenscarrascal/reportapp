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

        // Crea el gráfico
        $chartjs2 = app()->chartjs
            ->name('lineChartTest2')
            ->type('line')
            ->size(['width' => 400, 'height' => 200])
            ->labels($labels)
            ->datasets([
                [
                    "label" => "Reportes por mes",
                    'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                    'borderColor' => "rgba(38, 185, 154, 0.7)",
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
            ->groupBy(function($date) {
                return Carbon::parse($date->created_at)->format('l'); // Agrupa por día de la semana
            });

        // Prepara los datos para el gráfico
        $labels = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        $data = [];

        foreach ($labels as $label) {
            $data[] = $reports->get($label) ? $reports->get($label)->count() : 0; // Si no hay informes para un día específico, añade 0
        }

        // Crea el gráfico
        $chartjs = app()->chartjs
            ->name('lineChartTest')
            ->type('bar')
            ->size(['width' => 400, 'height' => 200])
            ->labels($labels)
            ->datasets([
                [
                    "label" => "Reportes diarios",
                    'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                    'borderColor' => "rgba(38, 185, 154, 0.7)",
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
        return view('informes.informeGeneral', compact('chartjs', 'chartjs2'));
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
