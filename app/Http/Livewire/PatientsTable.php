<?php

namespace App\Http\Livewire;

use App\Exports\PatientsExport;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Patient;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class PatientsTable extends DataTableComponent
{
    public string $defaultSortColumn = 'first_name';
    public string $defaultSortDirection = 'asc';

    public array $bulkActions = [
        'exportSelected' => 'Export',
    ];

    public function exportSelected()
    {
        if (auth()->user()->can('export-patient-data')) {
            if (count($this->selectedKeys)) {
                $time = Carbon::now()->toDateTimeString();
                return Excel::download(new PatientsExport($this->selectedRowsQuery), "patients_{$time}.csv");
            }
        }
    }

    public function columns(): array
    {
        return [
            Column::make('First Name', 'first_name')
                ->sortable()
                ->searchable(),
            Column::make('Last Name', 'last_name')
                ->sortable()
                ->searchable(),
            Column::make('Gender')
                ->sortable(),
            Column::make('E-mail', 'email'),
            Column::make('Phone Number', 'mobile_number'),
            Column::make('Address'),
            Column::make('Previous BP Reading', 'last_record'),
            Column::make('Actions')
            ->format(function($value, $column, $row) {
                return '<a href=' . "/patient/{$row->id}/add-observation" . '>' . 'Record Observation' . '</a>';
            })
            ->asHtml(),
        ];
    }

    public function query(): Builder
    {
        return Patient::query();
    }
}
