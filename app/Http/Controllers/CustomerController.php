<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Http\Resources\CustomerResources;
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
        //
        $customers = Customer::paginate(10);
        return CustomerResources::collection($customers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        Customer::create([
            "name_customer" => $request->name_customer,
            "phone_customer" => $request->phone_customer,
            "email_customer" => $request->email_customer,
            "city_customer" => $request->city_customer,
            "address_customer" => $request->address_customer,
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
        return new CustomerResources($customer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        //
        $customer->update([
            "name_customer" => $request->name_customer,
            "phone_customer" => $request->phone_customer,
            "email_customer" => $request->email_customer,
            "city_customer" => $request->city_customer,
            "address_customer" => $request->address_customer,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
        $customer->delete();
        
    }
}
