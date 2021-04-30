<?php

declare(strict_types=1);


namespace App\Helpers;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class BudgetHelper
{
    public function addPeriodForBudget(Collection $budgets)
    {
        return $budgets->each(function ($budget) {
            $budget->period = (Carbon::createFromFormat('!m', $budget->month))->format('F');
        }); 
    }
}