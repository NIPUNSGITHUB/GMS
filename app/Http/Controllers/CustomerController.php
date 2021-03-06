<?php

namespace App\Http\Controllers;

use App\Customer;
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
        return Customer::where('email',$email)->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all()
    {
        return Customer::orderBy('id','DESC')->get();
        
    }

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
        $email = Customer::where('email',$request->email)->count();
       if($email > 0)
       {
        return response($request,200);
       }
       else
       {
        try 
        {
                $customer = new Customer();
                $customer->email = $request->email;
                $customer->first_name = $request->first_name;
                $customer->last_name = $request->last_name;
                $customer->nic = $request->nic;
                $customer->telephone_no = $request->telephone_no;
                $customer->address_line_1 = $request->address_line_1;
                $customer->address_line_2 = $request->address_line_2;
                $customer->address_line_3 = $request->address_line_3;
                $customer->email = $request->email;
                $result = $customer->save();

                if ($result)
                    return response($request,200);
                else
                    return '0';
            } catch (Exception $th) {
                return response($th->getException(),488);
            }
        }   
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
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
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        //
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
    }
}
