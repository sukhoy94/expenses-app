<div class="d-none d-sm-block">
    <table class="table mt-3">
        <thead>
        <tr>
            <th scope="col">budget</th>
            <th scope="col">expended</th>
            <th scope="col">remaining</th>
            <th scope="col">remaining per day</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>{{ $userExpensesCurrentMonthSummary['budget'] }} {{ $currency['label'] }}</td>
            <td>{{ $userExpensesCurrentMonthSummary['total'] }} {{ $currency['label'] }}</td>
            <td>{{ $userExpensesCurrentMonthSummary['remaining'] }} {{ $currency['label'] }}</td>
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
        </tbody>
    </table>
</div>