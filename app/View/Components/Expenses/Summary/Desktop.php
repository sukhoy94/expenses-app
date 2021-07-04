<?php

namespace App\View\Components\Expenses\Summary;

use Illuminate\View\Component;

class Desktop extends Component
{
    public array $userExpensesCurrentMonthSummary;
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(array $userExpensesCurrentMonthSummary)
    {
        $this->userExpensesCurrentMonthSummary = $userExpensesCurrentMonthSummary;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.expenses.summary.desktop');
    }
}
