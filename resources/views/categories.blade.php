<x-layouts.app :title="__('Categories')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">

        <!-- Success/Error Messages -->
        @if (session('success'))
            <div class="rounded-lg bg-green-100 p-4 text-sm text-green-700 dark:bg-green-900/30 dark:text-green-400" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="rounded-lg bg-red-100 p-4 text-sm text-red-700 dark:bg-red-900/30 dark:text-red-400" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <!-- Category Management Section -->
        <div class="relative overflow-hidden rounded-xl border border-neutral-200 bg-white dark:border-neutral-700 dark:bg-neutral-800">
            <div class="p-6">
                <h2 class="mb-4 text-lg font-semibold text-neutral-900 dark:text-neutral-100">Category Management</h2>
                
                <!-- Add New Category Form -->
                <div class="mb-6 rounded-lg border border-neutral-200 bg-neutral-50 p-4 dark:border-neutral-700 dark:bg-neutral-900/50">
                    <h3 class="mb-3 text-sm font-semibold text-neutral-900 dark:text-neutral-100">Add New Category</h3>
                    
                    <form action="{{ route('categories.store') }}" method="POST" class="grid gap-4 md:grid-cols-2">
                        @csrf

                        <div>
                            <label class="mb-2 block text-sm font-medium text-neutral-700 dark:text-neutral-300">Name</label>
                            <input type="text" name="name" value="{{ old('name') }}" placeholder="Enter category name" required class="w-full rounded-lg border border-neutral-300 bg-white px-4 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-neutral-600 dark:bg-neutral-800 dark:text-neutral-100">
                            @error('name')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-medium text-neutral-700 dark:text-neutral-300">Description</label>
                            <input type="text" name="description" value="{{ old('description') }}" placeholder="Enter description" class="w-full rounded-lg border border-neutral-300 bg-white px-4 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-neutral-600 dark:bg-neutral-800 dark:text-neutral-100">
                            @error('description')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-2">
                            <button type="submit" class="rounded-lg bg-green-600 px-6 py-2 text-sm font-medium text-white transition-colors hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500/20">
                                Add Category
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Categories List Table -->
                <div class="overflow-x-auto">
                    <table class="w-full min-w-full">
                        <thead>
                            <tr class="border-b border-neutral-200 bg-neutral-50 dark:border-neutral-700 dark:bg-neutral-900/50">
                                <th class="px-4 py-3 text-left text-sm font-semibold text-neutral-700 dark:text-neutral-300">#</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-neutral-700 dark:text-neutral-300">Name</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-neutral-700 dark:text-neutral-300">Description</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-neutral-700 dark:text-neutral-300">Books Count</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-neutral-700 dark:text-neutral-300">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-neutral-200 dark:divide-neutral-700">
                            @forelse ($categories as $category)
                            <tr class="transition-colors hover:bg-neutral-50 dark:hover:bg-neutral-800/50">
                                <td class="px-4 py-3 text-sm text-neutral-600 dark:text-neutral-400">{{ $loop->iteration }}</td>
                                <td class="px-4 py-3 text-sm text-neutral-900 dark:text-neutral-100">{{ $category->name }}</td>
                                <td class="px-4 py-3 text-sm text-neutral-600 dark:text-neutral-400">{{ $category->description ?? 'N/A' }}</td>
                                <td class="px-4 py-3 text-sm text-neutral-600 dark:text-neutral-400">{{ $category->books_count }} books</td>
                                <td class="px-4 py-3 text-sm">
                                    <button onclick="openEditModal({{ $category->id }}, '{{ $category->name }}', '{{ $category->description ?? '' }}')" class="text-blue-600 transition-colors hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300">Edit</button>
                                    <span class="mx-1 text-neutral-400">|</span>
                                    <form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this category?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 transition-colors hover:text-red-700 dark:text-red-400 dark:hover:text-red-300">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-4 py-3 text-center text-sm text-neutral-600 dark:text-neutral-400">No categories found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Category Modal -->
    <div id="editCategoryModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50">
        <div class="relative w-full max-w-md rounded-lg bg-white p-6 shadow-xl dark:bg-neutral-800">
            <button onclick="closeEditModal()" class="absolute right-4 top-4 text-neutral-400 hover:text-neutral-600 dark:hover:text-neutral-300">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <h3 class="mb-4 text-lg font-semibold text-neutral-900 dark:text-neutral-100">Edit Category</h3>

            <form id="editCategoryForm" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="mb-2 block text-sm font-medium text-neutral-700 dark:text-neutral-300">Name</label>
                    <input type="text" id="edit_category_name" name="name" required class="w-full rounded-lg border border-neutral-300 bg-white px-4 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-neutral-600 dark:bg-neutral-800 dark:text-neutral-100">
                    @error('name')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-neutral-700 dark:text-neutral-300">Description</label>
                    <input type="text" id="edit_category_description" name="description" class="w-full rounded-lg border border-neutral-300 bg-white px-4 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-neutral-600 dark:bg-neutral-800 dark:text-neutral-100">
                    @error('description')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeEditModal()" class="rounded-lg border border-neutral-300 bg-white px-4 py-2 text-sm font-medium text-neutral-700 transition-colors hover:bg-neutral-50 dark:border-neutral-600 dark:bg-neutral-800 dark:text-neutral-300 dark:hover:bg-neutral-700">
                        Cancel
                    </button>
                    <button type="submit" class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white transition-colors hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500/20">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openEditModal(id, name, description) {
            document.getElementById('editCategoryForm').action = `/categories/${id}`;
            document.getElementById('edit_category_name').value = name;
            document.getElementById('edit_category_description').value = description || '';
            document.getElementById('editCategoryModal').classList.remove('hidden');
            document.getElementById('editCategoryModal').classList.add('flex');
        }

        function closeEditModal() {
            document.getElementById('editCategoryModal').classList.add('hidden');
            document.getElementById('editCategoryModal').classList.remove('flex');
        }

        // Close modal when clicking outside
        document.getElementById('editCategoryModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeEditModal();
            }
        });
    </script>
</x-layouts.app>


