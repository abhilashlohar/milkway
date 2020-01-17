@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add New Payment') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('payment_vouchers.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="customer_id" class="col-md-4  col-form-label text-md-right">{{ __('Customer') }}</label>

                            <div class="col-md-6">
                                <select id="customer_id" name="customer_id" class="form-control @error('customer_id') is-invalid @enderror check_cls" required default=1>
                                    <option value="">--Select--</option>
                                    @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}"> {{ $customer->name }} </option>
                                    @endforeach
                                </select>

                               @error('customer_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="amount" class="col-md-4 col-form-label text-md-right">{{ __('Amount') }}</label>

                            <div class="col-md-6">
                                <input id="amount" type="number" class="form-control @error('amount') is-invalid @enderror" name="amount" value="{{ old('amount') }}" step="any" required>

                                @error('amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="month" class="col-md-4  col-form-label text-md-right">{{ __('Date') }}</label>

                            <div class="col-md-6">
                                 <input id="month_date" type="date" class="form-control @error('month_date') is-invalid @enderror check_cls" name="month_date" value="<?php echo date('Y-m-d'); ?>" required>

                                @error('month_date')
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
                                <a class="btn btn-light" href="{{ route('payment_vouchers.index') }}">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
