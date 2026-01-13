<x-layouts.app :title="__('Dashboard')">
    <div class="relative flex h-full w-full flex-1 flex-col gap-6 rounded-xl">

        <!-- Success Message -->
        @if (session('success'))
            <div id="successMessage" class="alert-success" role="alert">
                <div class="flex items-center gap-3">
                    <svg class="h-5 w-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="alert-error" role="alert">
                <div class="flex items-center gap-3">
                    <svg class="h-5 w-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{ session('error') }}</span>
                </div>
            </div>
        @endif
        <!-- End Success Message -->

        <!-- Stats Cards -->
        <div class="grid auto-rows-min gap-5 md:grid-cols-3 lg:gap-6">
            <div class="stat-card group">
                <div class="relative flex items-center justify-between">
                    <div class="space-y-2">
                        <p class="text-xs font-semibold uppercase tracking-wider text-neutral-500 dark:text-neutral-400">Total Books</p>
                        <h3 class="text-3xl font-bold tracking-tight text-neutral-900 dark:text-neutral-100 md:text-4xl">{{ $books->count() }}</h3>
                        <p class="text-xs text-neutral-500 dark:text-neutral-400">Active collection</p>
                    </div>
                    <div class="icon-container bg-gradient-to-br from-blue-100 to-blue-200 dark:from-blue-900/40 dark:to-blue-800/40">
                        <svg class="h-6 w-6 text-blue-600 dark:text-blue-400 md:h-7 md:w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="stat-card group">
                <div class="relative flex items-center justify-between">
                    <div class="space-y-2">
                        <p class="text-xs font-semibold uppercase tracking-wider text-neutral-500 dark:text-neutral-400">Total Genres</p>
                        <h3 class="text-3xl font-bold tracking-tight text-neutral-900 dark:text-neutral-100 md:text-4xl">{{ $categories->count() }}</h3>
                        <p class="text-xs text-neutral-500 dark:text-neutral-400">Organized groups</p>
                    </div>
                    <div class="icon-container bg-gradient-to-br from-emerald-100 to-green-200 dark:from-emerald-900/40 dark:to-green-800/40">
                        <svg class="h-6 w-6 text-emerald-600 dark:text-emerald-400 md:h-7 md:w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="stat-card group">
                <div class="relative flex items-center justify-between">
                    <div class="space-y-2">
                        <p class="text-xs font-semibold uppercase tracking-wider text-neutral-500 dark:text-neutral-400">Total Copies</p>
                        <h3 class="text-3xl font-bold tracking-tight text-neutral-900 dark:text-neutral-100 md:text-4xl">{{ $books->sum('quantity') }}</h3>
                        <p class="text-xs text-neutral-500 dark:text-neutral-400">Available units</p>
                    </div>
                    <div class="icon-container bg-gradient-to-br from-purple-100 to-purple-200 dark:from-purple-900/40 dark:to-purple-800/40">
                        <svg class="h-6 w-6 text-purple-600 dark:text-purple-400 md:h-7 md:w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        <!-- Book Management Section -->
        <div class="section-card relative h-full flex-1 overflow-hidden">
            <div class="flex h-full flex-col p-5 md:p-6 lg:p-8">
                <!-- Add New Book Form -->
                <div class="form-section mb-6 md:mb-8">
                    <div class="mb-5 flex items-center gap-3 md:mb-6">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 text-white shadow-lg shadow-blue-500/30 transition-transform hover:scale-110">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                        </div>
                        <h2 class="text-lg font-bold tracking-tight text-neutral-900 dark:text-neutral-100 md:text-xl">Add New Book</h2>
                    </div>
                    
                    <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data" class="grid gap-4 md:grid-cols-2 md:gap-5">
                        @csrf

                        <div class="space-y-1.5">
                            <label class="block text-sm font-semibold text-neutral-700 dark:text-neutral-300">
                                Title <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="title" value="{{ old('title') }}" placeholder="Enter book title" required class="form-input">
                            @error('title')
                                <p class="mt-1 text-xs font-medium text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-1.5">
                            <label class="block text-sm font-semibold text-neutral-700 dark:text-neutral-300">
                                Author <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="author" value="{{ old('author') }}" placeholder="Enter author name" required class="form-input">
                            @error('author')
                                <p class="mt-1 text-xs font-medium text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-1.5">
                            <label class="block text-sm font-semibold text-neutral-700 dark:text-neutral-300">ISBN <span class="text-neutral-500 text-xs font-normal">(optional)</span></label>
                            <input type="text" name="isbn" value="{{ old('isbn') }}" placeholder="Enter ISBN (optional)" class="form-input">
                            @error('isbn')
                                <p class="mt-1 text-xs font-medium text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-1.5">
                            <label class="block text-sm font-semibold text-neutral-700 dark:text-neutral-300">
                                Category <span class="text-red-500">*</span>
                            </label>
                            <select name="category_id" required class="form-input">
                                <option value="">Select a genre</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="mt-1 text-xs font-medium text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-1.5">
                            <label class="block text-sm font-semibold text-neutral-700 dark:text-neutral-300">
                                Published Date <span class="text-red-500">*</span>
                            </label>
                            <input type="date" name="published_date" value="{{ old('published_date') }}" required class="form-input">
                            @error('published_date')
                                <p class="mt-1 text-xs font-medium text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-1.5">
                            <label class="block text-sm font-semibold text-neutral-700 dark:text-neutral-300">
                                Quantity <span class="text-red-500">*</span>
                            </label>
                            <input type="number" name="quantity" value="{{ old('quantity', 1) }}" min="0" placeholder="Enter quantity" required class="form-input">
                            @error('quantity')
                                <p class="mt-1 text-xs font-medium text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-1.5">
                            <label class="block text-sm font-semibold text-neutral-700 dark:text-neutral-300">
                                Photo <span class="text-neutral-500 text-xs font-normal">(JPG/PNG, max 2MB)</span>
                            </label>
                            <input type="file" name="photo" accept="image/jpeg,image/jpg,image/png" class="form-input file:mr-4 file:rounded-lg file:border-0 file:bg-blue-50 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-blue-900/30 dark:file:text-blue-300">
                            @error('photo')
                                <p class="mt-1 text-xs font-medium text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-2 pt-2">
                            <button type="submit" class="btn-primary w-full md:w-auto">
                                <span class="flex items-center justify-center gap-2">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                    </svg>
                                    Add Book
                                </span>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Book List Table -->
                <div class="flex-1 overflow-auto">
                    <div class="mb-5 flex flex-col gap-4 md:mb-6 lg:flex-row lg:items-center lg:justify-between">
                        <div class="flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-neutral-500 to-neutral-600 text-white shadow-lg shadow-neutral-500/30 transition-transform hover:scale-110">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                            </div>
                            <h2 class="text-lg font-bold tracking-tight text-neutral-900 dark:text-neutral-100 md:text-xl">Book List</h2>
                        </div>
                        
                        <!-- Search, Filter, and Export Section -->
                        <form method="GET" action="{{ route('dashboard') }}" class="flex flex-wrap items-stretch gap-3">
                            <div class="flex-1 min-w-[200px]">
                                <div class="relative">
                                    <svg class="absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by title, author, or ISBN..." class="form-input pl-10">
                                </div>
                            </div>
                            <div class="min-w-[150px]">
                                <select name="category_id" class="form-input">
                                    <option value="">All Categories</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn-primary whitespace-nowrap">
                                <span class="flex items-center gap-2">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                    Search
                                </span>
                            </button>
                            @if(request('search') || request('category_id'))
                                <a href="{{ route('dashboard') }}" class="btn-secondary whitespace-nowrap flex items-center gap-2">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                    Clear
                                </a>
                            @endif
                            <a href="{{ route('books.export.pdf', request()->query()) }}" class="btn-secondary whitespace-nowrap flex items-center gap-2">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Export PDF
                            </a>
                        </form>
                    </div>
                    <div class="table-container overflow-x-auto">
                        <table class="w-full min-w-full">
                            <thead>
                                <tr class="table-header">
                                    <th class="px-4 py-3.5 text-left text-xs font-semibold uppercase tracking-wider text-neutral-700 dark:text-neutral-300">#</th>
                                    <th class="px-4 py-3.5 text-left text-xs font-semibold uppercase tracking-wider text-neutral-700 dark:text-neutral-300">Photo</th>
                                    <th class="px-4 py-3.5 text-left text-xs font-semibold uppercase tracking-wider text-neutral-700 dark:text-neutral-300">Title</th>
                                    <th class="px-4 py-3.5 text-left text-xs font-semibold uppercase tracking-wider text-neutral-700 dark:text-neutral-300">Author</th>
                                    <th class="px-4 py-3.5 text-left text-xs font-semibold uppercase tracking-wider text-neutral-700 dark:text-neutral-300 hidden lg:table-cell">ISBN</th>
                                    <th class="px-4 py-3.5 text-left text-xs font-semibold uppercase tracking-wider text-neutral-700 dark:text-neutral-300">Category</th>
                                    <th class="px-4 py-3.5 text-left text-xs font-semibold uppercase tracking-wider text-neutral-700 dark:text-neutral-300 hidden md:table-cell">Published Date</th>
                                    <th class="px-4 py-3.5 text-left text-xs font-semibold uppercase tracking-wider text-neutral-700 dark:text-neutral-300">Quantity</th>
                                    <th class="px-4 py-3.5 text-left text-xs font-semibold uppercase tracking-wider text-neutral-700 dark:text-neutral-300">Actions</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-neutral-200 dark:divide-neutral-700">
                                @forelse ($books as $book)
                                <tr class="table-row">
                                    <td class="px-4 py-4 text-sm font-medium text-neutral-600 dark:text-neutral-400">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-4">
                                        @if($book->photo)
                                            <img src="{{ asset('storage/' . $book->photo) }}" alt="{{ $book->title }}" class="h-12 w-12 rounded-lg object-cover shadow-md ring-2 ring-neutral-200 dark:ring-neutral-700">
                                        @else
                                            <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-gradient-to-br from-blue-500 to-blue-600 text-white text-sm font-bold shadow-md ring-2 ring-neutral-200 dark:ring-neutral-700">
                                                {{ strtoupper(substr($book->title, 0, 1)) }}
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="text-sm font-semibold text-neutral-900 dark:text-neutral-100">{{ $book->title }}</div>
                                    </td>
                                    <td class="px-4 py-4 text-sm text-neutral-600 dark:text-neutral-400">{{ $book->author }}</td>
                                    <td class="px-4 py-4 text-sm text-neutral-600 dark:text-neutral-400 hidden lg:table-cell">{{ $book->isbn ?? 'N/A' }}</td>
                                    <td class="px-4 py-4">
                                        @if($book->category)
                                            <span class="badge badge-primary">{{ $book->category->name }}</span>
                                        @else
                                            <span class="text-xs text-neutral-400 dark:text-neutral-500">N/A</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-4 text-sm text-neutral-600 dark:text-neutral-400 hidden md:table-cell">{{ $book->published_date ? $book->published_date->format('Y-m-d') : 'N/A' }}</td>
                                    <td class="px-4 py-4">
                                        <span class="inline-flex items-center rounded-full bg-neutral-100 px-2.5 py-1 text-xs font-semibold text-neutral-800 dark:bg-neutral-700 dark:text-neutral-200">{{ $book->quantity }}</span>
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="flex items-center gap-2">
                                            <button onclick="openEditBookModal({{ $book->id }}, '{{ addslashes($book->title) }}', '{{ addslashes($book->author) }}', '{{ $book->isbn ?? '' }}', {{ $book->category_id ?? 'null' }}, '{{ $book->published_date ? $book->published_date->format('Y-m-d') : '' }}', {{ $book->quantity }}, '{{ addslashes($book->description ?? '') }}', '{{ $book->photo ? addslashes(asset('storage/' . $book->photo)) : '' }}')" class="action-link action-link-edit flex items-center gap-1">
                                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                                Edit
                                            </button>
                                            <span class="text-neutral-300 dark:text-neutral-600">|</span>
                                            <form action="{{ route('books.destroy', $book) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this book?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="action-link action-link-delete flex items-center gap-1">
                                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="9" class="px-4 py-12 text-center">
                                        <div class="flex flex-col items-center justify-center gap-3">
                                            <svg class="h-12 w-12 text-neutral-400 dark:text-neutral-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                            </svg>
                                            <p class="text-sm font-medium text-neutral-600 dark:text-neutral-400">No books found.</p>
                                            @if(request('search') || request('category_id'))
                                                <a href="{{ route('dashboard') }}" class="text-sm text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300">Clear filters</a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Book Modal -->
    <div id="editBookModal" class="modal-overlay hidden">
        <div class="modal-content">
            <button onclick="closeEditBookModal()" class="sticky top-0 z-10 ml-auto flex rounded-lg p-1.5 text-neutral-400 transition-all hover:bg-neutral-100 hover:text-neutral-600 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 md:absolute md:right-4 md:top-4">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <div class="mb-5 flex items-center gap-3 border-b border-neutral-200 pb-4 dark:border-neutral-700 md:mb-6">
                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-gradient-to-br from-blue-500 to-blue-600 text-white shadow-md shadow-blue-500/30 transition-transform hover:scale-110">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold tracking-tight text-neutral-900 dark:text-neutral-100 md:text-xl">Edit Book</h3>
            </div>

            <form id="editBookForm" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf
                @method('PUT')

                <div class="grid gap-4 md:grid-cols-2 md:gap-5">
                    <div class="space-y-1.5">
                        <label class="block text-sm font-semibold text-neutral-700 dark:text-neutral-300">Title <span class="text-red-500">*</span></label>
                        <input type="text" id="edit_book_title" name="title" required class="form-input">
                        @error('title')
                            <p class="mt-1 text-xs font-medium text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-sm font-semibold text-neutral-700 dark:text-neutral-300">Author <span class="text-red-500">*</span></label>
                        <input type="text" id="edit_book_author" name="author" required class="form-input">
                        @error('author')
                            <p class="mt-1 text-xs font-medium text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-sm font-semibold text-neutral-700 dark:text-neutral-300">ISBN</label>
                        <input type="text" id="edit_book_isbn" name="isbn" class="form-input">
                        @error('isbn')
                            <p class="mt-1 text-xs font-medium text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-sm font-semibold text-neutral-700 dark:text-neutral-300">
                            Category <span class="text-red-500">*</span>
                        </label>
                        <select id="edit_book_category_id" name="category_id" required class="form-input">
                            <option value="">Select a category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="mt-1 text-xs font-medium text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-sm font-semibold text-neutral-700 dark:text-neutral-300">Published Date</label>
                        <input type="date" id="edit_book_published_date" name="published_date" class="form-input">
                        @error('published_date')
                            <p class="mt-1 text-xs font-medium text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-sm font-semibold text-neutral-700 dark:text-neutral-300">Quantity <span class="text-red-500">*</span></label>
                        <input type="number" id="edit_book_quantity" name="quantity" min="0" required class="form-input">
                        @error('quantity')
                            <p class="mt-1 text-xs font-medium text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-sm font-semibold text-neutral-700 dark:text-neutral-300">
                            Photo <span class="text-neutral-500 text-xs font-normal">(JPG/PNG, max 2MB)</span>
                        </label>
                        <input type="hidden" id="edit_book_remove_photo" name="remove_photo" value="0">
                        <div class="mb-2" id="edit_book_photo_preview"></div>
                        <input type="file" id="edit_book_photo" name="photo" accept="image/jpeg,image/jpg,image/png" class="form-input file:mr-4 file:rounded-lg file:border-0 file:bg-blue-50 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-blue-900/30 dark:file:text-blue-300">
                        @error('photo')
                            <p class="mt-1 text-xs font-medium text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2 space-y-1.5">
                        <label class="block text-sm font-semibold text-neutral-700 dark:text-neutral-300">Description</label>
                        <textarea id="edit_book_description" name="description" rows="3" class="form-input" placeholder="Enter book description (optional)"></textarea>
                        @error('description')
                            <p class="mt-1 text-xs font-medium text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex flex-col-reverse justify-end gap-3 border-t border-neutral-200 pt-5 dark:border-neutral-700 sm:flex-row">
                    <button type="button" onclick="closeEditBookModal()" class="btn-secondary w-full sm:w-auto">
                        Cancel
                    </button>
                    <button type="submit" class="btn-primary w-full sm:w-auto">
                        <span class="flex items-center justify-center gap-2">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Update Book
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openEditBookModal(id, title, author, isbn, categoryId, publishedDate, quantity, description, photo) {
            document.getElementById('editBookForm').action = `/books/${id}`;
            document.getElementById('edit_book_title').value = title;
            document.getElementById('edit_book_author').value = author;
            document.getElementById('edit_book_isbn').value = isbn || '';
            document.getElementById('edit_book_category_id').value = categoryId || '';
            document.getElementById('edit_book_published_date').value = publishedDate || '';
            document.getElementById('edit_book_quantity').value = quantity;
            document.getElementById('edit_book_description').value = description || '';
            
            // Reset remove photo flag
            document.getElementById('edit_book_remove_photo').value = '0';
            document.getElementById('edit_book_photo').value = '';
            
            // Handle photo preview
            const photoPreview = document.getElementById('edit_book_photo_preview');
            if (photo) {
                photoPreview.innerHTML = `
                    <div class="mb-2">
                        <span class="text-xs font-medium text-neutral-600 dark:text-neutral-400 mb-2 block">Current photo:</span>
                        <div class="relative inline-block">
                            <img src="${photo}" alt="Current photo" class="h-24 w-24 rounded-lg object-cover shadow-md ring-2 ring-neutral-200 dark:ring-neutral-700" id="current_photo_preview">
                            <button type="button" onclick="removeBookPhoto()" class="absolute -right-2 -top-2 flex h-6 w-6 items-center justify-center rounded-full bg-red-500 text-white shadow-lg transition-all hover:bg-red-600 hover:scale-110 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-neutral-800" title="Remove photo">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                `;
            } else {
                photoPreview.innerHTML = '';
            }
            
            // Reset remove photo flag when a new file is selected
            const photoInput = document.getElementById('edit_book_photo');
            const removePhotoHandler = function() {
                if (this.files && this.files.length > 0) {
                    document.getElementById('edit_book_remove_photo').value = '0';
                }
            };
            photoInput.removeEventListener('change', removePhotoHandler);
            photoInput.addEventListener('change', removePhotoHandler);
            
            const modal = document.getElementById('editBookModal');
            modal.classList.remove('hidden');
            // Prevent body scroll when modal is open
            document.body.style.overflow = 'hidden';
        }

        function closeEditBookModal() {
            document.getElementById('editBookModal').classList.add('hidden');
            // Restore body scroll when modal is closed
            document.body.style.overflow = '';
        }

        // Close modal when clicking outside
        document.getElementById('editBookModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeEditBookModal();
            }
        });

        // Close modal on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && !document.getElementById('editBookModal').classList.contains('hidden')) {
                closeEditBookModal();
            }
        });

        // Function to remove book photo
        function removeBookPhoto() {
            if (confirm('Are you sure you want to remove this photo?')) {
                document.getElementById('edit_book_remove_photo').value = '1';
                document.getElementById('edit_book_photo_preview').innerHTML = '';
                document.getElementById('edit_book_photo').value = '';
            }
        }

        // Hide success message after 5 seconds
        const successMessage = document.getElementById('successMessage');
        if (successMessage) {
            setTimeout(function() {
                successMessage.style.transition = 'opacity 0.3s ease-out';
                successMessage.style.opacity = '0';
                setTimeout(function() {
                    successMessage.style.display = 'none';
                }, 500);
            }, 5000);
        }
    </script>
</x-layouts.app>
