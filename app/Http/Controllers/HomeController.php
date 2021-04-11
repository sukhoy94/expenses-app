<?php

namespace  App\Http\Controllers;;

use App\Repositories\ExpenseRepository;
use App\Services\ExpenseService;
use Illuminate\Contracts\Support\Renderable;

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
     * @return Renderable
     */
    public function index(): Renderable
    {
        return view('home', [
            'data' => [
                'expenses_periods' => $this->expenseService->getUserExpensePeriodsGroupedPerYear(),
            ]
        ]);
    }
}
