@extends('layouts.report')
 
@section('content')
<style type="text/css">
@media print {
    #printbtn {
        display :  none;
    }
}
</style>
    <div class="row">
        <a id="printbtn" class="btn btn-light" href="{{ route('sales_vouchers.report_filter') }}" style="margin-left: 1%;COLOR: RED;">Back</a>
        <div class="col-md-12" style="text-align: center;">
            <h5>{{ @$setting->firm_name }}</h5>
            <h5>{{ @$setting->address }}</h5><br>
        </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
            <div class="card-header">
              <div class="text-center"><strong>Report ({{ @$customer->name }})</strong></div>
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
                    <tr style="background-color: #f3f3f3 !important;">
                        <td colspan="2">Total of {{ date("F,Y",strtotime($request->month)) }}</td>
                        <td>{{ round($total,2) }}/-</td>
                    </tr>
                    <tr style="background-color: #fbf0f0 !important;">
                        <td colspan="2">Overall Amount</td>
                        <td>{{ round($complete_amt,2) }}/-</td>
                    </tr>
                    <tr style="background-color: #fbf0f0 !important;">
                        <td colspan="2">Total Receive Amount</td>
                        <td>{{ round($payment_voucher,2) }}/-</td>
                    </tr> 
                    <tr style="background-color: #fbf0f0 !important;">
                        <td colspan="2">Remaining Amount</td>
                        <td>
                        <?php $remaining_amt = round($complete_amt,2)-round($payment_voucher,2); ?>
                        {{ round($remaining_amt,2) }}/-</td>
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