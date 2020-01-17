@extends('layouts.dashboard')
 
@section('content')
    <div class="row">
      <div class="col-md-12">
        <div class="card">
            <div class="card-header">
              <span class="float-left">Customer Search</span>
              <div class="float-right">
				<a href="{{ route('customers.create') }}"> Add New Customer</a>
                </div>
            </div>
            
            <div class="card-body">
                 @if(Session::has('success'))
                <div class="alert alert-success" role="alert" data-dismiss="alert">
                    <strong>Success! &nbsp;</strong> {{ Session::get('success') }}
                </div>
                @endif
                <form action="{{ route('customers.index') }}" method="GET">
                  
                     <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Customer Name</label>
                                <input type="text" name="name" value="{{ @$request->name }}" class="form-control">
                            </div>
                        </div>
                         <div class="col-md-3">
                            <div class="form-group">
                                <label>Mobile</label>
                                <input type="text" name="mobile" value="{{ @$request->mobile }}" class="form-control">
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
    @if ($customers ?? '')
        <div class="row">
          <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                  <span class="float-left">Customer Data</span>
                  
                </div>
                <div class="card-body">
                   <table class="table table-sm">
                        <tr>
                            <th>Name</th>
                            <th>Mobile</th>
                            <th>Action</th>
                        </tr>

                        @foreach ($customers as $customer)
                        <tr>
                            <td>
                                <a class="" href="{{ route('customers.show',$customer->id) }}">
                                    {{ $customer->name }}
                                </a>
                            </td>
                            <td>{{ $customer->mobile }}</td>
                            <td>
                                <form action="{{ route('customers.destroy',$customer->id) }}" method="POST">
                   
                                    <a class="btn btn-sm btn-light" href="{{ route('customers.edit',$customer->id) }}">
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
                    {!! $customers->links() !!}
                </div>
            </div>
          </div>
        </div> 
    @endif
@endsection