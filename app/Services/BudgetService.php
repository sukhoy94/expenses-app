<?php

declare(strict_types=1);


namespace App\Services;


use App\Models\User;
use App\Repositories\BudgetRepository;
use Carbon\Carbon;

class BudgetService
{
    private $budgetRepository;
    
    public function __construct(BudgetRepository $budgetRepository)
    {
        $this->budgetRepository = $budgetRepository;
    }
    
    public function getUserBudgets(User $user)
    {
        return $user->budgets()->get();
    }
    
    public function currentMonthBudget(User $user)
    {       
        return $this->budgetRepository->getBudget([
            'month' => Carbon::now()->month,
            'user_id' => $user->id,
        ])->first();
    }
}