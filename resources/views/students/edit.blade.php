@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Student') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('students.update', $student->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="enrollment" class="col-md-4 col-form-label text-md-right">{{ __('Enrollment Number') }}</label>

                            <div class="col-md-6">
                                <input id="enrollment" type="text" class="form-control @error('enrollment') is-invalid @enderror" name="enrollment" value="{{ $student->enrollment }}" required  autofocus>

                                @error('enrollment')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $student->name }}" required >

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="father_name" class="col-md-4 col-form-label text-md-right">{{ __('Father Name') }}</label>

                            <div class="col-md-6">
                                <input id="father_name" type="text" class="form-control @error('father_name') is-invalid @enderror" name="father_name" value="{{ $student->father_name }}" >

                                @error('father_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="mother_name" class="col-md-4 col-form-label text-md-right">{{ __('Mother Name') }}</label>

                            <div class="col-md-6">
                                <input id="mother_name" type="text" class="form-control @error('mother_name') is-invalid @enderror" name="mother_name" value="{{ $student->mother_name }}" >

                                @error('mother_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="dob" class="col-md-4 col-form-label text-md-right">{{ __('Date of Birth') }}</label>

                            <div class="col-md-6">
                                <input id="dob" type="date" class="form-control @error('dob') is-invalid @enderror" name="dob" value="{{ old('dob') }}">

                                @error('dob')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="course_id" class="col-md-4 col-form-label text-md-right">{{ __('Course') }}</label>

                            <div class="col-md-6">
                                <select id="course_id" name="course_id" class="form-control @error('course_id') is-invalid @enderror" required>
                                    <option value="">--Select--</option>
                                    @foreach ($courses as $course)
                                    <option 
                                        value="{{ $course->id }}" 
                                        {{ ( $course->id == $student->course_id ) ? 'selected' : '' }}> {{ $course->name }} 
                                    </option>
                                    @endforeach
                                </select>

                                @error('course_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="stream_id" class="col-md-4 col-form-label text-md-right">{{ __('Stream') }}</label>

                            <div class="col-md-6">
                                <select id="stream_id" name="stream_id" class="form-control">
                                    <option value="">--Select--</option>
                                    @foreach ($streams as $stream)
                                    <option 
                                        value="{{ $stream->id }}" 
                                        {{ ( $stream->id == $student->stream_id ) ? 'selected' : '' }}> {{ $stream->name }} 
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
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
@endsection

@section('JS_Code')
<script type="text/javascript">
$( document ).ready(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $( "#course_id" ).on( "change", function() {
        var course_id = $(this).val();
        
        $.ajax({
           type:'POST',
           url:"{{ route('streams.list') }}",
           data:{course_id:course_id},
           success:function(data){
            $( "#stream_id" ).html(data);
           }
        });
    });

});
</script>
@endsection
