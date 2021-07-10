<?php

declare(strict_types=1);


namespace App\Services;


use App\Models\Budget;
use App\Models\Expense;
use App\Models\User;
use App\Repositories\ExpenseRepository;
use App\ValueObjects\DatePeriod\DatePeriod;
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
            Carbon::now()->startOfMonth(),
            Carbon::now()->endOfMonth()
        );
    }
    
    public function getExpensesMonthSummary(User $user): array
    {
        $budget = Budget::where('month', '=', Carbon::now()->month)
            ->where('year', '=', Carbon::now()->year)
            ->where('user_id', '=', $this->userService->getLoggedUser()->id)
            ->get()
            ->first();
        
        $budgetAmount = $budget ? $budget->amount : 0;
        
        $datePeriod = new DatePeriod([
            'from' => Carbon::today()->startOfMonth()->format('Y-m-d'), 
            'to' => Carbon::today()->endOfMonth()->format('Y-m-d'), 
        ]);
        
        $total = $this->getExpensesAmount($user, $datePeriod);
        $remaining = $budgetAmount - $total;
        $remainingPerDay = $remaining / $this->getDaysTillTheEndOfThisMonthIncludingToday();
       
        return [
            'total' => $total,
            'remaining' => $remaining,
            'remaining_per_day' => round($remainingPerDay, 2),
            'budget' => $budgetAmount,
        ];
    }
    
    public function getExpensesAmount(User $user, DatePeriod $datePeriod): float
    {
        return round ($this->repository->getTotalAmountOfSpentMoneyForPeriod($user, $datePeriod), 2);
    }
    
    public function getTodayExpenseAmount(User $user): float
    {
        $datePeriod = new DatePeriod([
            'from' => Carbon::today()->format('Y-m-d'),
            'to' => Carbon::today()->format('Y-m-d'),
        ]);
        
        return round ($this->repository->getTotalAmountOfSpentMoneyForPeriod($user, $datePeriod), 2);
    }
    
    public function getYesterdayExpenseAmount(User $user): float
    {
        $datePeriod = new DatePeriod([
            'from' => Carbon::yesterday()->format('Y-m-d'),
            'to' => Carbon::yesterday()->format('Y-m-d'),
        ]);
        
        return round ($this->repository->getTotalAmountOfSpentMoneyForPeriod($user, $datePeriod), 2);
    }
        
    /**
     * @param Expense $expense
     */
    public function deleteExpense(Expense $expense): void
    {
        $this->repository->delete($expense);
    }
    
    /**
     * @return int
     */
    private function getDaysTillTheEndOfThisMonthIncludingToday(): int
    {
        return Carbon::now()->diffInDays(new Carbon('last day of this month')) + 1;
    }
}