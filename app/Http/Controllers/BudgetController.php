<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Helpers\BudgetHelper;
use App\Services\BudgetService;
use App\Services\UserService;
use Illuminate\Http\Request;

class BudgetController extends Controller
{
    private $budgetService;
    private $userService;
    private $budgetHelper;
    
    public function __construct(
        BudgetService $budgetService, 
        UserService $userService,
        BudgetHelper $budgetHelper
    )
    {
        $this->budgetService = $budgetService;
        $this->userService = $userService;
        $this->budgetHelper = $budgetHelper;
    }
    
    public function index()
    {
        $budgets = $this->budgetHelper->addPeriodForBudget(
            $this->budgetService->getUserBudgets($this->userService->getLoggedUser())
        );
                
        
        return view('budgets.index', [
            'budgets' => $budgets,
        ]);
    }
}
