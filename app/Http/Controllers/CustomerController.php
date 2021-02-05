<?php

namespace App\Http\Controllers;

use App\Http\Resources\Customers;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customer = Customer::all();

        return response()->json(
            Customers::collection($customer)
        );
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'code' => 'required',
            'name' => 'required',
            'avatar' => 'required|file',
            'birthday' => 'required|date'
        ]);

        $avatar = $data['avatar'];

        $avatarPath = $avatar->storeAs('public/avatars', $avatar->getClientOriginalName());

        $customer = Customer::create([
            'code' => $data['code'],
            'name' => $data['name'],
            'birthday' => $data['birthday'],
            'avatar' => $avatarPath
        ]);

        return response()->json(new Customers($customer), 201);
    }

    public function show(Customer $customer)
    {

        return response()->json(
            Customers::make($customer)
        );
    }

    public function update(Customer $customer, Request $request)
    {
        $data = $request->validate([
            'code' => 'required',
            'name' => 'required',
            'birthday' => 'required'
        ]);

        $customer->update($data);

        return response()->json(new Customers($customer->fresh()), 201);
    }
}
