<?php

declare(strict_types=1);


namespace App\Services;


use App\Models\User;
use App\Repositories\BudgetRepository;

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
}