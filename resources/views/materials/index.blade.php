<!DOCTYPE html>
<html>
<head>
    <title>Materials</title>
</head>
<body>
<nav>
    <a href="{{ route('materials.index') }}">Materials</a> |
    <a href="{{ route('categories.index') }}">Categories</a> |
    <a href="{{ route('transactions.index') }}">Inward / Outward</a>
</nav>
<hr>
    <h1>Materials</h1>

    @if (session('success'))
        <div>
            {{ session('success') }}
        </div>
    @endif

    <p>
        <a href="{{ route('materials.create') }}">
            Add Material
        </a>
    </p>

    @if($materials->count())

        <table border="1" cellpadding="8">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Category</th>
                    <th>Material Name</th>
                    <th>Opening Balance</th>
                    <th>Current Balance</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>

                @foreach($materials as $material)

                    <tr>
                        <td>{{ $material->id }}</td>

                        <td>
                            {{ $material->category->name }}
                        </td>

                        <td>
                            {{ $material->name }}
                        </td>

                        <td>
                            {{ number_format($material->opening_balance, 2) }}
                        </td>

                        <td>
                            {{
                                number_format(
                                    $material->opening_balance
                                    + $material->transactions_sum_quantity,
                                    2
                                )
                            }}
                        </td>

                        <td>
                            <a href="{{ route('materials.edit', $material) }}">
                                Edit
                            </a>

                            <form
                                    method="POST"
                                    action="{{ route('materials.destroy', $material) }}"
                                    style="display:inline;"
                                    onsubmit="return confirm('Are you sure you want to delete this material?');"
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

        <p>No materials found.</p>

    @endif

</body>
</html>