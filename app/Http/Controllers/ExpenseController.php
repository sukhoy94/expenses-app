<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExpenseRequest;
use App\Models\Category;
use App\Models\Expense;
use App\Services\ExpenseService;
use App\Services\UserService;
use App\ValueObjects\DatePeriod\DatePeriod;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    private $userService;
    private $expenseService;
    
    public function __construct(UserService $userService, ExpenseService $expenseService)
    {
        $this->userService = $userService;
        $this->expenseService = $expenseService;
    }
    
    public function index()
    {        
        $user = $this->userService->getLoggedUser();
        
        $userExpensesCurrentMonth = $this->expenseService->getExpensesForCurrentMonth($user);
        $userExpensesCurrentMonthSummary = $this->expenseService->getExpensesMonthSummary($user);   
        $spentToday = $this->expenseService->getTodayExpenseAmount($user);   
        $spentYesterday = $this->expenseService->getYesterdayExpenseAmount($user);   

        $spentTodayYesterdayDifference = $spentToday - $spentYesterday;
     
        if ($spentTodayYesterdayDifference > 0) {
            $spentTodayYesterdayDifferenceLabel = 'more';
        } else {
            $spentTodayYesterdayDifferenceLabel = 'less';
        }
        
        $top10expenses = $userExpensesCurrentMonth
            ->sortBy('amount', SORT_REGULAR, true)
            ->slice(0,10);
        
        return view('expenses.index', [
            'userExpensesCurrentMonth' => $userExpensesCurrentMonth,
            'userExpensesCurrentMonthSummary' => $userExpensesCurrentMonthSummary,
            'spentToday' => $spentToday,
            'spentTodayYesterdayDifferenceLabel' => $spentTodayYesterdayDifferenceLabel,
            'spentTodayYesterdayDifference' => $spentTodayYesterdayDifference,
            'categories' => Category::all(),
            'top10expenses' => $top10expenses,
        ]);
    }
    
    public function edit(Expense $expense)
    {
        return view('expenses.edit', [
            'expense' => $expense,
            'categories' => Category::all(),
        ]);
    }
    
    public function update(StoreExpenseRequest $request, Expense $expense)
    {
        $expense->amount = $request->expendedAmount;   
        $expense->title = $request->expendedAmountTitle;   
        $expense->category_id = $request->category;   
        $expense->save();
        
        $request->session()->flash('updateExpenseSuccessMessage', 'Expense was successfully updated');
        return redirect()->route('expenses.edit', ['expense' => $expense->id]);
    }
    
    public function store(StoreExpenseRequest $request)
    {
        $expense = new Expense();
        
        $expense->amount = $request->input('expendedAmount');
        $expense->title = $request->input('expendedAmountTitle');
        $expense->category_id = $request->input('category');
    
        $expense->user_id = $this->userService->getLoggedUser()->id;
        
        $expense->save();
    
        $request->session()->flash('addExpenseSuccessMessage', 'Expense was successfully added');
        return redirect()->route('expenses.index');
    }
    
    public function delete(Expense $expense, Request $request)
    {
        $this->expenseService->deleteExpense($expense);
        $request->session()->flash('removeExpenseSuccessMessage', 'Expense was successfully deleted');
        return redirect()->route('expenses.index');
    }
}
