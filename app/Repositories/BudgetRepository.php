<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Exceptions\InvalidQueryParameterException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class BudgetRepository
{
    private const MIN_MONTH_RANGE = 1;
    private const MAX_MONTH_RANGE = 12;
    
    public function getBudget(array $params = []): Collection
    {
        $queryBuilder = DB::table('budgets');
        
        if (array_key_exists('month', $params)) {
            $params['month'] = (int) $params['month'];            
            $this->validateMonthRange((int) $params['month']);
            $queryBuilder->where('month', '=', $params['month']);
        }
        
        if (array_key_exists('user_id', $params)) {
            $params['user_id'] = (int) $params['user_id'];
            $queryBuilder->where('user_id', '=', $params['user_id']);
        }
        
        return $queryBuilder->get();
    }
    
    /**
     * @param int $month
     * @return void
     * @throws InvalidQueryParameterException
     */
    private function validateMonthRange(int $month): void
    {
        if ($month < self::MIN_MONTH_RANGE || $month > self::MAX_MONTH_RANGE) {
            throw new InvalidQueryParameterException(
                sprintf(
                    'Month parameter should be in range between %d and %d', 
                    self::MIN_MONTH_RANGE,
                    self::MAX_MONTH_RANGE
                )
            );
        }
    }
}