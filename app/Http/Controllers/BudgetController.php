<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Helpers\BudgetHelper;
use App\Models\Budget;
use App\Services\BudgetService;
use App\Services\UserService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BudgetController extends Controller
{
    private BudgetService $budgetService;
    private UserService $userService;
    private BudgetHelper $budgetHelper;
    
    public function __construct(
        BudgetService $budgetService,
        UserService $userService,
        BudgetHelper $budgetHelper
    ) {
        $this->budgetService = $budgetService;
        $this->userService = $userService;
        $this->budgetHelper = $budgetHelper;
    }
    
    public function index()
    {
        $currentMonthBudget = $this->budgetService->getCurrentMonthBudgetForUser($this->userService->getLoggedUser());
        $budgets = $this->budgetHelper->addPeriodForBudget(
            $this->budgetService->getUserBudgets($this->userService->getLoggedUser())
        );
        
        return view('budgets.index', [
            'budgets' => $budgets,
            'currentMonthBudget' => $currentMonthBudget,
            'currentMonth' => Carbon::now()->month,
        ]);
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|min:1|numeric',
        ]);
        
        $loggedUserId = $this->userService->getLoggedUser()->id;
        
        if (!$request->id) {
            Budget::updateOrCreate(
                // match condition
                [
                    'user_id' => $loggedUserId, 
                    'month' => Carbon::now()->month, 
                    'year' => Carbon::now()->year,
                ],
                
                // update
                [
                    'amount' => $request->amount, 
                    'user_id' => $loggedUserId, 
                    'month' => Carbon::now()->month,
                    'year' => Carbon::now()->year,
                ]
            );
            
            $request->session()->flash('budgetModifiedSuccessMessage', 'Budget was successfully saved');
            
            return redirect()->route('budgets.index');
        }
    }
}
