<?php

declare(strict_types=1);


namespace App\Services\Api;


use App\DataTransferObjects\Api\ExpensesListFiltersDto;
use App\Models\User;
use App\Repositories\ExpenseRepository;

class ExpenseService
{
    private $repository;
    
    public function __construct(ExpenseRepository $repository)
    {
        $this->repository = $repository;
    }
    
    /**
     * @param User $user
     * @param ExpensesListFiltersDto $filters
     * @return \Illuminate\Support\Collection
     */
    public function getUserExpensesList(User $user, ExpensesListFiltersDto $filters): \Illuminate\Support\Collection
    {
        return $this->repository->getUserExpenses(
            $user,
            $filters->startPeriod(),
            $filters->endPeriod(),
        );           
    }
}