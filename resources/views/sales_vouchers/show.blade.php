@extends('layouts.dashboard')
 
@section('content')
    <div class="row">

      <div class="col-md-12">
        <div class="row mb-2">
          <div class="col-md-6 "><h4 class="screen-title float-left">Sales Voucher</h4></div>
          <div class="col-md-6 ">
            
          </div>
        </div>
        <div class="card">
           
          <div class="card-body">
            <div class="row">
              <div class="col-md-4">
                <span style="color: #575555;">Sales Voucher No:</span>
                <span class="ml-2"> {{ $sales_vouchers->voucher_no }} </span>
              </div>
              <div class="col-md-4">
                <span style="color: #575555;">Customer:</span>
                <span class="ml-2"> {{ $sales_vouchers->customer->name }} </span>
              </div>
            </div>
            <div class="row mt-2">
              <div class="col-md-4">
                <span style="color: #575555;">Create Date:</span>
                <span class="ml-2"> {{ date("d-m-Y",strtotime($sales_vouchers->create_date)) }} </span>
              </div>
            </div>
            
            <br/>

            <div class="row">
              <div class="col-md-12">
                <table class="table table-sm">
                  <thead>
                    <tr>
                      <th scope="col">Product</th>
                      <th scope="col">Quantity</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ( $sales_vouchers->SalesVoucherRow as $sales_voucher_row)
                    <tr>
                      <td>{{ $sales_voucher_row->product->name ?? '-' }}</td>
                      <td>{{ $sales_voucher_row->qty }}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
        </div>
        </div>
      </div>
    </div>
@endsection