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

@if(session('updateExpenseSuccessMessage'))
    <div class="alert alert-success">
        {{session('updateExpenseSuccessMessage')}}
    </div>
@endif
<form method="POST" action="{{route('expenses.update', ['expense' => $expense->id])}}">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="expendedInput">Expended</label>
        <input
                type="number"
                class="form-control"
                id="expendedInput"
                placeholder="Enter how much money was expended"
                name="expendedAmount"
                step="0.01"
                value="{{ $expense->amount }}"
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
                value="{{ $expense->title }}"
        >
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection