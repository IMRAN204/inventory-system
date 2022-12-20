<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Customer::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $customer = Customer::where('mail', '=', $request->input('mail'))->first();
        if ($customer) {
            return response()->json(['msg' => 'Customer already exist']);
        }
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required|numeric',
            'mail' => 'required|email',
            'address' => 'required',
        ]);
        $data =[
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'mail' => $request->input('mail'),
            'address' => $request->input('address'),
        ];
        Customer::create($data);
        return response()->json(['msg' => 'Customer added successfully']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        return $customer;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        if($customer)
        {
            $this->validate($request, [
                'name' => 'required',
                'phone' => 'required|numeric',
                'mail' => 'required|email',
                'address' => 'required',
            ]);
            $data =[
                'name' => $request->input('name'),
                'phone' => $request->input('phone'),
                'mail' => $request->input('mail'),
                'address' => $request->input('address'),
            ];
            $customer->update($data);
            return response()->json(['msg' => 'Customer updated successfully']);
        }
        else{
            return response()->json(['msg' => 'Customer does not exist']);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return response()->json(['msg' => 'Customer Deleted Successfully']);
    }
}
