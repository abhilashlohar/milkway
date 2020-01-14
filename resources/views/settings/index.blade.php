@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Setting') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('settings.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="firm_name" class="col-md-4 col-form-label text-md-right">{{ __('Firm Name') }}</label>

                            <div class="col-md-6">
                                <input id="firm_name" type="text" class="form-control @error('firm_name') is-invalid @enderror" name="firm_name" value="{{ @$setting->firm_name }}" required >
                                <input type="hidden" name="id" value="{{ @$setting->id }}">
                                @error('firm_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                            <div class="col-md-6">
                                <textarea id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address"  >{{ @$setting->address }}</textarea>

                                @error('address')
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
                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
