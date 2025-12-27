<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    public function index()
    {
        return Customer::all();
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string|unique:costumer,phone',
        ]);

        $customer = Customer::create($data);

        return response()->json($customer, 201);
    }


    public function show(Customer $customer)
    {
        return $customer;
    }


    public function update(Request $request, Customer $customer)
    {
        $data = $request->validate([
            'name' => 'sometimes|required|string',
            'phone' => 'sometimes|required|string|unique:costumer,phone,' . $customer->id,
        ]);

        $customer->update($data);

        return response()->json($customer);
    }


    public function destroy(Customer $customer)
    {
        $customer->delete();
        return response()->json(['message' => 'Customer deleted']);
    }
}
