<?php

namespace App\Http\Controllers;
use App\SalesVoucher;
use App\PaymentVoucher;
use App\SalesVoucherRow;
use App\Customer;
use App\Product;
use App\Setting;
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
        $products = Product::all()->where('deleted', false);
        return view('sales_vouchers.index',compact('sales_vouchers','request','customers','products'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /*public function index(Request $request)
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
        $products = Product::all()->where('deleted', false);
        return view('sales_vouchers.index',compact('sales_vouchers','request','customers','products'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
    }*/
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::all()->where('deleted', false);
        $products = Product::all()->where('deleted', false);
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
        $check = SalesVoucher::where('month', $request->month)
                               ->where('customer_id', $request->customer_id)
                               ->where('product_id', $request->product_id)
                               ->with('SalesVoucherRow.product')
                               ->first(); 
        $request->request->add(['create_date' => date('Y-m-d')]);
        if(empty($check))
        {
            $voucher_no = SalesVoucher::select('voucher_no')->where('deleted', false)
                                             ->orderBy('voucher_no','DESC')
                                             ->first();
            if(empty($voucher_no))
            {
                $vno =1;
            }
            else{
                $vno = $voucher_no->voucher_no+1;
            }
            $request->request->add(['voucher_no' => $vno]);
            
            //dd($request);
            $request->validate(SalesVoucher::rules(), SalesVoucher::messages());
            $sales_voucher_rows = $request->sales_voucher_rows;

            $sales_voucher = SalesVoucher::create($request->all());
            foreach($sales_voucher_rows as $sales_voucher_row)
            {

                if($sales_voucher_row['qty']!="")
                {
                    $finalData = array('sales_voucher_id'=>$sales_voucher->id, 'qty'=> $sales_voucher_row['qty'],'month_date'=>date("Y-m-d",strtotime($sales_voucher_row['month_date'])));
                     SalesVoucherRow::create($finalData);
                }
            }
        }
        else{ 
            $request->validate(SalesVoucher::rules($check->id), SalesVoucher::messages());
            
            $sales_voucher_rows = $request->sales_voucher_rows; 
            
            $check->update($request->all());
            if(!empty($sales_voucher_rows))
            {
                $ids=[]; 
                foreach($sales_voucher_rows as $sales_voucher_row)
                {
                    if(!empty($sales_voucher_row['id']) && $sales_voucher_row['qty']=='')
                    {
                      $ids[] =  $sales_voucher_row['id'];
                    }
                } 
                if(count($ids)>0)
                {
                    SalesVoucherRow::whereIn('id', $ids)->where('sales_voucher_id',$check->id)->delete(); 
                }
                foreach($sales_voucher_rows as $sales_voucher_row)
                {
                    if($sales_voucher_row['qty']!=''){
                    if(!empty($sales_voucher_row['id']))
                    {
                        $data= array('qty'=> $sales_voucher_row['qty']);
                        SalesVoucherRow::where('id', $sales_voucher_row['id'])
                          ->update($data);
                    }
                    else{
                        $finalData = array('sales_voucher_id'=>$check->id, 'qty'=> $sales_voucher_row['qty'],'month_date'=>date("Y-m-d",strtotime($sales_voucher_row['month_date'])));
                        SalesVoucherRow::create($finalData);
                    }
                }
                }
            }
        }
        return redirect()->route('sales_vouchers.create')
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
        $products = Product::all()->where('deleted', false);
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

    public function reportFilter()
    {
        $customers = Customer::all()->where('deleted', false);
       return view('sales_vouchers.report_filter',compact('customers'));
    }

    public function report(Request $request)
    {  
      //complete record of user
       $complete_sales_vouchers = SalesVoucher::where('deleted', false)->where(function($q) use ($request) {
                if ($request->has('customer_id') and $request->customer_id) {
                    $q->where('customer_id', $request->customer_id);
                }
        })->orderBy('create_date', 'ASC')->get();
       $complete_amt=0;
       if(!empty($complete_sales_vouchers))
       {
            foreach($complete_sales_vouchers as $complete_sales_voucher)
            {  
               foreach($complete_sales_voucher->SalesVoucherRow as $sales_voucher_row)
                {
                    if(!empty($complete_sales_voucher->product))
                    {
                       $complete_amt += round($sales_voucher_row->qty*$complete_sales_voucher->product->rate,2);
                    }
                }
            }
       }
       $sales_vouchers = SalesVoucher::where('deleted', false)->where(function($q) use ($request) {
                if ($request->has('customer_id') and $request->customer_id) {
                    $q->where('customer_id', $request->customer_id);
                }
                if ($request->has('month') and $request->month) {
                    $q->where('month',$request->month);
                }
        })->orderBy('create_date', 'ASC')->get();
       $firstArr=[];$total=0;$secondArr=[];$productId=[];
       if(!empty($sales_vouchers))
       {
            foreach($sales_vouchers as $sales_voucher)
            {  
               foreach($sales_voucher->SalesVoucherRow as $sales_voucher_row)
                {
                    if(!empty($sales_voucher->product))
                    {
                        $productId[$sales_voucher->product->name]=$sales_voucher->product->id;
                        @$firstArr[@$sales_voucher->product->name]['qty'] += $sales_voucher_row->qty;
                        @$firstArr[@$sales_voucher->product->name]['amount'] += round($sales_voucher_row->qty*$sales_voucher->product->rate,2);
                        $total += round($sales_voucher_row->qty*$sales_voucher->product->rate,2);
                        $date = (date('d/m/Y', strtotime($sales_voucher->create_date)) != '01-01-1970') ? date('d-m-Y', strtotime($sales_voucher->create_date)) : "-";
                        @$secondArr[@$sales_voucher_row->product->name.'~'.$date]['qty'] +=@$sales_voucher_row->qty;
                        @$secondArr[@$sales_voucher_row->product->name.'~'.$date]['amount'] +=round(@$sales_voucher_row->qty*$sales_voucher_row->product->rate,2);
                    }
                }
            }
       } 
       $customer = Customer::all()->where('deleted', false)->where('id', $request->customer_id)->first();

       $payment_voucher = PaymentVoucher::all()->where('deleted', false)->where('customer_id', $request->customer_id)->sum('amount');
       
       $setting = Setting::all()->first();
        return view('sales_vouchers.report',compact('sales_vouchers','request','customer','firstArr','total','secondArr','payment_voucher','productId','setting','complete_amt'));
    }

    public function month_detail(Request $request)
    {   
        $month = $request->year.'-'.$request->month; 
        $sales_voucher = SalesVoucher::where('month', $month)
                                       ->where('customer_id', $request->customer_id)
                                       ->where('product_id', $request->product_id)
                                       ->where('deleted', false)
                                       ->with('SalesVoucherRow.product')
                                       ->first();
        $arr=[];$ids=[];
        if(!empty($sales_voucher->SalesVoucherRow))
        {
            foreach($sales_voucher->SalesVoucherRow as $SalesVoucherRow)
            {
                 $arr[$sales_voucher->month][date("d-m-Y",strtotime($SalesVoucherRow->month_date))] = $SalesVoucherRow->qty;
                 $ids[$sales_voucher->month][date("d-m-Y",strtotime($SalesVoucherRow->month_date))] = $SalesVoucherRow->id;
            }
        } 
        return view('sales_vouchers.month_detail',compact('sales_voucher','request','arr','month','ids'));
    }
    
    public function product_report(Request $request)
    {
        
    }
}
