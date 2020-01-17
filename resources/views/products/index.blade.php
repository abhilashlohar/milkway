@extends('layouts.dashboard')
 
@section('content')
    <div class="row">
      <div class="col-md-12">
        <div class="card">
            <div class="card-header">
              <span class="float-left">Product Search</span>
              <div class="float-right">
				<a href="{{ route('products.create') }}"> Add New Product</a>
                </div>
            </div>
            
            <div class="card-body">
                 @if(Session::has('success'))
                <div class="alert alert-success" role="alert" data-dismiss="alert">
                    <strong>Success! &nbsp;</strong> {{ Session::get('success') }}
                </div>
                @endif
                <form action="{{ route('products.index') }}" method="GET">
                  
                     <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Product Name</label>
                                <input type="text" name="name" value="{{ @$request->name }}" class="form-control">
                            </div>
                        </div>
                         <div class="col-md-3">
                            <div class="form-group">
                                <label>Unit Name</label>
                                <input type="text" name="unit_name" value="{{ @$request->unit_name }}" class="form-control">
                            </div>
                        </div>
                        

                        <div class="col-md-3">
                          <button type="submit" class="btn btn-primary custom-btn">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
      </div>
    </div>
    <br>
    <br>
    @if ($products ?? '')
        <div class="row">
          <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                  <span class="float-left">Product Data</span>
                  
                </div>
                <div class="card-body">
                   <table class="table table-sm">
                        <tr>
                            <th>Name</th>
                            <th>Unit Name</th>
                            <th>Rate</th>
                            <th>Action</th>
                        </tr>

                        @foreach ($products as $product)
                        <tr>
                            <td>
                                <a class="" href="{{ route('products.show',$product->id) }}">
                                    {{ $product->name }}
                                </a>
                            </td>
                            <td>{{ $product->unit_name }}</td>
                            <td>{{ $product->rate }}</td>
                            <td>
                                <form action="{{ route('products.destroy',$product->id) }}" method="POST">
                   
                                    <a class="btn btn-sm btn-light" href="{{ route('products.edit',$product->id) }}">
                                      <i class="fas fa-edit"></i>
                                    </a>
                   
                                    @csrf
                                    @method('DELETE')
                      
                                    <button class="btn btn-sm btn-light" type="submit"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    {!! $products->links() !!}
                </div>
            </div>
          </div>
        </div> 
    @endif
@endsection