<!DOCTYPE html>
<html>
<head>
    <title>Inward / Outward Transactions</title>
</head>
<body>
<nav>
    <a href="{{ route('materials.index') }}">Materials</a> |
    <a href="{{ route('categories.index') }}">Categories</a> |
    <a href="{{ route('transactions.index') }}">Inward / Outward</a>
</nav>
<hr>
    <h1>Inward / Outward Transactions</h1>

    @if (session('success'))
        <div>
            {{ session('success') }}
        </div>
    @endif

    <p>
        <a href="{{ route('transactions.create') }}">
            Add Inward / Outward
        </a>
    </p>

    @if($transactions->count())

        <table border="1" cellpadding="8">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Category</th>
                    <th>Material</th>
                    <th>Date</th>
                    <th>Quantity</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>

                @foreach($transactions as $transaction)

                    <tr>
                        <td>{{ $transaction->id }}</td>

                        <td>
                            {{ $transaction->material->category->name }}
                        </td>

                        <td>
                            {{ $transaction->material->name }}
                        </td>

                        <td>
                            {{ $transaction->transaction_date }}
                        </td>

                        <td>
                            {{ number_format($transaction->quantity, 2) }}
                        </td>

                        <td>
                            <a href="{{ route('transactions.edit', $transaction) }}">
                                Edit
                            </a>

                            <form
                                method="POST"
                                action="{{ route('transactions.destroy', $transaction) }}"
                                style="display:inline;"
                                onsubmit="return confirm('Are you sure you want to delete this transaction?');"
                            >
                                @csrf
                                @method('DELETE')

                                <button type="submit">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>

                @endforeach

            </tbody>
        </table>

    @else

        <p>No transactions found.</p>

    @endif

</body>
</html>