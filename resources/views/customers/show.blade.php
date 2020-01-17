@extends('layouts.dashboard')
 
@section('content')
    <div class="row">

      <div class="col-md-12">
        <div class="row mb-2">
          <div class="col-md-6 "><h4 class="screen-title float-left">Customer Details</h4></div>
          <div class="col-md-6 ">
           
          </div>
        </div>
        <div class="card">
           
          <div class="card-body">
            <div class="row">
              <div class="col-md-4">
                <span style="color: #575555;">Name:</span>
                <span class="ml-2"> {{ $customers->name }} </span>
              </div>
            </div>
            <div class="row mt-2">
              <div class="col-md-4">
                <span style="color: #575555;">Mobile:</span>
                <span class="ml-2"> {{ $customers->mobile }} </span>
              </div>
            </div>
            <div class="row mt-2">
              <div class="col-md-4">
                <span style="color: #575555;">Address:</span>
                <span class="ml-2"> {{ $customers->address }} </span>
              </div>
            </div>
            <br/>
          </div>
        </div>
      </div>
    </div>
@endsection