<x-admin.admin-layout
    title="Categories"
    page-title="Categories"
>

    <div class="admin-page-toolbar">

        <div>
            <h2>Menu categories</h2>

            <p>
                Organize the LUMA menu into clear sections.
            </p>
        </div>

        <a
            href="{{ route('admin.categories.create') }}"
            class="admin-primary-button"
        >
            <i class="bi bi-plus-lg"></i>
            Add category
        </a>

    </div>

    @if (session('success'))
        <div class="admin-alert admin-alert--success">
            <i class="bi bi-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="admin-alert admin-alert--error">
            <i class="bi bi-exclamation-circle"></i>
            {{ session('error') }}
        </div>
    @endif

    <div class="admin-table-card">

        <div class="admin-table-responsive">

            <table class="admin-table">

                <thead>
                    <tr>
                        <th>Category</th>
                        <th>Description</th>
                        <th>Products</th>
                        <th>Order</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse ($categories as $category)

                        <tr>
                            <td>
                                <div class="admin-category-name">

                                    <span class="admin-category-icon">
                                        <i class="bi {{ $category->icon ?: 'bi-tag' }}"></i>
                                    </span>

                                    <div>
                                        <strong>{{ $category->name }}</strong>
                                        <small>{{ $category->slug }}</small>
                                    </div>

                                </div>
                            </td>

                            <td class="admin-table__description">
                                {{ $category->description
                                    ? \Illuminate\Support\Str::limit(
                                        $category->description,
                                        60
                                    )
                                    : '—' }}
                            </td>

                            <td>{{ $category->products_count }}</td>

                            <td>{{ $category->order }}</td>

                            <td>
                                <span class="admin-status
                                    {{ $category->is_active
                                        ? 'admin-status--active'
                                        : 'admin-status--inactive' }}"
                                >
                                    {{ $category->is_active
                                        ? 'Active'
                                        : 'Inactive' }}
                                </span>
                            </td>

                            <td>
                                <div class="admin-table-actions">

                                    <a
                                        href="{{ route(
                                            'admin.categories.edit',
                                            $category
                                        ) }}"
                                        class="admin-action-button
                                            admin-action-button--edit"
                                        title="Edit"
                                    >
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <form
                                        action="{{ route(
                                            'admin.categories.destroy',
                                            $category
                                        ) }}"
                                        method="POST"
                                        onsubmit="return confirm(
                                            'Delete this category?'
                                        )"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="admin-action-button
                                                admin-action-button--delete"
                                            title="Delete"
                                        >
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="6">
                                <div class="admin-empty-state">
                                    <i class="bi bi-tags"></i>
                                    <h3>No categories yet</h3>
                                    <p>
                                        Add your first category to start
                                        building the LUMA menu.
                                    </p>
                                </div>
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</x-admin.admin-layout>