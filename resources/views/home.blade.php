@extends('layouts.app')
@section('content')
<div id="app">
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
                    <expenses-data properties="{{ json_encode($data) }}"></expenses-data>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
