<!DOCTYPE html>
<html>
<head>
    <title>Categories</title>
</head>
<body>
<nav>
    <a href="{{ route('materials.index') }}">Materials</a> |
    <a href="{{ route('categories.index') }}">Categories</a> |
    <a href="{{ route('transactions.index') }}">Inward / Outward</a>
</nav>
<hr>
    <h1>Categories</h1>

    @if (session('success'))
        <div>
            {{ session('success') }}
        </div>
    @endif

    <p>
        <a href="{{ route('categories.create') }}">Add Category</a>
    </p>

    @if($categories->count())
        <table border="1" cellpadding="8">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Category Name</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>
                            <a href="{{ route('categories.edit', $category) }}">
                                Edit
                            </a>

                            <form
                                method="POST"
                                action="{{ route('categories.destroy', $category) }}"
                                style="display:inline;"
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
        <p>No categories found.</p>
    @endif

</body>
</html>