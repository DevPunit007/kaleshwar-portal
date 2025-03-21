<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Translations</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Translations List</h2>
        
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Group</th>
                    <th>Key</th>
                    <th>Text</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($translations as $translation)
                    <tr>
                        <td>{{ $translation->id }}</td>
                        <td>{{ $translation->group }}</td>
                        <td>{{ $translation->key }}</td>
                        <td>{{ json_encode($translation->text) }}</td>
                        <td>
                            <form action="{{ route('translations.destroy', $translation->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('translations.create') }}" class="btn btn-primary mt-3">Add New Translation</a>
    </div>
</body>
</html>
