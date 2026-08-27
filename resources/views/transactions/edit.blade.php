<!DOCTYPE html>
<html>
<head>
    <title>Edit Inward / Outward</title>
</head>
<body>
<nav>
    <a href="{{ route('materials.index') }}">Materials</a> |
    <a href="{{ route('categories.index') }}">Categories</a> |
    <a href="{{ route('transactions.index') }}">Inward / Outward</a>
</nav>
<hr>
    <h1>Edit Inward / Outward</h1>

    @if ($errors->any())
        <div>
            <strong>Please fix the following errors:</strong>

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('transactions.update', $transaction) }}">
        @csrf
        @method('PUT')

        <div>
            <label for="material_id">Material</label>

            <select name="material_id" id="material_id">
                <option value="">-- Select Material --</option>

                @foreach($materials as $material)
                    <option
                        value="{{ $material->id }}"
                        @selected(old('material_id', $transaction->material_id) == $material->id)
                    >
                        {{ $material->category->name }} - {{ $material->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="transaction_date">Date</label>

            <input
                type="date"
                name="transaction_date"
                id="transaction_date"
                value="{{ old('transaction_date', $transaction->transaction_date) }}"
            >
        </div>

        <div>
            <label for="quantity">Quantity</label>

            <input
                type="number"
                name="quantity"
                id="quantity"
                step="0.01"
                value="{{ old('quantity', $transaction->quantity) }}"
            >
        </div>

        <button type="submit">Update</button>
    </form>

    <a href="{{ route('transactions.index') }}">
        Back to Transactions
    </a>

</body>
</html>