<?php

namespace App\View\Components\Expenses\List;

use Illuminate\View\Component;

class Desktop extends Component
{
    public object $userExpensesCurrentMonth;
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(object $userExpensesCurrentMonth )
    {
        $this->userExpensesCurrentMonth = $userExpensesCurrentMonth;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.expenses.list.desktop');
    }
}
