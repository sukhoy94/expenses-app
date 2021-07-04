<div class="d-block d-sm-none">
    <table class="table mt-3">
        <tr>
            <td>budget</td>
            <td>{{ $userExpensesCurrentMonthSummary['budget'] }} {{ $currency['label'] }}</td>
        </tr>
        <tr>
            <td>expended</td>
            <td>{{ $userExpensesCurrentMonthSummary['total'] }} {{ $currency['label'] }}</td>
        </tr>
        <tr>
            <td>remaining</td>
            <td>{{ $userExpensesCurrentMonthSummary['remaining'] }} {{ $currency['label'] }}</td>
        </tr>
        <tr>
            <td>remaining per day</td>
            <td>
                            <span
                                    class="
                                    badge 
                                    @if ($userExpensesCurrentMonthSummary['remaining_per_day'] > 100)
                                            badge-success
@elseif(($userExpensesCurrentMonthSummary['remaining_per_day'] > 50))
                                            badge-warning
@else
                                            badge-danger
@endif
                                            "
                            > 
                            {{ $userExpensesCurrentMonthSummary['remaining_per_day'] }} {{ $currency['label'] }}
                        </span>
            </td>
        </tr>
    </table>
</div>