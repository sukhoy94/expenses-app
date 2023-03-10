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
    {{-- todo: move this form to component, as it is the same as on index.blade.php view --}}
    <div class="row">
        <div class="col-md-12 form-group">
            <label for="expenseCategory">Category</label>
            <select class="form-control" name="category" id="expenseCategory">
                @foreach($categories as $category)
                    <option @if($expense->category_id == $category->id) selected @endif value="{{ $category->id }}">{{ $category->title }}</option>
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
                value="{{ $expense->title }}"
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
                    value="{{ $expense->amount }}"
            >            
        </div>
    
        <div class="col-md-6 form-group">
            <label for="dateInput">Date</label>
            <input
                    type="datetime-local"
                    class="form-control"
                    id="dateInput"
                    name="expendedDate"
    
                    value="{{ $expenseCreatedAtFormatted }}"
            >
        </div>

        <div class="col-sm-3 col-xs-12 form-group">
            <button type="submit" class="btn btn-primary btn-block">
                Submit
            </button>
        </div>
    </div>
</form>
@endsection