@extends('layouts.dashboard')
 
@section('content')
    <div class="row">
      <div class="col-md-12">
        <div class="card">
            <div class="card-header">
              <span class="float-left">Sales Voucher Search</span>
              <div class="float-right">
				<a href="{{ route('sales_vouchers.create') }}"> Add New Sales Voucher</a>
                </div>
            </div>
            
            <div class="card-body">
                <form action="{{ route('sales_vouchers.index') }}" method="GET">
                  
                     <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Voucher No</label>
                                <input type="text" name="voucher_no" value="{{ $request->voucher_no }}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Customer</label>
                                <select name="customer_id" id="customer_id" class="form-control">
                                    <option value="">---Select Customer---</option>
                                    @foreach ($customers as $customer)
                                        <option 
                                        value="{{ $customer->id }}"
                                        {{ ( $request->customer_id == $customer->id ) ? 'selected' : '' }}>{{ $customer->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>date</label>
                                <input type="date" name="create_date" value="{{ $request->create_date }}" class="form-control cDate">
                            </div>
                        </div>
                        <div class="col-md-12">
                          <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
      </div>
    </div>
    <br>
    <br>
    @if ($sales_vouchers ?? '')
        <div class="row">
          <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                  <span class="float-left">Sales Vouchers</span>
                  
                </div>
                <div class="card-body">
                   <table class="table table-sm">
                        <tr>
                            <th>Voucher No</th>
                            <th>Customer Name</th>
                            <th>Create Date</th>
                           <th>Action</th>
                        </tr>

                        @foreach ($sales_vouchers as $sales_voucher)
                        <tr>
                            <td>
                                <a class="" href="{{ route('sales_vouchers.show',$sales_voucher->id) }}">
                                    {{ $sales_voucher->voucher_no }}
                                </a>
                            </td>
                            <td>{{ $sales_voucher->customer->name ?? '-' }}</td>
                            <td>{{ (date('d-m-Y', strtotime($sales_voucher->create_date)) != '01-01-1970') ? date('d-m-Y', strtotime($sales_voucher->create_date)) : "-" }}</td>
                            <td>
                                <form action="{{ route('sales_vouchers.destroy',$sales_voucher->id) }}" method="POST">
                   
                                    <a class="btn btn-sm btn-light" href="{{ route('sales_vouchers.edit',$sales_voucher->id) }}">
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
                    {!! $sales_vouchers->links() !!}
                </div>
            </div>
          </div>
        </div> 
    @endif
@endsection
@section('JS_Code')
<script type="text/javascript">
$( document ).ready(function() {

    

});
</script>
@endsection