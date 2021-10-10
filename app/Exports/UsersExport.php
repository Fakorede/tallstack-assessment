<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\FromQuery;

class UsersExport implements FromQuery, WithMapping, WithHeadings
{
    use Exportable;

    public Builder $builder;

    public function __construct(Builder $builder)
    {
        $this->builder = $builder;
    }

    public function headings(): array
    {
        return [
            'First Name',
            'Last Name',
            'Gender',
            'Address',
            'Mobile Number',
            'Email',
            'Role',
        ];
    }

    public function map($staff): array
    {
        return [
            $staff->first_name,
            $staff->last_name,
            $staff->gender,
            $staff->address,
            $staff->mobile_number,
            $staff->email,
            $staff->role->name,
        ];
    }

    public function query(): Builder
    {
        return $this->builder;
    }
}
