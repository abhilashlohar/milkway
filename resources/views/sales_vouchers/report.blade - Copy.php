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
                        <td>{{ $key }}</td>
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
    <br>
    @if ($sales_vouchers ?? '')
        <div class="row">
          <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                  <span class="float-left">Report  (Date Wise)</span>
                  
                </div>
                <div class="card-body">
                   <table class="table table-sm">
                        <tr>
                            <th>Date</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Amount</th>
                        </tr>
                        <?php $grand_total=0; ?>
                        @foreach ($secondArr as $key1 => $data)
                        <?php $split_data = explode('~',$key1); ?>
                        <tr>
                            <td>{{ @$split_data[1] }}</td>
                            <td>{{ @$split_data[0] }}</td>
                            <td>{{ @$data['qty'] }}</td>
                            <td>{{ round(@$data['amount'],2) }}</td>
                        </tr>
                        <?php $grand_total +=round($data['amount'],2); ?>
                        @endforeach 
                        <tr style="background-color: #f3f3f3;">
                        <td colspan="3">Total</td>
                        <td>{{ round($grand_total,2) }}/-</td>
                    </tr>  
                    </table>
                    
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