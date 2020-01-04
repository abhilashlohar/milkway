<?php

namespace App\Http\Controllers;
use App\SalesVoucher;
use App\SalesVoucherRow;
use App\Customer;
use App\Product;
use Illuminate\Http\Request;
use DB;

class SalesVoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sales_vouchers = SalesVoucher::where('deleted', false)->where(function($q) use ($request) {
                if ($request->has('voucher_no') and $request->voucher_no) {
                    $q->where('voucher_no', $request->voucher_no);
                }
                if ($request->has('customer_id') and $request->customer_id) {
                    $q->where('customer_id', $request->customer_id);
                }
                if ($request->has('create_date') and $request->create_date) {
                    $q->where('create_date', $request->create_date);
                }
        })->paginate(30);
        
        $customers = Customer::all()->where('deleted', false);
        $products = Product::all();
        return view('sales_vouchers.index',compact('sales_vouchers','request','customers','products'))
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
        $products = Product::all();
        return view('sales_vouchers.create',compact('customers','products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $voucher_no = SalesVoucher::select('voucher_no')->where('deleted', false)
                                         ->orderBy('voucher_no')
                                         ->first();
        if(empty($voucher_no))
        {
            $vno =1;
        }
        else{
            $vno = $voucher_no->voucher_no+1;
        }
        $request->request->add(['voucher_no' => $vno]);
        
        $request->validate(SalesVoucher::rules(), SalesVoucher::messages());
        $sales_voucher_rows = $request->sales_voucher_rows; 
        $sales_voucher = SalesVoucher::create($request->all());
        foreach($sales_voucher_rows as $sales_voucher_row)
        {
            
            $finalData = array('sales_voucher_id'=>$sales_voucher->id, 'product_id'=> $sales_voucher_row['product_id'], 'qty'=> $sales_voucher_row['qty']);
            SalesVoucherRow::create($finalData);
        }
        return redirect()->route('sales_vouchers.index')
                        ->with('success','Sales Voucher added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $sales_vouchers = SalesVoucher::where('id', $id)->with('Customer','SalesVoucherRow.product')->first();
      
        return view('sales_vouchers.show',compact('sales_vouchers'));
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
        $products = Product::all();
        $sales_voucher = SalesVoucher::where('id', $id)->with('Customer','SalesVoucherRow.product')->first();
        return view('sales_vouchers.edit',compact('sales_voucher', 'customers', 'products'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SalesVoucher $sales_voucher)
    {   
        $request->validate(SalesVoucher::rules($sales_voucher->id), SalesVoucher::messages());

        $sales_voucher_rows = $request->sales_voucher_rows;
        $sales_voucher->update($request->all());
        if(!empty($sales_voucher_rows))
        {
            $ids=[]; 
            foreach($sales_voucher_rows as $sales_voucher_row)
            {
                if(!empty($sales_voucher_row['id']))
                {
                  $ids[] =  $sales_voucher_row['id'];
                }
            } 
            if(count($ids)>0)
            {
                SalesVoucherRow::whereNotIn('id', $ids)->where('sales_voucher_id',$sales_voucher->id)->delete();
            }
            foreach($sales_voucher_rows as $sales_voucher_row)
            {
                if(!empty($sales_voucher_row['id']))
                {
                    $data= array('product_id'=> $sales_voucher_row['product_id'], 'qty'=> $sales_voucher_row['qty']);
                    SalesVoucherRow::where('id', $sales_voucher_row['id'])
                      ->update($data);
                }
                else{
                    $finalData = array('sales_voucher_id'=>$sales_voucher->id, 'product_id'=> $sales_voucher_row['product_id'], 'qty'=> $sales_voucher_row['qty']);
                    SalesVoucherRow::create($finalData);
                }
            }
        }
        return redirect()->route('sales_vouchers.index')
                        ->with('success','Sales Voucher updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SalesVoucher $sales_voucher)
    {
        $sales_voucher->deleted = true;
        $sales_voucher->save();
  
        return redirect()->route('sales_vouchers.index')
                        ->with('success','Sales Voucher deleted successfully');
    }
}
