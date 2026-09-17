@props([
    'product',
    'extras',
])

<section class="product-extra-manager">

    <div class="product-extra-manager__header">
        <div>
            <span class="form-eyebrow">
                PRODUCT CUSTOMIZATIONS
            </span>

            <h2>Available extras</h2>

            <p>
                Choose which extras customers can add
                to this product.
            </p>
        </div>
    </div>

    <form
        action="{{ route(
            'admin.products.extras.sync',
            $product
        ) }}"
        method="POST"
    >
        @csrf
        @method('PUT')

        <div class="product-extra-grid">

            @forelse ($extras as $extra)

                <label class="product-extra-option">

                    <input
                        type="checkbox"
                        name="extras[]"
                        value="{{ $extra->id }}"
                        @checked(
                            $product->extras->contains($extra->id)
                        )
                    >

                    <span class="product-extra-option__icon">
                        <i class="bi bi-plus-circle"></i>
                    </span>

                    <span class="product-extra-option__info">
                        <strong>{{ $extra->name }}</strong>

                        <small>
                            +${{ number_format(
                                (float) $extra->price,
                                2
                            ) }}
                        </small>
                    </span>

                    <span class="admin-status
                        {{ $extra->is_active
                            ? 'admin-status--active'
                            : 'admin-status--inactive' }}"
                    >
                        {{ $extra->is_active
                            ? 'Active'
                            : 'Inactive' }}
                    </span>

                </label>

            @empty

                <div class="product-size-empty">
                    No extras are available yet.
                </div>

            @endforelse

        </div>

        @if ($extras->isNotEmpty())
            <div class="product-extra-actions">
                <button
                    type="submit"
                    class="admin-primary-button"
                >
                    <i class="bi bi-check-lg"></i>
                    Save extras
                </button>
            </div>
        @endif

    </form>

</section>