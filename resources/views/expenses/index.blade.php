@extends('layouts.app')

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(session('addExpenseSuccessMessage'))
    <div class="alert alert-success">
        {{session('addExpenseSuccessMessage')}}
    </div>
@endif
    
<form method="POST" action="{{route('expenses.store')}}">
    @csrf
    <div class="form-group">
        <label for="expendedInput">Expended</label>
        <input 
                type="number" 
                class="form-control" 
                id="expendedInput" 
                placeholder="Enter how much money was expended"
                name="expendedAmount"
        >
    </div>
    <div class="form-group">
        <label for="expendedTitle">Title</label>
        <input 
                type="text" 
                class="form-control" 
                id="expendedTitle" 
                placeholder="Title"
                name="expendedAmountTitle"
        >
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection