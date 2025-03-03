<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Dictionary</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
/* Custom Styles */
.query-section label {
    white-space: nowrap; /* Prevent label from breaking into two lines */
}

.btn-container {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.form-control {
    width: 100%;
}

/* Table Styling */
.table-container {
    max-height: 300px;
    overflow-y: auto;
    border: 1px solid #dee2e6;
    border-radius: 5px;
    position: relative; /* Ensure the container is a positioning context */
}

.table {
    width: 100%;
    border-collapse: collapse;
}

.table thead {
    position: sticky;
    top: 0;
    background: #f8f9fa;
    z-index: 2;
    border-bottom: 2px solid #dee2e6;
}

.table th, .table td {
    padding: 12px;
    text-align: left;
    vertical-align: middle;
    border-bottom: 1px solid #dee2e6;
}

.table tbody tr:hover {
    background-color: #f1f1f1;
}

/* Sticky Footer */
body {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
}

.container {
    flex: 1;
}

footer {
    text-align: center;
    padding: 15px;
    background: #f8f9fa;
    border-top: 1px solid #dee2e6;
    margin-top: auto;
}

/* ✅ General Tablet Styles (All Tablets ≤ 1024px) */
@media (max-width: 1024px) {
    .query-section {
        display: flex;
        flex-direction: column; /* Stack inputs properly */
        gap: 10px;
    }

    .query-section label {
        font-size: 1rem;
    }

    .btn-container {
        flex-direction: column; /* Stack buttons on tablets */
        align-items: center;
        gap: 10px;
    }

    .table-container {
        max-height: 250px;
    }

    .table th, .table td {
        padding: 8px;
        font-size: 0.95rem;
    }
}

/* ✅ iPad Air & iPad Mini Fixes (≤ 834px) */
@media (max-width: 834px) {
    .query-section {
        flex-direction: column;
        gap: 8px;
    }

    .query-section label {
        font-size: 0.95rem;
    }

    .btn-container {
        flex-direction: column; /* Stack buttons */
        align-items: center;
        gap: 10px;
    }

    .btn-container .btn {
        width: 100%; /* Full width buttons */
        max-width: 200px;
        font-size: 0.9rem;
        padding: 8px 0;
    }

    .table-container {
        max-height: 220px;
    }

    .table th, .table td {
        padding: 7px;
        font-size: 0.9rem;
    }
}

/* ✅ Small Tablets & Large Phones (≤ 768px) */
@media (max-width: 768px) {
    .query-section {
        flex-direction: column;
        gap: 8px;
    }

    .query-section label {
        font-size: 0.9rem;
    }

    .btn-container {
        flex-direction: column;
        align-items: center;
        gap: 10px;
    }

    .btn-container .btn {
        width: 100%;
        max-width: 200px;
        font-size: 0.9rem;
        padding: 8px 0;
    }

    .table-container {
        max-height: 200px;
    }

    .table th, .table td {
        padding: 6px;
        font-size: 0.85rem;
    }
}

/* ✅ Mobile View (≤ 599px) - Buttons Side by Side */
@media (max-width: 599px) {
    .btn-container {
        flex-direction: row; /* Arrange buttons side by side */
        justify-content: center;
        gap: 10px;
        width: 100%;
    }

    .btn-container .btn {
        flex: 1; /* Equal size buttons */
        text-align: center;
        font-size: 0.9rem;
        padding: 8px 0;
    }
}

/* ✅ Small Mobile (≤ 480px) - Adjusted Buttons */
@media (max-width: 480px) {
    .query-section {
        gap: 8px;
    }

    .btn-container {
        flex-direction: row;
        justify-content: center;
        gap: 5px;
        width: 100%;
    }

    .btn-container .btn {
        flex: 1; /* Equal size buttons */
        text-align: center;
        font-size: 0.9rem;
        padding: 8px 0;
    }

    .table th, .table td {
        padding: 6px;
        font-size: 0.85rem;
    }
}

</style>
</head>
<body>

<div class="container my-5">
    <h1 class="text-center">Online Dictionary</h1>

    <!-- Top Half: Search Section & Word of the Day -->
    <div class="row mt-4">
        <!-- Left Section: Search -->
        <div class="col-md-6">
            <form action="{{ route('dictionary') }}" method="GET">
                <div class="row">
                    <!-- Search Fields -->
                    <div class="col-md-10 d-flex flex-column query-section">
                        <div class="mb-3 d-flex align-items-center w-100">
                            <label class="fw-bold me-2">Word:</label>
                            <input type="text" name="word" class="form-control flex-grow-1" value="{{ request('word') }}" placeholder="Search for a word">
                        </div>

                        <div class="mb-2 d-flex align-items-center">
                            <label class="fw-bold me-2">Word Length:</label>
                            <input type="number" name="word_length" class="form-control flex-grow-1" value="{{ request('word_length') }}" placeholder="Word Length">
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="col-md-2 d-flex align-items-center justify-content-end">
                        <div class="btn-container">
                            <button type="submit" class="btn btn-primary">Search</button>
                            <a href="{{ route('dictionary') }}" class="btn btn-danger">Clear</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Right Section: Word of the Day -->
        <div class="col-md-6 d-flex justify-content-end">
            <div class="p-3 bg-light border rounded" style="width: 100%; max-width: 400px;">
                <h5 class="fw-bold text-center" style="font-size: 1.2rem;">Word of the Day</h5>
                <h4 class="text-center text-primary" style="font-size: 1.5rem;">{{ $wordOfTheDay->word ?? 'N/A' }}</h4>
                <p class="text-center" style="font-size: 1.1rem;">{{ $wordOfTheDay->meaning ?? 'No word today' }}</p>
            </div>
        </div>
    </div>

    <!-- Bottom Half: Search Results -->
    @if(request()->has('word') || request()->has('word_length'))
        <div class="mt-4">
            <h5>Total Number of Words: {{ $words->count() }}</h5>

            @if ($words->isNotEmpty())
                <div class="table-container">
                    <table class="table table-bordered mt-2">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Word</th>
                                <th>Meaning</th>
                                <th>Length</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($words as $index => $word)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $word->word }}</td>
                                    <td>{{ $word->meaning }}</td>
                                    <td>{{ $word->word_length }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-muted text-center">No results found.</p>
            @endif
        </div>
    @else
        <p class="text-muted text-center mt-4">{{ $message ?? 'Please enter a word to search.' }}</p>
    @endif

    <!-- Word Detail Section -->
    @if($wordDetail)
        <div class="mt-5 text-center">
            <h2>{{ $wordDetail->word }}</h2>
            <p>{{ $wordDetail->meaning }}</p>
            <a href="{{ route('dictionary', request()->except('word_id')) }}" class="btn btn-secondary">Back to Search</a>
        </div>
    @endif

</div>

<!-- Footer -->
<footer>
    <p>&copy; 2025 Online Dictionary. All Rights Reserved.</p>
</footer>

</body>
</html>
