<x-layouts.app :title="__('Dashboard')">
    <div class="relative flex h-full w-full flex-1 flex-col gap-4 rounded-xl">

        <!-- Success Message -->
        @if (session('success'))
            <div id="successMessage" class="alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert-error" role="alert">
                {{ session('error') }}
            </div>
        @endif
        <!-- End Success Message -->

        <!-- Stats Cards -->
        <div class="grid auto-rows-min gap-6 md:grid-cols-3">
            <div class="stat-card group">
                <div class="relative flex items-center justify-between">
                    <div class="space-y-1">
                        <p class="text-sm font-semibold uppercase tracking-wide text-neutral-500 dark:text-neutral-400">Total Books</p>
                        <h3 class="text-4xl font-bold tracking-tight text-neutral-900 dark:text-neutral-100">{{ $books->count() }}</h3>
                        <p class="text-xs text-neutral-500 dark:text-neutral-400">Active collection</p>
                    </div>
                    <div class="icon-container bg-gradient-to-br from-blue-100 to-blue-200 dark:from-blue-900/40 dark:to-blue-800/40">
                        <svg class="h-7 w-7 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="stat-card group">
                <div class="relative flex items-center justify-between">
                    <div class="space-y-1">
                        <p class="text-sm font-semibold uppercase tracking-wide text-neutral-500 dark:text-neutral-400">Total Categories</p>
                        <h3 class="text-4xl font-bold tracking-tight text-neutral-900 dark:text-neutral-100">{{ $categories->count() }}</h3>
                        <p class="text-xs text-neutral-500 dark:text-neutral-400">Organized groups</p>
                    </div>
                    <div class="icon-container bg-gradient-to-br from-emerald-100 to-green-200 dark:from-emerald-900/40 dark:to-green-800/40">
                        <svg class="h-7 w-7 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="stat-card group">
                <div class="relative flex items-center justify-between">
                    <div class="space-y-1">
                        <p class="text-sm font-semibold uppercase tracking-wide text-neutral-500 dark:text-neutral-400">Total Copies</p>
                        <h3 class="text-4xl font-bold tracking-tight text-neutral-900 dark:text-neutral-100">{{ $books->sum('quantity') }}</h3>
                        <p class="text-xs text-neutral-500 dark:text-neutral-400">Available units</p>
                    </div>
                    <div class="icon-container bg-gradient-to-br from-purple-100 to-purple-200 dark:from-purple-900/40 dark:to-purple-800/40">
                        <svg class="h-7 w-7 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        <!-- Book Management Section -->
        <div class="section-card relative h-full flex-1 overflow-hidden">
            <div class="flex h-full flex-col p-6">
                <!-- Add New Book Form -->
                <div class="form-section mb-8">
                    <div class="mb-6 flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 text-white shadow-lg shadow-blue-500/30">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                        </div>
                        <h2 class="text-xl font-bold tracking-tight text-neutral-900 dark:text-neutral-100">Add New Book</h2>
                    </div>
                    
                    <form action="{{ route('books.store') }}" method="POST" class="grid gap-4 md:grid-cols-2">
                        @csrf

                        <div>
                            <label class="mb-2 block text-sm font-medium text-neutral-700 dark:text-neutral-300">
                                Title <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="title" value="{{ old('title') }}" placeholder="Enter book title" required class="form-input">
                            @error('title')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-medium text-neutral-700 dark:text-neutral-300">
                                Author <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="author" value="{{ old('author') }}" placeholder="Enter author name" required class="form-input">
                            @error('author')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-medium text-neutral-700 dark:text-neutral-300">ISBN <span class="text-neutral-500 text-xs font-normal">(optional)</span></label>
                            <input type="text" name="isbn" value="{{ old('isbn') }}" placeholder="Enter ISBN (optional)" class="form-input">
                            @error('isbn')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-medium text-neutral-700 dark:text-neutral-300">
                                Category <span class="text-red-500">*</span>
                            </label>
                            <select name="category_id" required class="form-input">
                                <option value="">Select a category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-medium text-neutral-700 dark:text-neutral-300">
                                Published Date <span class="text-red-500">*</span>
                            </label>
                            <input type="date" name="published_date" value="{{ old('published_date') }}" required class="form-input">
                            @error('published_date')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-medium text-neutral-700 dark:text-neutral-300">
                                Quantity <span class="text-red-500">*</span>
                            </label>
                            <input type="number" name="quantity" value="{{ old('quantity', 1) }}" min="0" placeholder="Enter quantity" required class="form-input">
                            @error('quantity')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-2">
                            <button type="submit" class="btn-primary">
                                Add Book
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Book List Table -->
                <div class="flex-1 overflow-auto">
                    <div class="mb-6 flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-neutral-500 to-neutral-600 text-white shadow-lg shadow-neutral-500/30">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </div>
                        <h2 class="text-xl font-bold tracking-tight text-neutral-900 dark:text-neutral-100">Book List</h2>
                    </div>
                    <div class="table-container overflow-x-auto">
                        <table class="w-full min-w-full">
                            <thead>
                                <tr class="table-header">
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-neutral-700 dark:text-neutral-300">#</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-neutral-700 dark:text-neutral-300">Title</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-neutral-700 dark:text-neutral-300">Author</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-neutral-700 dark:text-neutral-300">ISBN</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-neutral-700 dark:text-neutral-300">Category</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-neutral-700 dark:text-neutral-300">Published Date</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-neutral-700 dark:text-neutral-300">Quantity</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-neutral-700 dark:text-neutral-300">Actions</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-neutral-200 dark:divide-neutral-700">
                                @forelse ($books as $book)
                                <tr class="table-row">
                                    <td class="px-4 py-3 text-sm text-neutral-600 dark:text-neutral-400">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-3 text-sm font-medium text-neutral-900 dark:text-neutral-100">{{ $book->title }}</td>
                                    <td class="px-4 py-3 text-sm text-neutral-600 dark:text-neutral-400">{{ $book->author }}</td>
                                    <td class="px-4 py-3 text-sm text-neutral-600 dark:text-neutral-400">{{ $book->isbn ?? 'N/A' }}</td>
                                    <td class="px-4 py-3 text-sm text-neutral-600 dark:text-neutral-400">
                                        @if($book->category)
                                            <span class="badge badge-primary">{{ $book->category->name }}</span>
                                        @else
                                            <span class="text-neutral-400">N/A</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-sm text-neutral-600 dark:text-neutral-400">{{ $book->published_date ? $book->published_date->format('Y-m-d') : 'N/A' }}</td>
                                    <td class="px-4 py-3 text-sm text-neutral-600 dark:text-neutral-400">{{ $book->quantity }}</td>
                                    <td class="px-4 py-3 text-sm">
                                        <button onclick="openEditBookModal({{ $book->id }}, '{{ addslashes($book->title) }}', '{{ addslashes($book->author) }}', '{{ $book->isbn ?? '' }}', {{ $book->category_id ?? 'null' }}, '{{ $book->published_date ? $book->published_date->format('Y-m-d') : '' }}', {{ $book->quantity }}, '{{ addslashes($book->description ?? '') }}')" class="action-link action-link-edit">Edit</button>
                                        <span class="mx-1 text-neutral-400">|</span>
                                        <form action="{{ route('books.destroy', $book) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this book?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="action-link action-link-delete">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="px-4 py-3 text-center text-sm text-neutral-600 dark:text-neutral-400">No books found.</td>
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
            <button onclick="closeEditBookModal()" class="absolute right-4 top-4 text-neutral-400 transition-colors hover:text-neutral-600 dark:hover:text-neutral-300">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <div class="mb-6 flex items-center gap-3 border-b border-neutral-200 pb-4 dark:border-neutral-700">
                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-gradient-to-br from-blue-500 to-blue-600 text-white shadow-md shadow-blue-500/30">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold tracking-tight text-neutral-900 dark:text-neutral-100">Edit Book</h3>
            </div>

            <form id="editBookForm" method="POST" class="space-y-5">
                @csrf
                @method('PUT')

                <div class="grid gap-4 md:grid-cols-2">
                    <div>
                        <label class="mb-2 block text-sm font-medium text-neutral-700 dark:text-neutral-300">Title</label>
                        <input type="text" id="edit_book_title" name="title" required class="form-input">
                        @error('title')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-medium text-neutral-700 dark:text-neutral-300">Author</label>
                        <input type="text" id="edit_book_author" name="author" required class="form-input">
                        @error('author')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-medium text-neutral-700 dark:text-neutral-300">ISBN</label>
                        <input type="text" id="edit_book_isbn" name="isbn" class="form-input">
                        @error('isbn')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-medium text-neutral-700 dark:text-neutral-300">
                            Category <span class="text-red-500">*</span>
                        </label>
                        <select id="edit_book_category_id" name="category_id" required class="form-input">
                            <option value="">Select a category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-medium text-neutral-700 dark:text-neutral-300">Published Date</label>
                        <input type="date" id="edit_book_published_date" name="published_date" class="form-input">
                        @error('published_date')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-medium text-neutral-700 dark:text-neutral-300">Quantity</label>
                        <input type="number" id="edit_book_quantity" name="quantity" min="0" required class="form-input">
                        @error('quantity')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="mb-2 block text-sm font-medium text-neutral-700 dark:text-neutral-300">Description</label>
                        <textarea id="edit_book_description" name="description" rows="3" class="form-input"></textarea>
                        @error('description')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeEditBookModal()" class="btn-secondary">
                        Cancel
                    </button>
                    <button type="submit" class="btn-primary">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openEditBookModal(id, title, author, isbn, categoryId, publishedDate, quantity, description) {
            document.getElementById('editBookForm').action = `/books/${id}`;
            document.getElementById('edit_book_title').value = title;
            document.getElementById('edit_book_author').value = author;
            document.getElementById('edit_book_isbn').value = isbn || '';
            document.getElementById('edit_book_category_id').value = categoryId || '';
            document.getElementById('edit_book_published_date').value = publishedDate || '';
            document.getElementById('edit_book_quantity').value = quantity;
            document.getElementById('edit_book_description').value = description || '';
            const modal = document.getElementById('editBookModal');
            modal.classList.remove('hidden');
        }

        function closeEditBookModal() {
            document.getElementById('editBookModal').classList.add('hidden');
        }

        // Close modal when clicking outside
        document.getElementById('editBookModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeEditBookModal();
            }
        });

        // Hide success message after 5 seconds
        const successMessage = document.getElementById('successMessage');
        if (successMessage) {
            setTimeout(function() {
                successMessage.style.transition = 'opacity 0.5s ease-out';
                successMessage.style.opacity = '0';
                setTimeout(function() {
                    successMessage.style.display = 'none';
                }, 500);
            }, 5000);
        }
    </script>
</x-layouts.app>
