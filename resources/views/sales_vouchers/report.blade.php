@extends('layouts.dashboard')
 
@section('content')
    <div class="row">
        <div class="col-md-12" style="text-align: center;">
            <h4>{{ @$customer->name }}</h4></div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
            <div class="card-header">
              <span class="float-left">Report (Product Wise)</span>
              <div class="float-right">
				
                </div>
            </div>
            
            <div class="card-body">
                <table class="table table-sm">
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Amount</th>
                    </tr>
                    @foreach ($firstArr as $key => $val)
                    <tr>
                        <td><a href="{{ route('sales_vouchers.product_report', @$productId[@$key]) }}">{{ $key }}</a></td>
                        <td>{{ @$val['qty'] }}</td>
                        <td>{{ round(@$val['amount'],2) }}</td>
                    </tr>
                    @endforeach  
                    <tr style="background-color: #f3f3f3;">
                        <td colspan="2">Total</td>
                        <td>{{ round($total,2) }}/-</td>
                    </tr>                  
                </table>
            </div>
        </div>
      </div>
    </div>
    <br>
  
@endsection
@section('JS_Code')
<script type="text/javascript">
$( document ).ready(function() {

    

});
</script>
@endsection