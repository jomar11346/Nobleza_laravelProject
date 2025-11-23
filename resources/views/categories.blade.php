<x-layouts.app :title="__('Categories')">
    <div class="relative flex h-full w-full flex-1 flex-col gap-4 rounded-xl">

        <!-- Success/Error Messages -->
        @if (session('success'))
            <div class="alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert-error" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <!-- Category Management Section -->
        <div class="section-card relative overflow-hidden">
            <div class="p-6">
                <div class="mb-6 flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-emerald-500 to-green-600 text-white shadow-lg shadow-emerald-500/30">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                    </div>
                    <h2 class="text-xl font-bold tracking-tight text-neutral-900 dark:text-neutral-100">Category Management</h2>
                </div>
                
                <!-- Add New Category Form -->
                <div class="form-section mb-8">
                    <h3 class="mb-4 text-base font-semibold text-neutral-900 dark:text-neutral-100">Add New Category</h3>
                    
                    <form action="{{ route('categories.store') }}" method="POST" class="grid gap-4 md:grid-cols-2">
                        @csrf

                        <div>
                            <label class="mb-2 block text-sm font-medium text-neutral-700 dark:text-neutral-300">Name</label>
                            <input type="text" name="name" value="{{ old('name') }}" placeholder="Enter category name" required class="form-input">
                            @error('name')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-medium text-neutral-700 dark:text-neutral-300">Description</label>
                            <input type="text" name="description" value="{{ old('description') }}" placeholder="Enter description" class="form-input">
                            @error('description')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-2">
                            <button type="submit" class="btn-success">
                                Add Category
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Categories List Table -->
                <div class="table-container overflow-x-auto">
                    <table class="w-full min-w-full">
                        <thead>
                            <tr class="table-header">
                                <th class="px-4 py-3 text-left text-sm font-semibold text-neutral-700 dark:text-neutral-300">#</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-neutral-700 dark:text-neutral-300">Name</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-neutral-700 dark:text-neutral-300">Description</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-neutral-700 dark:text-neutral-300">Books Count</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-neutral-700 dark:text-neutral-300">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-neutral-200 dark:divide-neutral-700">
                            @forelse ($categories as $category)
                            <tr class="table-row">
                                <td class="px-4 py-3 text-sm text-neutral-600 dark:text-neutral-400">{{ $loop->iteration }}</td>
                                <td class="px-4 py-3 text-sm font-medium text-neutral-900 dark:text-neutral-100">{{ $category->name }}</td>
                                <td class="px-4 py-3 text-sm text-neutral-600 dark:text-neutral-400">{{ $category->description ?? 'N/A' }}</td>
                                <td class="px-4 py-3 text-sm text-neutral-600 dark:text-neutral-400">{{ $category->books_count }} books</td>
                                <td class="px-4 py-3 text-sm">
                                    <button onclick="openEditModal({{ $category->id }}, '{{ $category->name }}', '{{ $category->description ?? '' }}')" class="action-link action-link-edit">Edit</button>
                                    <span class="mx-1 text-neutral-400">|</span>
                                    <form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this category?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-link action-link-delete">Delete</button>
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
    <div id="editCategoryModal" class="modal-overlay hidden">
        <div class="modal-content max-w-md">
            <button onclick="closeEditModal()" class="absolute right-4 top-4 text-neutral-400 transition-colors hover:text-neutral-600 dark:hover:text-neutral-300">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <div class="mb-6 flex items-center gap-3 border-b border-neutral-200 pb-4 dark:border-neutral-700">
                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-gradient-to-br from-emerald-500 to-green-600 text-white shadow-md shadow-emerald-500/30">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold tracking-tight text-neutral-900 dark:text-neutral-100">Edit Category</h3>
            </div>

            <form id="editCategoryForm" method="POST" class="space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label class="mb-2 block text-sm font-medium text-neutral-700 dark:text-neutral-300">Name</label>
                    <input type="text" id="edit_category_name" name="name" required class="form-input">
                    @error('name')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-neutral-700 dark:text-neutral-300">Description</label>
                    <input type="text" id="edit_category_description" name="description" class="form-input">
                    @error('description')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeEditModal()" class="btn-secondary">
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
        function openEditModal(id, name, description) {
            document.getElementById('editCategoryForm').action = `/categories/${id}`;
            document.getElementById('edit_category_name').value = name;
            document.getElementById('edit_category_description').value = description || '';
            document.getElementById('editCategoryModal').classList.remove('hidden');
        }

        function closeEditModal() {
            document.getElementById('editCategoryModal').classList.add('hidden');
        }

        // Close modal when clicking outside
        document.getElementById('editCategoryModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeEditModal();
            }
        });
    </script>
</x-layouts.app>


