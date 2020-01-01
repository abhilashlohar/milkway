@extends ('layouts.dashboard')

@section ('content')
<style type="text/css">
.ui-menu li {
    list-style:none;
    background-image:none;
    background-repeat:none;
    background-position:0; 
}
</style>
<div class="row">
  <div class="col-md-6 offset-md-3">
    <div class="card">
        <div class="card-header">
          <span class="float-left">Import Students</span>
          <div class="float-right">
              <a href="{{ route('students.index') }}"> Back</a>
          </div>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(Session::has('fail'))
                <div class="alert alert-warning alert-block" role="alert" data-dismiss="alert">
                    <strong>failure! &nbsp;</strong> {{ Session::get('fail') }}
                </div>
            @endif
            @if(empty($contentArr))  
            <form action="{{ route('students.savemarksheet') }}" method="POST" enctype="multipart/form-data">
                @csrf
               
                 <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Upload Marksheet</label>
                            <input type="file" name="marksheet_file" class="form-control" required="required">
                        </div>
                        Download <a href="{{ route('students.sample') }}"> Sample File</a>
                    </div>
                    <div class="col-md-12 text-center">
                      <button type="submit" class="btn btn-pink">Import</button>
                    </div>
                </div>
            </form>
            @endif
            <div class="col-md-12 ">
             <?php 
             $courseArr = array_unique($courseArr); 
             $stremArr = array_unique($stremArr); 
             $yrArr = array_unique($yrArr); 
             $semArr = array_unique($semArr); 
             ?>
            @if(count(@$courseArr)>0 or count(@$stremArr)>0 or count(@$yrArr)>0 or count(@$semArr)>0 or count($contentArr)>0)
             <table class="table table-sm tblborder">

              @if(count(@$courseArr)>0)
              <tr> 
                <td>Following courses do not exist in the system. The system would create these.<br>
                  <ul>
                   @foreach ($courseArr as $courseArr1)
                    <li>{{ $courseArr1 }}</li>
                   @endforeach
                  </ul>
                 </td>
                </tr>
                @endif
                @if(count(@$stremArr)>0)
                <tr> 
                 <td>Following streams do not exist in the system. The system would create these.<br>
                  <ul>
                   @foreach ($stremArr as $stremArr1)
                    <li>{{ $stremArr1 }}</li>
                   @endforeach
                  </ul>
                 </td>
                </tr>
                @endif
                 @if(count(@$yrArr)>0)
                <tr> 
                 <td>Following years do not exist in the system. The system would create these.<br>
                  <ul>
                   @foreach ($yrArr as $yrArr1)
                    <li>{{ $yrArr1 }}</li>
                   @endforeach
                  </ul>
                 </td>
                </tr>
                @endif
                 @if(count(@$semArr)>0)
                <tr>
                 <td>Following semester do not exist in the system. The system would create these.<br>
                  <ul>
                   @foreach ($semArr as $semArr1)
                    <li>{{ $semArr1 }}</li>
                   @endforeach
                  </ul>
                 </td>
              </tr>
              @endif
              @if(count($contentArr)>0)
              <tr>
                 <td>Student Records<br>
                  <ul>
                  <li>{{ @$stuArrr['insert'] }} new student(s) will be imported.</li>
                  <li>{{ @$stuArrr['update'] }} student(s) will be updated.</li>
                  </ul>
                 </td>
              </tr>
              @endif
            </table>
             @endif
              @if(count($contentArr)>0)
            <form action="{{ route('students.saveDetail') }}" method="POST" enctype="multipart/form-data">
               @csrf
            <textarea name="csvdetail" style="display:none;" >{{ json_encode(@$contentArr) ?? '' }}</textarea>
            <div class="col-md-12 text-center">
                <p>Do you want to continue?</p>
             <button type="submit" class="btn btn-pink">Yes, Import</button>
            </div>
          </form>
             @endif
            </div>
        </div>
    </div>
  </div>
</div>
@endsection