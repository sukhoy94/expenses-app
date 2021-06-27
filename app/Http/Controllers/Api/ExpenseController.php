<?php

namespace App\Http\Controllers\Api;

use App\DataTransferObjects\Api\ExpensesListFiltersDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ExpensesListRequest;
use App\Services\Api\ExpenseService;
use App\Services\UserService;
use Carbon\Carbon;

class ExpenseController extends Controller
{
    private $expenseService;
    private $userService;
    
    public function __construct(
        ExpenseService $expenseService,
        UserService $userService
    )
    {
        $this->expenseService = $expenseService;        
        $this->userService = $userService;        
    }
    
    public function index(ExpensesListRequest $request)
    {
        $filters = ExpensesListFiltersDto::fromRequest($request);
        $expenses = $this->expenseService->getUserExpensesList($this->userService->getLoggedUser(), $filters);
    
        $expenses->each(function ($expense) {
            $expense->category = $expense->category->title;
        });

        return response()->json([
            'expenses' => $expenses,
        ]);
    }
}
