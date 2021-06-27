<?php

declare(strict_types=1);


namespace App\DataTransferObjects\Api;


use App\Http\Requests\Api\ExpensesListRequest;
use Carbon\Carbon;
use Spatie\DataTransferObject\DataTransferObject;

class ExpensesListFiltersDto extends DataTransferObject
{
    public int $year;
    public int $month;      
    
    public static function fromRequest(ExpensesListRequest $request) 
    {
        return new self([
            'year' => (int) $request->input('year'),
            'month' => (int) $request->input('month'),
        ]);
    }
    
    public function startPeriod(): Carbon
    {
        return Carbon::createFromFormat('Y-m-d', "{$this->year}-{$this->month}-01")->firstOfMonth();
    }    
    
    public function endPeriod(): Carbon
    {
        return Carbon::createFromFormat('Y-m-d', "{$this->year}-{$this->month}-01")->endOfMonth();
    }    
}