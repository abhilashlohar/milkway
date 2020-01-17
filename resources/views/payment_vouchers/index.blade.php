@extends('layouts.dashboard')
 
@section('content')
    <div class="row">
      <div class="col-md-12">
        <div class="card">
            <div class="card-header">
              <span class="float-left">Payment Search</span>
              <div class="float-right">
				<a href="{{ route('payment_vouchers.create') }}"> Add New Payment</a>
                </div>
            </div>
            
            <div class="card-body">
                 @if(Session::has('success'))
                <div class="alert alert-success" role="alert" data-dismiss="alert">
                    <strong>Success! &nbsp;</strong> {{ Session::get('success') }}
                </div>
                @endifss
                <form action="{{ route('payment_vouchers.index') }}" method="GET">
                  
                     <div class="row">
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
                                <input type="date" name="month_date" value="{{ $request->month_date }}" class="form-control cDate">
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
    @if ($payment_vouchers ?? '')
        <div class="row">
          <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                  <span class="float-left">Payment Data</span>
                  
                </div>
                <div class="card-body">
                   <table class="table table-sm">
                        <tr>
                            <th>Customer</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>

                        @foreach ($payment_vouchers as $payment_voucher)
                        <tr>
                            <td>
                                {{ $payment_voucher->customer->name }}
                            </td>
                            <td>{{ $payment_voucher->amount }}</td>
                            <td>{{ date("d-m-Y",strtotime($payment_voucher->month_date)) }}</td>
                            <td>
                                <form action="{{ route('payment_vouchers.destroy',$payment_voucher->id) }}" method="POST">
                   
                                    <a class="btn btn-sm btn-light" href="{{ route('payment_vouchers.edit',$payment_voucher->id) }}">
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
                    {!! $payment_vouchers->links() !!}
                </div>
            </div>
          </div>
        </div> 
    @endif
@endsection