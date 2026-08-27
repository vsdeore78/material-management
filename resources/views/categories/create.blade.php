<!DOCTYPE html>
<html>
<head>
    <title>Add Category</title>
</head>
<body>
    <nav>
    <a href="{{ route('materials.index') }}">Materials</a> |
    <a href="{{ route('categories.index') }}">Categories</a> |
    <a href="{{ route('transactions.index') }}">Inward / Outward</a>
</nav>
<hr>

    <h1>Add Category</h1>
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
    <form method="POST" action="{{ route('categories.store') }}">
        @csrf

        <div>
            <label for="name">Category Name</label>
            <input type="text" id="name" name="name"  value="{{ old('name') }}">
        </div>

        <button type="submit">Save</button>
    </form>

    <a href="{{ route('categories.index') }}">Back to Categories</a>

</body>
</html>