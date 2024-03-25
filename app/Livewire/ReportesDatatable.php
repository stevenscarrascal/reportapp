<?php

namespace App\Livewire;

use App\Exports\ReportExport;
use Maatwebsite\Excel\Facades\Excel;
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
        $this->setColumnSelectStatus(false);
        $this->setPerPage(10);
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
                ->filter(function (Builder $builder, $value) {
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
            Column::make("Nombres", "personal.nombres"),
            Column::make("Apellidos", "personal.apellidos"),
            Column::make("Contrato", "contrato")
                ->searchable(),
            Column::make("Lectura", "lectura")
                ->collapseOnMobile(),
            Column::make("Anomalia", "AnomaliaReporte.nombre")
                ->collapseOnMobile(),
            Column::make("Direccion", "direccion")
                ->collapseAlways()
                ->searchable(),
            Column::make("Comercio", "ComercioReporte.nombre")
                ->collapseAlways(),
            Column::make("Estado", "estado")
                ->format(
                    fn ($value, $row, Column $column) => match ($value) {
                        '5' => '<span class="badge badge-warning">Pendiente</span>',
                        '6' => '<span class="badge badge-success">Revisado</span>',
                        '7' => '<span class="badge badge-danger">Rechazado</span>',
                    }
                )
                ->html()
                ->collapseOnMobile(),
            Column::make("Fecha", "created_at")
                ->format(fn ($value) => $value->format('d/M/Y'))
                ->collapseOnMobile(),
            Column::make('Acciones', 'id')
                ->format(
                    fn ($value, $row, Column $column) => view('dashboard.actions',compact('value'))
                ),
        ];
    }

    public function bulkActions(): array
    {
        return [
            'export' => 'Exportar a Excel',
        ];
    }

    public function export()
    {
        $users = $this->getSelected();

        $this->clearSelected();

        $date = now()->format('Y-m-d H:i:s');

        return Excel::download(new ReportExport($users), $date . '.xlsx');
    }
}
