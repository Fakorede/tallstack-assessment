<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\FromQuery;

class PatientsExport implements FromQuery, WithMapping, WithHeadings
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
            'Previous BP Record',
        ];
    }

    public function map($patient): array
    {
        return [
            $patient->first_name,
            $patient->last_name,
            $patient->gender,
            $patient->address,
            $patient->mobile_number,
            $patient->email,
            optional($patient->records->last())->bp_observation ?? '-',
        ];
    }

    public function query(): Builder
    {
        return $this->builder;
    }
}
