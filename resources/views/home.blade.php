@extends('layouts.dashboard')

@section('content')
<div class="row">
  <div class="col-md-4">
    <div align="center" style="background-color: #FFF;border-radius: 5px;padding: 50px 0px;border: solid 1px #cccccc;">
      <span style="font-size: 40px;color: #FF6468;">{{ $student_count }}</span><br>
      <span style="font-size: 16px;color: #4D384B;">Students</span>
    </div>
  </div>
  <div class="col-md-4">
      <div align="center" style="background-color: #FFF;border-radius: 5px;padding: 50px 0px;border: solid 1px #cccccc;">
        <span style="font-size: 40px;color: #FF6468;">{{ $marksheet_count }}</span><br>
        <span style="font-size: 16px;color: #4D384B;">Marksheets</span>
      </div>
  </div>
  <div class="col-md-4">
      <div align="center" style="background-color: #FFF;border-radius: 5px;padding: 50px 0px;border: solid 1px #cccccc;">
        <span style="font-size: 40px;color: #FF6468;">{{ $user_count }}</span><br>
        <span style="font-size: 16px;color: #4D384B;">Users</span>
      </div>
  </div>
</div>
@endsection
