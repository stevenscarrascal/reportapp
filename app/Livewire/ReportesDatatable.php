<?php

namespace App\Livewire;

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
        'pendiente' => 'Pendientes',
        'rechazado' => 'Rechazados',
        'revisado' => 'Revisados',
    ])
    ->filter(function(Builder $builder, string $value) {
        if ($value === 'pendiente') {
            $builder->whereHas('estado', function (Builder $query) {
                $query->where('es', 'Pendiente');
            });
        } elseif ($value === 'rechazado') {
            $builder->whereHas('EstadoReporte', function (Builder $query) {
                $query->where('nombre', 'rechazado');
            });
        }elseif ($value === 'revisado') {
            $builder->whereHas('EstadoReporte', function (Builder $query) {
                $query->where('nombre','revisado');
            });
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
            Column::make("Estado", "EstadoReporte.nombre")
                ->sortable(),

            Column::make("Fecha", "created_at")
                ->sortable(),
        ];
    }
}
