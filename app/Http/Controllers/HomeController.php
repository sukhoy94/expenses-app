<?php

namespace  App\Http\Controllers;;

use App\Models\User;
use App\Repositories\ExpenseRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $repo = new ExpenseRepository();
        $months = $repo->getMonthsWithExpensesForUserForCurrentYear(Auth::user());
    
        return view('home', [
            'data' => [
                'expenses_months' => $months,
            ]
        ]);
    }
}
