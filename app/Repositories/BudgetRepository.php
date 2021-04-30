<?php

declare(strict_types=1);


namespace App\Repositories;


use App\Exceptions\InvalidQueryParameterException;
use App\Models\Budget;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BudgetRepository
{
    public function getBudget(array $params = [])
    {
        $queryBuilder = DB::table('budgets');
        
        if (array_key_exists('month', $params)) {
            $params['month'] = (int) $params['month'];
            
            if ($params['month'] < 1 || $params['month'] > 12) {
                throw new InvalidQueryParameterException('Month parameter should be in range between 1 and 12');
            }
            
            $queryBuilder->where('month', '=', $params['month']);
        }
        
        if (array_key_exists('user_id', $params)) {
            $params['user_id'] = (int) $params['user_id'];
            $queryBuilder->where('user_id', '=', $params['user_id']);
        }
        
        return $queryBuilder->get();
    }
}