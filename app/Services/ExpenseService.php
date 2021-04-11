<?php

declare(strict_types=1);


namespace App\Services;


use App\Models\Budget;
use App\Models\User;
use App\Repositories\ExpenseRepository;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class ExpenseService
{
    private ExpenseRepository $repository; 
    private UserService $userService; 
    
    public function __construct(ExpenseRepository $repository, UserService $service)
    {
        $this->repository = $repository;    
        $this->userService = $service;    
    }
    
    /**
     * method returns periods where logged user has as at least one expense grouped per year, 
     * for example user has expense in 2021 for months 01,02,03 and in 2020 for months 03,
     * so return collection will looks like:
     * 
     * Illuminate\Support\Collection {#309 ▼
     *       #items: array:2 [▼
     *           2020 => array:2 [▼
     *               "year" => 2020
     *               "periods" => array:1 [▼
     *                   0 => array:3 [▼
     *                       "period" => "03-2020"
     *                       "month_id" => 3
     *                       "year" => 2020
     *                   ]
     *               ]
     *           ]
     *           2021 => array:2 [▼
     *               "year" => 2021
     *               "periods" => array:3 [▼
     *                   0 => array:3 [▼
     *                       "period" => "01-2021"
     *                       "month_id" => 1
     *                       "year" => 2021
     *                   ]
     *                   1 => array:3 [▼
     *                       "period" => "02-2021"
     *                       "month_id" => 2
     *                       "year" => 2021
     *                   ]
     *                   2 => array:3 [▼
     *                       "period" => "03-2021"
     *                       "month_id" => 3
     *                       "year" => 2021
     *                   ]
     *               ]
     *           ]
     *       ]
     *   }
     * 
     * 
     * 
     * @return Collection
     */
    public function getUserExpensePeriodsGroupedPerYear(): Collection
    {
        $result = [];
        $expensesMonthsPeriods = $this->repository->getUserExpensesMonthsPeriods($this->userService->getLoggedUser());
        
        $expensesMonthsPeriods->each(function($collection) use (&$result) {            
            $period = [
                'period' => $collection->label,
                'month_id' => $collection->month_id,
                'year' => $collection->year,
            ];
            
            if (!array_key_exists($collection->year, $result)) {
                $result[$collection->year] = [
                    'year' => $collection->year, 
                    'periods' => [
                        $period,
                    ]
                ];
            } else {
                $result[$collection->year]['periods'][] = $period;                
            }
            
        });
        
        return new Collection($result);
    }
    
    public function getExpensesForCurrentMonth(User $user): Collection
    {
        return $this->repository->getUserExpenses(
            $user,
            new Carbon('first day of this month'),
            new Carbon('last day of this month')
        );
    }
    
    public function getExpensesMonthSummary(Collection $userExpensesCurrentMonth): array
    {
        // TODO: to service
        $budget = Budget::where('month', '=', Carbon::now()->month)
            ->where('year', '=', Carbon::now()->year)
            ->get()
            ->first();
        
        $total = $userExpensesCurrentMonth->sum('amount');
        $remaining = $budget->amount - $total;
        $remaining_per_day = $remaining / Carbon::now()->diffInDays(new Carbon('last day of this month'));
       
        // TODO: to DTO
        return [
            'total' => $total,
            'remaining' => $remaining,
            'remaining_per_day' => $remaining_per_day,
            'budget' => $budget->amount,
        ];
    }
}