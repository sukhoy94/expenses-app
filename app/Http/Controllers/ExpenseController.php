<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Services\ExpenseService;
use App\Services\UserService;
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
        $userExpensesCurrentMonth = $this->expenseService->getExpensesForCurrentMonth($this->userService->getLoggedUser());
        $userExpensesCurrentMonthSummary = $this->expenseService->getExpensesMonthSummary($userExpensesCurrentMonth);   
       
        return view('expenses.index', [
            'userExpensesCurrentMonth' => $userExpensesCurrentMonth,
            'userExpensesCurrentMonthSummary' => $userExpensesCurrentMonthSummary,
        ]);
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'expendedAmount' => 'required|min:1|numeric',
            'expendedAmountTitle' => 'required',
        ]);

        $expense = new Expense();
        
        $expense->amount = $request->input('expendedAmount');
        $expense->title = $request->input('expendedAmountTitle');
        $expense->user_id = $this->userService->getLoggedUser()->id;
        
        $expense->save();
    
        $request->session()->flash('addExpenseSuccessMessage', 'Expense was successfully added');
        return redirect()->route('expenses.index');
    }
}
