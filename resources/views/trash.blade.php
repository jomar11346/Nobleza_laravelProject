<x-layouts.app :title="__('Trash')">
    <div class="relative flex h-full w-full flex-1 flex-col gap-4 rounded-xl">

        <!-- Success/Error Messages -->
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

        <!-- Trash Management Section -->
        <div class="section-card relative overflow-hidden">
            <div class="p-6">
                <div class="mb-6 flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-red-500 to-red-600 text-white shadow-lg shadow-red-500/30">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </div>
                    <h2 class="text-xl font-bold tracking-tight text-neutral-900 dark:text-neutral-100">Trash - Deleted Books</h2>
                </div>

                <!-- Trash List Table -->
                <div class="table-container overflow-x-auto">
                    <table class="w-full min-w-full">
                        <thead>
                            <tr class="table-header">
                                <th class="px-4 py-3 text-left text-sm font-semibold text-neutral-700 dark:text-neutral-300">#</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-neutral-700 dark:text-neutral-300">Photo</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-neutral-700 dark:text-neutral-300">Title</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-neutral-700 dark:text-neutral-300">Author</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-neutral-700 dark:text-neutral-300">ISBN</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-neutral-700 dark:text-neutral-300">Category</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-neutral-700 dark:text-neutral-300">Deleted At</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-neutral-700 dark:text-neutral-300">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-neutral-200 dark:divide-neutral-700">
                            @forelse ($books as $book)
                            <tr class="table-row">
                                <td class="px-4 py-3 text-sm text-neutral-600 dark:text-neutral-400">{{ $loop->iteration }}</td>
                                <td class="px-4 py-3">
                                    @if($book->photo)
                                        <img src="{{ asset('storage/' . $book->photo) }}" alt="{{ $book->title }}" class="h-10 w-10 rounded-full object-cover">
                                    @else
                                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-gradient-to-br from-gray-500 to-gray-600 text-white text-sm font-semibold">
                                            {{ strtoupper(substr($book->title, 0, 1)) }}
                                        </div>
                                    @endif
                                </td>
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
                                <td class="px-4 py-3 text-sm text-neutral-600 dark:text-neutral-400">{{ $book->deleted_at ? $book->deleted_at->setTimezone('Asia/Manila')->format('Y-m-d h:i A') : 'N/A' }}</td>
                                <td class="px-4 py-3 text-sm">
                                    <form action="{{ route('trash.restore', $book->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="action-link action-link-edit">Restore</button>
                                    </form>
                                     <span class="mx-1 text-neutral-400">|</span>
                                    <form action="{{ route('trash.force-delete', $book->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to permanently delete this book?.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-link action-link-delete">Delete Permanently</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="px-4 py-3 text-center text-sm text-neutral-600 dark:text-neutral-400">Trash is empty. No deleted books found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
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