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

    @if(session('budgetModifiedSuccessMessage'))
        <div class="alert alert-success">
            {{session('budgetModifiedSuccessMessage')}}
        </div>
    @endif
    
    <div class="mt-5">
        <h4 class="mb-3">Set your budget for current month</h4>
        <form method="POST" action="{{route('budgets.store')}}">
            @csrf 
            <div class="form-group">
                <label for="budgetAmount">Budget</label>
                <input 
                        type="number" 
                        class="form-control" 
                        id="budgetAmount" 
                        placeholder="Enter budget" 
                        @if($currentMonthBudget)
                            value="{{ $currentMonthBudget->amount }}"
                        @endif
                        name="amount"
                >
            </div>
            <button type="submit" class="btn btn-primary">Save</button>

        </form>
    </div>

    <div class="mt-5">
        <h4 class="mb-3">History</h4>

        <table class="table mt-3">
            <thead>
                <tr>
                    <th scope="col">period</th>
                    <th scope="col">budget</th>
                </tr>
            </thead>
            <tbody>
            @foreach($budgets as $budget)
                <tr>
                    <td>{{$budget->period}}</td>
                    <td>{{$budget->amount}} zł</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection