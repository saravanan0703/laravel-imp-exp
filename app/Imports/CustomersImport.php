<?php

namespace App\Imports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Log;

class CustomersImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $customer = Customer::where('email', $row['email'])->first();

        if ($customer) {
            $customer->update([
                'name' => $row['name'],
                'phone' => $row['phone'],
            ]);
            return null; 
        }

        return new Customer([
            'name'  => $row['name'],
            'email' => $row['email'],
            'phone' => $row['phone'],
        ]);
    }
}
