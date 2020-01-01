@extends ('layouts.dashboard')

@section ('content')
<div class="row">
  <div class="col-md-6 offset-md-3">
    <div class="card">
        <div class="card-header">
          <span class="float-left">Edit Marksheet</span>
          <div class="float-right">
              <a href="{{ route('students.show',$marksheet->student->id) }}"> Back</a>
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
               
            <form action="{{ route('marksheets.update', $marksheet->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
              
                 <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Year</label>
                            <select name="year_id" class="form-control">
                                <option value="">---Select Year---</option>
                                @foreach ($years as $year)
                                    <option 
                                        value="{{ $year->id }}"
                                        {{ ( $marksheet->year_id == $year->id ) ? 'selected' : '' }}>{{ $year->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Semester</label>
                            <select name="semester_id" class="form-control">
                                <option value="">---Select Semester---</option>
                                @foreach ($semesters as $semester)
                                    <option 
                                    value="{{ $semester->id }}"
                                    {{ ( $marksheet->semester_id == $semester->id ) ? 'selected' : '' }}>{{ $semester->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Result</label>
                            <input type="text" name="result" value="{{ $marksheet->result }}" class="form-control" placeholder="Ex.:- Pass, Failed...">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Upload Marksheet</label>
                            <input type="file" name="marksheet_file" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-12 text-center">
                      <button type="submit" class="btn btn-pink">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
  </div>
</div>
@endsection