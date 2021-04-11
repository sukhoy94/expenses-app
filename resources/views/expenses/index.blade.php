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

<table class="table table-hover">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">title</th>
        <th scope="col">amount</th>
        <th scope="col">data</th>
    </tr>
    </thead>
    <tbody>
        @foreach ($userExpensesCurrentMonth as $key => $expense)
            <tr>
                <th scope="row">{{ ++$key }}</th>
                <td>{{ $expense->title }}</td>
                <td>{{ $expense->amount }}</td>
                <td>{{ $expense->created_at }}</td>
            </tr>
        @endforeach   
    </tbody>
</table>

<table class="table">
    <thead>
    <tr>
        <th scope="col">total</th>
        <th scope="col">remaining</th>
        <th scope="col">remaining per day</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>{{ $userExpensesCurrentMonthSummary['total'] }}</td>
        <td>{{ $userExpensesCurrentMonthSummary['remaining'] }}</td>
        <td>{{ $userExpensesCurrentMonthSummary['remaining_per_day'] }}</td>
    </tr>    
    </tbody>
</table>
    

@endsection