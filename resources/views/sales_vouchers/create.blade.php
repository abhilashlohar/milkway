@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Add New Sales Voucher') }}</div>

                <div class="card-body">
                     @if(Session::has('success'))
                <div class="alert alert-success" role="alert" data-dismiss="alert">
                    <strong>Success! &nbsp;</strong> {{ Session::get('success') }}
                </div>
                @endif
                    <form method="POST" action="{{ route('sales_vouchers.store') }}">
                        @csrf

                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="customer_id" class="col-form-label text-md-right">{{ __('Customer') }}</label>
                                <select id="customer_id" name="customer_id" class="form-control @error('customer_id') is-invalid @enderror check_cls" required default=1>
                                    <option value="">--Select--</option>
                                    @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}"> {{ $customer->name }} </option>
                                    @endforeach
                                </select>

                                @error('customer_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        
                            <div class="col-md-4">
                                <label for="product_id" class="col-form-label text-md-right">{{ __('Product') }}</label>
                                <select id="product_id" name="product_id" class="form-control @error('product_id') is-invalid @enderror check_cls" required>
                                    <option value="">--Select--</option>
                                    @foreach ($products as $product)
                                    <option value="{{ $product->id }}"> {{ $product->name }} </option>
                                    @endforeach
                                </select>

                                @error('product_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        
                           <div class="col-md-4">
                                 <label for="month" class="col-form-label text-md-right">{{ __('Month') }}</label>
                                <input id="month" type="text" class="form-control @error('create_date') is-invalid @enderror check_cls" name="month" value="<?php echo date('Y-m'); ?>" required>

                                @error('month')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                          <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                  <span class="float-left">Product Details</span>
                                  
                                </div>
                                <div class="card-body">
                                   <table class="table table-sm" id="main_table">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center;">Sr no.</th>
                                            <th>Date</th>
                                            <th>Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody id='main_tbody' class="tab">

                                    </tbody>
                                    </table>
                                </div>
                            </div>
                          </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <br>
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save') }}
                                </button>
                                
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<table id="sample_table" style="display:none;" cellpadding="5" cellspacing="5">
    <tbody>
        <tr class="main_tr" class="tab">
            <td align="center" width="1px"></td>
            <td>
                <select id="product_id" name="product_id" class="form-control @error('product_id') is-invalid @enderror" required>
                    <option value="">--Select--</option>
                    @foreach ($products as $product)
                    <option value="{{ $product->id }}"> {{ $product->name }} </option>
                    @endforeach
                </select>

                @error('product_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </td>
            <td>
                <input id="qty" type="number" class="form-control @error('qty') is-invalid @enderror" name="qty" value="{{ old('qty') }}" required="required" step="any">
            </td>
            <td>
                <a class="btn btn-danger delete-tr input-sm" href="#" role="button" style="margin-bottom: 1px;"><i class="fa fa-times"></i></a>
            </td>
        </tr>
    </tbody>
</table>
@endsection

@section('JS_Code')
<script type="text/javascript">
$( document ).ready(function() {

$(document).on('change','.check_cls',function()
{
    var month_year = $('#month').val(); 
    if(month_year!='')
    {
        var dat_splite = month_year.split('-');
        daysInMonth(dat_splite[1],dat_splite[0]);
    }
});
var month_year = $('#month').val();
if(month_year!='')
    {
        $("#product_id").val($("#product_id option:eq(1)").val());
        $("#customer_id").val($("#customer_id option:eq(1)").val());
        var dat_splite = month_year.split('-');
        daysInMonth(dat_splite[1],dat_splite[0]);
    }

function daysInMonth(month, year) 
{
    
    var day =  new Date(year, month, 0).getDate(); 
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    
    $.ajax({
       type:'post',
       url:"{{ route('sales_vouchers.month_detail') }}",
       data:{days:day,month:month,year:year,product_id:$('#product_id').val(),customer_id:$('#customer_id').val()},
       success:function(data){ 
        $("#main_table tbody#main_tbody").html(data);
       }
    });

}
 $( "#month" ).datepicker({ dateFormat: 'yy-mm' });
});
</script>
@endsection

