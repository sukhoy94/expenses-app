<?php

namespace  App\Http\Controllers;;

use App\Repositories\ExpenseRepository;
use App\Services\ExpenseService;

class HomeController extends Controller
{
    private ExpenseRepository $expenseRepository;
    private ExpenseService $expenseService;
    
    /**
     *
     * @param ExpenseRepository $expenseRepository
     * @param ExpenseService $expenseService
     */
    public function __construct(
        ExpenseRepository $expenseRepository,
        ExpenseService $expenseService
    ) {
        $this->middleware('auth');
        
        $this->expenseRepository = $expenseRepository;
        $this->expenseService = $expenseService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(): \Illuminate\Contracts\Support\Renderable
    {
        return view('home', [
            'data' => [
                'expenses_periods' => $this->expenseService->getUserExpensePeriodsGroupedPerYear(),
            ]
        ]);
    }
}
