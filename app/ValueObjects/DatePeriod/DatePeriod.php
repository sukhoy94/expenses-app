<?php

declare(strict_types=1);


namespace App\ValueObjects\DatePeriod;


use App\Exceptions\InvalidDatePeriodException;
use Carbon\Carbon;

class DatePeriod
{
    private Carbon $from;
    private Carbon $to;
    
    /**
     * @throws InvalidDatePeriodException
     */
    public function __construct(array $period = [])
    {
        $from = $period['from'];
        $to = $period['to'];
        
        try {
            $this->from = Carbon::createFromFormat('Y-m-d', $from)->startOfDay();
            $this->to = Carbon::createFromFormat('Y-m-d', $to)->startOfDay();
        } catch (\Exception $exception) {
            throw new InvalidDatePeriodException('invalid format, correct format is Y-m-d, for example 2020-02-02');
        }
        
        
        if ($this->from->greaterThan($this->to)) {
            throw new InvalidDatePeriodException('start date cannot be greater than end date');
        }
    }
    
    /**
     * @return Carbon
     */
    public function from(): Carbon
    {
        return $this->from;
    }
    
    /**
     * @return Carbon
     */
    public function to(): Carbon
    {
        return $this->to;
    }
}