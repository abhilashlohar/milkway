@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add New Sales Voucher') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('sales_vouchers.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="customer_id" class="col-md-4 col-form-label text-md-right">{{ __('Customer') }}</label>

                            <div class="col-md-6">
                                <select id="customer_id" name="customer_id" class="form-control @error('customer_id') is-invalid @enderror" required>
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
                        </div>

                        <div class="form-group row">
                            <label for="create_date" class="col-md-4 col-form-label text-md-right">{{ __('Date') }}</label>

                            <div class="col-md-6">
                                <input id="create_date" type="date" class="form-control @error('create_date') is-invalid @enderror" name="create_date" value="{{ old('create_date') }}" required>

                                @error('create_date')
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
                                            <th>Sr no.</th>
                                            <th>Product</th>
                                            <th>Quantity</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id='main_tbody' class="tab">

                                    </tbody>
                                    <tfoot>
                                        <td colspan="4"><div class="btn btn-primary add"><i class="fa fa-plus"></i>Add</div></td>
                                    </tfoot>
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
                                <a class="btn btn-light" href="{{ route('sales_vouchers.index') }}">Cancel</a>
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
$('.add').click(function(){
    add_row();
});
add_row();
function add_row(){
        var tr=$("#sample_table tbody tr.main_tr").clone();
        $("#main_table tbody#main_tbody").append(tr);
        
        rename_rows();
         
}
$(document).on('click','.delete-tr',function()
{ 
    $(this).closest('tr').remove();
    rename_rows();
});

function rename_rows(){
    var i=0; 
    $("#main_table tbody#main_tbody tr.main_tr").each(function(){ 
        $(this).find('td:nth-child(1)').html(i+1);
        $(this).find("td:nth-child(2) select").attr({name:"sales_voucher_rows["+i+"][product_id]", id:"sales_voucher_rows-"+i+"-product_id"});
        $(this).find("td:nth-child(3) input").attr({name:"sales_voucher_rows["+i+"][qty]", id:"sales_voucher_rows-"+i+"-qty"});
        i++;
    });
}
});


</script>
@endsection
