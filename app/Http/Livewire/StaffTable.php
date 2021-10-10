<?php

namespace App\Http\Livewire;

use App\Exports\UsersExport;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\User;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class StaffTable extends DataTableComponent
{
    public string $defaultSortColumn = 'first_name';
    public string $defaultSortDirection = 'asc';

    public array $bulkActions = [
        'exportSelected' => 'Export',
    ];

    public function exportSelected()
    {
        if (auth()->user()->can('export-staff-data')) {
            if (count($this->selectedKeys)) {
                $time = Carbon::now()->toDateTimeString();
                return Excel::download(new UsersExport($this->selectedRowsQuery), "staff_{$time}.csv");
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
            Column::make('Gender', 'gender')
                ->sortable(),
            Column::make('E-mail', 'email'),
            Column::make('Phone Number', 'mobile_number'),
            Column::make('Role', 'role.name')
                ->searchable(),
        ];
    }

    public function query(): Builder
    {
        return User::query();
    }
}
