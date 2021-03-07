<?php

declare(strict_types=1);


namespace App\Repositories;


use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ExpenseRepository
{    
    public function getMonthsWithExpensesForUserForCurrentYear(User $user): Collection
    {       
        // TODO: need refaktoring - year as parametr
        return DB::table('expenses')
            ->select(DB::raw('
                DISTINCT(DATE_FORMAT(created_at, "%m-%Y")) AS label,
                MONTH(created_at) as month_id
            '))
            ->where([
                [
                    'user_id', '=', $user->id,
                ],
                [
                    'created_at', '>', 'YEAR(CURDATE())',       
                ]
            ])
            ->orderBy('created_at')
            ->get();       
    }
}