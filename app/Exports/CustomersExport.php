<?php

namespace App\Exports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CustomersExport implements FromCollection, WithHeadings
{
    /**
     * Return a collection of customers.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Customer::all();
    }

    /**
     * Return the headings for the Excel file.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Email',
            'Phone',
            'Created At',
            'Updated At'
        ];
    }
}
