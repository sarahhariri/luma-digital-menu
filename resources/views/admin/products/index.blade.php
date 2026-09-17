<x-admin.admin-layout
    title="Products"
    page-title="Products"
>

    <div class="admin-page-toolbar">

        <div>
            <h2>Menu products</h2>

            <p>
                Manage drinks, bakery items, desserts and prices.
            </p>
        </div>

        <a
            href="{{ route('admin.products.create') }}"
            class="admin-primary-button"
        >
            <i class="bi bi-plus-lg"></i>
            Add product
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
                        <th>Product</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Featured</th>
                        <th>Order</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse ($products as $product)

                        <tr>
                            <td>
                                <div class="admin-product-name">

                                    @if ($product->image)
                                        <img
                                            src="{{ asset($product->image) }}"
                                            alt="{{ $product->name }}"
                                            class="admin-product-image"
                                        >
                                    @else
                                        <span class="admin-product-placeholder">
                                            <i class="bi bi-cup-hot"></i>
                                        </span>
                                    @endif

                                    <div>
                                        <strong>
                                            {{ $product->name }}
                                        </strong>

                                        <small>
                                            {{ $product->slug }}
                                        </small>
                                    </div>

                                </div>
                            </td>

                            <td>
                                {{ $product->category->name }}
                            </td>

                            <td>
                                <strong class="admin-product-price">
                                    ${{ number_format($product->price, 2) }}
                                </strong>
                            </td>

                            <td>
                                @if ($product->is_featured)
                                    <span class="admin-featured-badge">
                                        <i class="bi bi-star-fill"></i>
                                        Featured
                                    </span>
                                @else
                                    <span class="admin-table-muted">
                                        —
                                    </span>
                                @endif
                            </td>

                            <td>{{ $product->order }}</td>

                            <td>
                                <span class="admin-status
                                    {{ $product->is_active
                                        ? 'admin-status--active'
                                        : 'admin-status--inactive' }}"
                                >
                                    {{ $product->is_active
                                        ? 'Active'
                                        : 'Inactive' }}
                                </span>
                            </td>

                            <td>
                                <div class="admin-table-actions">

                                    <a
                                        href="{{ route(
                                            'admin.products.edit',
                                            $product
                                        ) }}"
                                        class="admin-action-button
                                            admin-action-button--edit"
                                        title="Edit"
                                    >
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <form
                                        action="{{ route(
                                            'admin.products.destroy',
                                            $product
                                        ) }}"
                                        method="POST"
                                        onsubmit="return confirm(
                                            'Delete this product?'
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
                            <td colspan="7">
                                <div class="admin-empty-state">
                                    <i class="bi bi-cup-hot"></i>

                                    <h3>No products yet</h3>

                                    <p>
                                        Add your first product to start
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