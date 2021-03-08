<?php

namespace  App\Http\Controllers;;

use App\Models\User;
use App\Repositories\ExpenseRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    private ExpenseRepository $expenseRepository;
    /**
     *
     * @return void
     */
    public function __construct(ExpenseRepository $expenseRepository)
    {
        $this->middleware('auth');
        $this->expenseRepository = $expenseRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $months = $this->expenseRepository->getMonthsWithExpensesForUserForCurrentYear(Auth::user());
    
        return view('home', [
            'data' => [
                'expenses_months' => $months,
            ]
        ]);
    }
}
