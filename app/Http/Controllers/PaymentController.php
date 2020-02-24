<?php

namespace App\Http\Controllers;
use App\Payment;
use App\Customer;
use App\Vehicle;
use Illuminate\Http\Request;

use Carbon\Carbon;
use DB;
class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($email)
    {    
        return DB::table('payments')
        ->join('customers','customers.id','payments.customers_id')        
        ->join('customer_requests','customer_requests.id','payments.customers_request_id')
        ->where('customers.email',$email)->select('payments.date','payments.time','payments.total_payment','customers.*')->get();
    }

    public function getPaymentDetails(Request $request)
    {
        $count = $request->rpp;
        return DB::table('payments')
        ->join('customer_requests','customer_requests.id','payments.customers_request_id')        
        ->join('areas','areas.id','customer_requests.area_id')
        ->join('vehicle_types','vehicle_types.id','customer_requests.vehicle_type_id')
        ->join('categories','categories.id','customer_requests.category_id')
        ->where('payments.status_id',8)
        ->select('payments.id','payments.name as holder_name','customer_requests.email',
        'customer_requests.tele_no','areas.name as area_name',
        'categories.name as cate_name','vehicle_types.type_code as v_type',
       'customer_requests.address_1','customer_requests.address_2','customer_requests.address_3'
       ,'payments.date','payments.total_payment','payments.status_id as p_status')
        ->paginate($count);
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
         
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
