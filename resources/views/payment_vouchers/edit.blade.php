@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Payment') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('payment_vouchers.update', $payment_voucher->id) }}">
                        @csrf
                        @method('PUT')

                        

                        <div class="form-group row">
                            <label for="customer_id" class="col-md-4 col-form-label text-md-right">{{ __('Customers') }}</label>

                            <div class="col-md-6">
                                <select id="customer_id" name="customer_id" class="form-control @error('customer_id') is-invalid @enderror" required>
                                    <option value="">--Select--</option>
                                    @foreach ($customers as $customer)
                                    <option 
                                        value="{{ $customer->id }}" 
                                        {{ ( $customer->id == $payment_voucher->customer_id ) ? 'selected' : '' }}> {{ $customer->name }} 
                                    </option>
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
                                <input id="amount" type="number" class="form-control @error('amount') is-invalid @enderror" name="amount" value="{{ $payment_voucher->amount }}" step="any" required>

                                @error('amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="month_date" class="col-md-4 col-form-label text-md-right">{{ __('Date') }}</label>

                            <div class="col-md-6">
                                <input id="month_date" type="date" class="form-control @error('month_date') is-invalid @enderror" name="month_date" value="{{ date('Y-m-d',strtotime($payment_voucher->month_date)) }}">

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
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
