<?php

namespace App\Http\Controllers;
use App\Customer;
use Illuminate\Http\Request;
use DB;
class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $customers = Customer::where('deleted', false)->where(function($q) use ($request) {
                if ($request->has('name') and $request->name) {
                    $q->where('name', 'LIKE', '%' . $request->name.'%');
                }
                if ($request->has('mobile') and $request->mobile) {
                    $q->where('mobile', 'LIKE', '%' . $request->mobile.'%');
                }
        })->paginate(30);

        return view('customers.index',compact('customers','request'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(Customer::rules(), Customer::messages());

  
        Customer::create($request->all());
   
        return redirect()->route('customers.index')
                        ->with('success','Customer added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customers = Customer::where('id', $id)->first();
        
        return view('customers.show',compact('customers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return view('customers.edit',compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $request->validate(Customer::rules($customer->id), Customer::messages());

  
        $customer->update($request->all());
   
        return redirect()->route('customers.index')
                        ->with('success','Customer updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->deleted = true;
        $customer->save();
  
        return redirect()->route('customers.index')
                        ->with('success','Customers deleted successfully');
    }
}
