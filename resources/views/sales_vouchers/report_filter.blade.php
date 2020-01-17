@extends('layouts.dashboard')
 
@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/3.2/select2.css" rel="stylesheet" />
    <div class="row">
      <div class="col-md-12">
        <div class="card">
            <div class="card-header">
              <span class="float-left">Report Filter</span>
              <div class="float-right">
				
                </div>
            </div>
            
            <div class="card-body">
                <form action="{{ route('sales_vouchers.report') }}" method="GET">
                  
                     <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Customer</label>
                                <select name="customer_id" id="customer_id" class="form-control" required>
                                    <option value="">---Select Customer---</option>
                                    @foreach ($customers as $customer)
                                        <option 
                                        value="{{ $customer->id }}"
                                        >{{ $customer->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Month</label>
                                <input type="text" id="month" name="month" value="" class="form-control cDate" required>
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

     $( "#month" ).datepicker({ dateFormat: 'yy-mm' });
     $("#customer_id").select2();
});
</script>
@endsection