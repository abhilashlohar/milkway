@extends ('layouts.dashboard')
   
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Update Year') }}</div>

                <div class="card-body">

                    <form action="{{ route('years.update',$year->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                      
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Year') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $year->name }}" required  autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save') }}
                                </button>
                                <a class="btn btn-light" href="{{ route('years.index') }}">Cancel</a>
                            </div>
                        </div>
                        
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection