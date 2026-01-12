<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>The Book List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .header-info {
            margin-bottom: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>The Book List</h1>
    <div class="header-info">
        <strong>Generated on: {{ now()->setTimezone('Asia/Manila')->format('F d, Y \a\t h:i A') }}</strong>
        <p>Total Records: {{ $books->count() }}</p>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Author</th>
                <th>ISBN</th>
                <th>Category</th>
                <th>Published Date</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody>
            @forelse($books as $book)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $book->title }}</td>
                <td>{{ $book->author }}</td>
                <td>{{ $book->isbn ?? 'N/A' }}</td>
                <td>{{ $book->category->name ?? 'N/A' }}</td>
                <td>{{ $book->published_date ? $book->published_date->format('Y-m-d') : 'N/A' }}</td>
                <td>{{ $book->quantity }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align: center;">No books found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>


