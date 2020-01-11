<?php

namespace App\Http\Controllers;

use App\PaymentVoucher;
use App\Customer;
use Illuminate\Http\Request;
use DB;

class PaymentVoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $payment_vouchers = PaymentVoucher::where('deleted', false)->where(function($q) use ($request) {
                if ($request->has('customer_id') and $request->customer_id) {
                    $q->where('customer_id', $request->customer_id);
                }
                if ($request->has('month_date') and $request->month_date) {
                    $q->where('month_date', $request->month_date);
                }
        })->paginate(30);
        
        $customers = Customer::all()->where('deleted', false);
        
        return view('payment_vouchers.index',compact('payment_vouchers','request','customers'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::all()->where('deleted', false);
        return view('payment_vouchers.create',compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(PaymentVoucher::rules(), PaymentVoucher::messages());

  
        PaymentVoucher::create($request->all());
   
        return redirect()->route('payment_vouchers.index')
                        ->with('success','Payment voucher added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $payment_vouchers = PaymentVoucher::where('id', $id)->with('Customer')->first();
      
        return view('payment_vouchers.show',compact('payment_vouchers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customers = Customer::all()->where('deleted', false);
        $payment_voucher = PaymentVoucher::where('id', $id)->with('Customer')->first();
        return view('payment_vouchers.edit',compact('payment_voucher', 'customers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaymentVoucher $payment_voucher)
    {
        $request->validate(PaymentVoucher::rules($payment_voucher->id), PaymentVoucher::messages());

  
        $payment_voucher->update($request->all());
   
        return redirect()->route('payment_vouchers.index')
                        ->with('success','Payment voucher updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentVoucher $payment_voucher)
    {
        $payment_voucher->deleted = true;
        $payment_voucher->save();
  
        return redirect()->route('payment_vouchers.index')
                        ->with('success','Payment voucher deleted successfully');
    }
}
