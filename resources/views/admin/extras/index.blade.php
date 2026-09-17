<x-admin.admin-layout
    title="Extras"
    page-title="Extras"
>

    <div class="admin-page-toolbar">

        <div>
            <h2>Menu extras</h2>

            <p>
                Manage optional additions and customization prices.
            </p>
        </div>

        <a
            href="{{ route('admin.extras.create') }}"
            class="admin-primary-button"
        >
            <i class="bi bi-plus-lg"></i>
            Add extra
        </a>

    </div>

    @if (session('success'))
        <div class="admin-alert admin-alert--success">
            <i class="bi bi-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    <div class="admin-table-card">

        <div class="admin-table-responsive">

            <table class="admin-table">

                <thead>
                    <tr>
                        <th>Extra</th>
                        <th>Price</th>
                        <th>Products</th>
                        <th>Order</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse ($extras as $extra)

                        <tr>
                            <td>
                                <div class="admin-category-name">

                                    <span class="admin-category-icon">
                                        <i class="bi bi-plus-circle"></i>
                                    </span>

                                    <div>
                                        <strong>{{ $extra->name }}</strong>
                                        <small>Menu customization</small>
                                    </div>

                                </div>
                            </td>

                            <td>
                                <strong class="admin-product-price">
                                    +${{ number_format(
                                        (float) $extra->price,
                                        2
                                    ) }}
                                </strong>
                            </td>

                            <td>{{ $extra->products_count }}</td>

                            <td>{{ $extra->order }}</td>

                            <td>
                                <span class="admin-status
                                    {{ $extra->is_active
                                        ? 'admin-status--active'
                                        : 'admin-status--inactive' }}"
                                >
                                    {{ $extra->is_active
                                        ? 'Active'
                                        : 'Inactive' }}
                                </span>
                            </td>

                            <td>
                                <div class="admin-table-actions">

                                    <a
                                        href="{{ route(
                                            'admin.extras.edit',
                                            $extra
                                        ) }}"
                                        class="admin-action-button
                                            admin-action-button--edit"
                                        title="Edit"
                                    >
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <form
                                        action="{{ route(
                                            'admin.extras.destroy',
                                            $extra
                                        ) }}"
                                        method="POST"
                                        onsubmit="return confirm(
                                            'Delete this extra?'
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
                                    <i class="bi bi-plus-circle"></i>

                                    <h3>No extras yet</h3>

                                    <p>
                                        Add your first customization
                                        for the LUMA menu.
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