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
                step="0.01"
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

<div class="mt-3">
    <table class="table mt-3">
        <thead>
        <tr>
            <th scope="col">budget</th>
            <th scope="col">expended</th>
            <th scope="col">remaining</th>
            <th scope="col">remaining per day</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>{{ $userExpensesCurrentMonthSummary['budget'] }} zł</td>
            <td>{{ $userExpensesCurrentMonthSummary['total'] }} zł</td>
            <td>{{ $userExpensesCurrentMonthSummary['remaining'] }} zł</td>
            <td>{{ $userExpensesCurrentMonthSummary['remaining_per_day'] }} zł</td>
        </tr>
        </tbody>
    </table>
</div>

<div class="mt-3">
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">title</th>
            <th scope="col">amount</th>
            <th scope="col">data</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
            @foreach ($userExpensesCurrentMonth as $key => $expense)
                <tr>
                    <th scope="row">{{ ++$key }}</th>
                    <td>{{ $expense->title }}</td>
                    <td>{{ $expense->amount }} zł</td>
                    <td>{{ $expense->created_at }}</td>
                    <td>
                        <button type="button" class="btn btn-secondary" title="edit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"></path>
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"></path>
                            </svg>
                        </button>
                        <button type="button" class="btn btn-secondary" title="remove">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"></path>
                            </svg>
                        </button>
                    </td>
                </tr>
            @endforeach   
        </tbody>
    </table>
</div>


@endsection