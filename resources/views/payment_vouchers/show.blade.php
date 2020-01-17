@extends('layouts.dashboard')
 
@section('content')
    <div class="row">

      <div class="col-md-12">
        <div class="row mb-2">
          <div class="col-md-6 "><h4 class="screen-title float-left">Payment Details</h4></div>
          <div class="col-md-6 ">
           
          </div>
        </div>
        <div class="card">
           
          <div class="card-body">
            <div class="row">
              <div class="col-md-4">
                <span style="color: #575555;">Customer:</span>
                <span class="ml-2"> {{ $sales_vouchers->customer->name }} </span>
              </div>
            </div>
            <div class="row mt-2">
              <div class="col-md-4">
                <span style="color: #575555;">Amount:</span>
                <span class="ml-2"> {{ $products->amount }} </span>
              </div>
            </div>
            <div class="row mt-2">
              <div class="col-md-4">
                <span style="color: #575555;">Create Date:</span>
                <span class="ml-2"> {{ date("d-m-Y",strtotime($sales_vouchers->month_date)) 
              </div>
            </div>
            <br/>
          </div>
        </div>
      </div>
    </div>
@endsection