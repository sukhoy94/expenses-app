<?php

namespace App\Http\Controllers\Api;

use App\DataTransferObjects\Api\ExpensesListFiltersDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ExpensesListRequest;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index(ExpensesListRequest $request)
    {
        $filters = ExpensesListFiltersDto::fromRequest($request);
    }
}
