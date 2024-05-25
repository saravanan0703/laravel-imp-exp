<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CustomersExport;
use App\Imports\CustomersImport;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        return view('customers.index', compact('customers'));
    }

    public function export()
    {
        return Excel::download(new CustomersExport, 'customers.xlsx');
    }

    public function import(Request $request)
    {
        Excel::import(new CustomersImport, $request->file('file'));
        return redirect()->back()->with('success', 'Customers imported successfully.');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:customers',
            'phone' => 'required',
        ]);

        if ($validator->fails()) {
            // Redirect back with error messages
            return redirect()->back()->with('error', 'The email address already exists.');
        }
        try {
            $existingCustomer = Customer::where('email', $request->email)->first();
            if ($existingCustomer) {
                return redirect()->back()->with('error', 'The email address already exists.');
            }
            else {
                Customer::create($request->except('_token'));
                return redirect()->back()->with('success', 'Customer added successfully.');
            }
            
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'An error occurred while adding the customer.');
        }
        
    }
}
