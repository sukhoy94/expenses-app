<div class="d-none d-sm-block">
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">title</th>
            <th scope="col">amount</th>
            <th scope="col">category</th>
            <th scope="col">data</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($userExpensesCurrentMonth as $key => $expense)
            <tr>
                <td>{{ $expense->title }}</td>
                <td>{{ $expense->amount }} {{ $currency['label'] }}</td>
                <td>{{ $expense->category->title }}</td>
                <td>{{ $expense->created_at }}</td>
                <td>
                    <a href="{{ route('expenses.edit', ['expense' =>  $expense->id]) }}" class="btn btn-secondary" title="edit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"></path>
                            <path fill-rule="evenodd"
                                  d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"></path>
                        </svg>
                    </a>

                    <form style="display: inline" method="post" action="{{ route('expenses.delete', ['expense' => $expense->id,]) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-secondary" title="remove">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-trash-fill" viewBox="0 0 16 16">
                                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"></path>
                            </svg>
                        </button>
                    </form>

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>