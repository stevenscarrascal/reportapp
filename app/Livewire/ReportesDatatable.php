<?php

namespace App\Livewire;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Reportes;



class ReportesDatatable extends DataTableComponent
{
    protected $model = Reportes::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function filters(): array
{
    return [
        SelectFilter::make('Estados')
            ->options([
                '' => 'All',
                '5' => 'Pendientes',
                '6' => 'Revisados',
                '7' => 'Rechazados',
            ])
            ->filter(function(Builder $builder, $value) {
                if ($value === '5') {
                    $builder->where('reportes.estado', '5');
                } elseif ($value === '6') {
                    $builder->where('reportes.estado', '6');
                } elseif ($value === '7') {
                    $builder->where('reportes.estado', '7');
                }
            }),
    ];
}

    public function columns(): array
    {
        return [
            Column::make("Nombres", "personal.nombres")
                ->sortable(),
            Column::make("Apellidos", "personal.apellidos")
                ->sortable(),
            Column::make("Contrato", "contrato")
                ->sortable(),
            Column::make("Lectura", "lectura")
                ->sortable(),
            Column::make("Anomalia", "AnomaliaReporte.nombre")
                ->sortable(),
            Column::make("Direccion", "direccion")
                ->sortable(),
            Column::make("Tipo de comercio", "ComercioReporte.nombre")
                ->sortable(),
            Column::make("Estado", "EstadoReporte.nombre"),
            Column::make("Fecha", "created_at")
                ->sortable(),
        ];
    }
}
