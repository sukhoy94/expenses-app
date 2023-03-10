<?php

declare(strict_types=1);

namespace App\Services\Api;

use App\DataTransferObjects\Api\ExpensesListFiltersDto;
use App\Models\User;
use App\Repositories\ExpenseRepository;
use Illuminate\Support\Collection;

class ExpenseService
{
    private $repository;
    
    public function __construct(ExpenseRepository $repository)
    {
        $this->repository = $repository;
    }
    
    /**
     * @param  User  $user
     * @param  ExpensesListFiltersDto  $filters
     * @return Collection
     */
    public function getUserExpensesList(User $user, ExpensesListFiltersDto $filters): Collection
    {
        return $this->repository->getUserExpenses(
            $user,
            $filters->startPeriod(),
            $filters->endPeriod(),
        );
    }
}