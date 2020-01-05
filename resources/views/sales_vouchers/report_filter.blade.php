@extends('layouts.dashboard')
 
@section('content')
    <div class="row">
      <div class="col-md-12">
        <div class="card">
            <div class="card-header">
              <span class="float-left">Sales Voucher Search</span>
              <div class="float-right">
				<a href=""> Add New Sales Voucher</a>
                </div>
            </div>
            
            <div class="card-body">
                <form action="" method="GET">
                  
                     <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Voucher No</label>
                                <input type="text" name="voucher_no" value="" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Customer</label>
                                <select name="course_id" id="course_id" class="form-control">
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
                                <label>date</label>
                                <input type="date" name="create_date" value="" class="form-control cDate">
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

    

});
</script>
@endsection