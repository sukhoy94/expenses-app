<?php

namespace  App\Http\Controllers;;

use App\Models\User;
use App\Repositories\ExpenseRepository;
use App\Services\ExpenseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    private ExpenseRepository $expenseRepository;
    private ExpenseService $expenseService;
    /**
     *
     * @return void
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
    public function index()
    {
        $months = $this->expenseRepository->getUserExpensesMonthsPeriods(Auth::user());
                
        $this->expenseService->getUserExpensePeriodsGroupedPerYear($months);
        return view('home', [
            'data' => [
                'expenses_months' => $months,
            ]
        ]);
    }
}
