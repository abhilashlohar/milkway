<?php

namespace App\Http\Controllers;
use App\Product;
use Illuminate\Http\Request;
use DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {  
       $products = Product::where(function($q) use ($request) {
                if ($request->has('name') and $request->name) {
                    $q->where('name', 'LIKE', '%' . $request->name.'%' );
                }
                if ($request->has('unit_name') and $request->unit_name) {
                    $q->where('unit_name', 'LIKE', '%' . $request->unit_name.'%');
                }
        })->where('deleted', false)->paginate(30);

        return view('products.index',compact('products','request'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $request->validate(Product::rules(), Product::messages());

  
        Product::create($request->all());
   
        return redirect()->route('products.index')
                        ->with('success','Product added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $products = Product::where('id', $id)->where('deleted', false)->first();
        
        return view('products.show',compact('products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('products.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate(Product::rules($product->id), Product::messages());

  
        $product->update($request->all());
   
        return redirect()->route('products.index')
                        ->with('success','Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->deleted = true;
        $product->save();
  
        return redirect()->route('products.index')
                        ->with('success','Product deleted successfully');
    }
}
