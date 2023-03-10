<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use App\Repositories\BudgetRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class BudgetService
{
    private BudgetRepository $budgetRepository;
    
    public function __construct(BudgetRepository $budgetRepository)
    {
        $this->budgetRepository = $budgetRepository;
    }
    
    public function getUserBudgets(User $user): Collection
    {
        return $user
            ->budgets()
            ->orderByDesc('id')
            ->get();
    }
    
    public function getCurrentMonthBudgetForUser(User $user)
    {
        return $this->budgetRepository->getBudget([
            'month' => Carbon::now()->month,
            'user_id' => $user->id,
        ])->first();
    }
}