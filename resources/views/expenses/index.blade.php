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

    @if(session('removeExpenseSuccessMessage'))
        <div class="alert alert-success">
            {{session('removeExpenseSuccessMessage')}}
        </div>
    @endif
    
    @if($userExpensesCurrentMonthSummary['budget'])
        {{-- todo: move this form to component, as it is the same as on edit.blade.php view --}}
        <form method="POST" action="{{route('expenses.store')}}">
            @csrf
            <div class="row">
                <div class="col-md-12 form-group">
                    <label for="expenseCategory">Category</label>
                    <select class="form-control" name="category" id="expenseCategory">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-12 form-group">
                    <label for="expendedTitle">Title</label>
                    <input
                            type="text"
                            class="form-control"
                            id="expendedTitle"
                            placeholder="Title"
                            name="expendedAmountTitle"
                    >
                </div>
                
                <div class="col-md-6 form-group">
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
                
                <div class="col-md-6 form-group">
                    <label for="dateInput">Date</label>
                    <input 
                        type="datetime-local" 
                        class="form-control"
                        id="dateInput"
                        name="expendedDate"
                        
                        value="{{ $currentDateTime }}"
                    >
                </div>

                <div class="col-sm-3 col-xs-12 form-group">
                    <button type="submit" class="btn btn-primary btn-block">
                        Submit
                    </button>
                </div>                
            </div>            
        </form>        

        <span style="font-size: 15px; margin-top: 20px;" class="badge badge-info">Spent today</span>: 
        {{ $spentToday }} {{ $currency['label'] }}
        
        @if ($spentTodayYesterdayDifferenceLabel)
            ({{$spentTodayYesterdayDifference}} {{ $currency['label'] }} {{$spentTodayYesterdayDifferenceLabel}} than yesterday)
        @endif

        <div class="mt-3">
            <x-expenses.summary.desktop :userExpensesCurrentMonthSummary="$userExpensesCurrentMonthSummary"/>
            <x-expenses.summary.mobile :userExpensesCurrentMonthSummary="$userExpensesCurrentMonthSummary"/>        
        </div>

        <div class="mt-3">
            <h4>Top 10</h4>
            <table class="table table-striped table-sm">
                <thead>
                <tr>
                    <th>title</th>
                    <th>amount</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($top10expenses as $key => $expense)
                    <tr>
                        <td>{{ $expense->title }}</td>
                        <td>{{ $expense->amount }} {{ $currency['label'] }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>        

        <div class="mt-3">
            <h4>Expenses</h4>
            <x-expenses.index.desktop :userExpensesCurrentMonth="$userExpensesCurrentMonth"/>
            <x-expenses.index.mobile :userExpensesCurrentMonth="$userExpensesCurrentMonth"/>            
        </div>

    @else
        <div class="alert alert-warning" role="alert">
            <div>
                Please set your budget for this month
            </div>
            <a href="{{ route('budgets.index') }}" class="btn btn-info">Budgets</a>

        </div>
    @endif
    


@endsection