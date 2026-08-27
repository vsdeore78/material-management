<!DOCTYPE html>
<html>
<head>
    <title>Add Material</title>
</head>
<body>
<nav>
    <a href="{{ route('materials.index') }}">Materials</a> |
    <a href="{{ route('categories.index') }}">Categories</a> |
    <a href="{{ route('transactions.index') }}">Inward / Outward</a>
</nav>
<hr>
    <h1>Add Material</h1>
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
    <form method="POST" action="{{ route('materials.store') }}">
        @csrf

        <label for="category_id">Category</label>
        <select name="category_id" id="category_id">
         <option value="">-- Select Category --</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}"  @selected(old('category_id') == $category->id) >
                    {{ $category->name }}
                </option>
            @endforeach
         </select>

        <div>
            <label for="name">Material Name</label>
            <input type="text" id="name" name="name"  value="{{ old('name') }}">
        </div>
        <div>
            <label for="opening_balance">Opening Balance</label>
            <input type="number" name="opening_balance" id="opening_balance" step="0.01" value="{{ old('opening_balance') }}">
        </div>

        <button type="submit">Save</button>
    </form>

    <a href="{{ route('materials.index') }}">Back to Materials</a>

</body>
</html>