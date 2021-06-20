<?php

declare(strict_types=1);


namespace App\Services\Api;


use App\Models\User;
use App\Repositories\ExpenseRepository;

class ExpenseService
{
    private ExpenseRepository $repository;
    
    public function getExpensesList(User $user)
    {
        
//        $expenses = $this->repository->getUserExpenses();       
    }
}