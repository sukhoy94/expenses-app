<?php

declare(strict_types=1);


namespace App\DataTransferObjects\Api;


use App\Http\Requests\Api\ExpensesListRequest;
use Spatie\DataTransferObject\DataTransferObject;

class ExpensesListFiltersDto extends DataTransferObject
{
    public int $year;
    public int $month;    
    
    public static function fromRequest(ExpensesListRequest $request) {
        return new self([
            'year' => (int) $request->input('year'),
            'month' => (int) $request->input('month'),
        ]);
    }       
}