<?php

namespace App\Exports;

use App\Models\reportes;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;


class ReportExport implements FromCollection,WithHeadings
{
    protected $reporteIds;

    public function __construct($reporteIds)
    {
        $this->reporteIds = $reporteIds;
    }

    public function collection()
    {
        return Reportes::with(['ComercioReporte', 'AnomaliaReporte','imposibilidadReporte','EstadoReporte','personal'])
        ->whereIn('id', $this->reporteIds)
        ->get()
        ->map(function ($reporte) {
            return [
                $reporte->personal->nombres,
                $reporte->personal->apellidos,
                $reporte->contrato,
                $reporte->lectura,
                $reporte->direccion,
                $reporte->AnomaliaReporte->nombre,
                $reporte->imposibilidadReporte->nombre,
                $reporte->ComercioReporte->nombre,
                $reporte->EstadoReporte->nombre,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Nombres',
            'Apellidos',
            'Contrato',
            'Lectura',
            'Dirección',
            'Anomalía',
            'Imposibilidad',
            'Comercio',
            'Estado',
        ];
    }
}
