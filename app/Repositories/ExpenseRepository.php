<?php

declare(strict_types=1);


namespace App\Repositories;


use App\Models\Expense;
use Carbon\Carbon;
use Carbon\Traits\Date;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ExpenseRepository
{    
    public function getUserExpensesMonthsPeriods(User $user): Collection
    {
        return DB::table('expenses')
            ->select(DB::raw('
                DISTINCT(DATE_FORMAT(created_at, "%m-%Y")) AS label,
                MONTH(created_at) as month_id,
                YEAR(created_at) as year
            '))
            ->where('user_id', '=', $user->id,)
            ->orderBy('created_at')
            ->get();
    }
    
    public function getUserExpenses(User $user, Carbon $from, Carbon $to): Collection
    {
        return Expense::where('user_id', '=', $user->id)
            ->whereBetween('created_at', [
                $from, 
                $to,
            ])
            ->orderBy('id', 'desc')
            ->get();
    }
    
    public function delete(Expense $expense) 
    {
        Expense::find($expense->id)->delete();
    }
}