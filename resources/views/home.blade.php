@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                    
                    
                </div>
            </div>

            <div class="card">
                <div class="card-header">{{ __('Expenses tracker') }}</div>

                <div class="card-body">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">Months</label>
                        </div>
                        <select class="custom-select" id="inputGroupSelect01">
                        <option selected>Choose...</option>
                        @foreach ($data['expenses_months'] as $month)
                                <option value="{{$month->month_id}}">{{$month->label}}</option>
                            @endforeach                            
                        </select>
                    </div>    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
