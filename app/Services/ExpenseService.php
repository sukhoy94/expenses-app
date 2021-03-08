<?php

declare(strict_types=1);


namespace App\Services;


use Illuminate\Support\Collection;

class ExpenseService
{
    public function getUserExpensePeriodsGroupedPerYear(Collection $userExpensePeriods)
    {
        /**
         * 
         * Illuminate\Support\Collection {#293 ▼
            #items: array:3 [▼
            0 => {#1183 ▼
            +"label": "01-2021"
            +"month_id": 1
            +"year": 2021
            }
            1 => {#1184 ▼
            +"label": "02-2021"
            +"month_id": 2
            +"year": 2021
            }
            2 => {#300 ▼
            +"label": "03-2021"
            +"month_id": 3
            +"year": 2021
            }
            ]
         * 
         */
        dd($userExpensePeriods);
    }
}