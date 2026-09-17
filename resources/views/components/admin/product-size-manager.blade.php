@props(['product'])

<section class="product-size-manager">

    <div class="product-size-manager__header">
        <div>
            <span class="form-eyebrow">PRODUCT OPTIONS</span>
            <h2>Manage sizes</h2>
            <p>Add the available sizes and prices for this product.</p>
        </div>
    </div>

    @if (session('success'))
        <div class="admin-alert admin-alert--success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="admin-alert admin-alert--error">
            Please check the size information and try again.
        </div>
    @endif

    {{-- Add size --}}
    <form
        action="{{ route('admin.products.sizes.store', $product) }}"
        method="POST"
        class="product-size-form"
    >
        @csrf

        <div class="size-field">
            <label for="size-name">Size name</label>
            <input
                id="size-name"
                type="text"
                name="name"
                value="{{ old('name') }}"
                placeholder="Example: Small"
                required
            >
        </div>

        <div class="size-field">
            <label for="size-price">Price</label>
            <input
                id="size-price"
                type="number"
                name="price"
                value="{{ old('price') }}"
                placeholder="0.00"
                min="0"
                step="0.01"
                required
            >
        </div>

        <div class="size-field">
            <label for="size-order">Order</label>
            <input
                id="size-order"
                type="number"
                name="order"
                value="{{ old('order', 1) }}"
                min="0"
                required
            >
        </div>

        <label class="size-checkbox">
            <input
                type="checkbox"
                name="is_default"
                value="1"
                @checked(old('is_default'))
            >
            Default
        </label>

        <label class="size-checkbox">
            <input
                type="checkbox"
                name="is_active"
                value="1"
                @checked(old('is_active', true))
            >
            Active
        </label>

        <button type="submit" class="admin-primary-button">
            <i class="bi bi-plus-lg"></i>
            Add size
        </button>
    </form>

    {{-- Existing sizes --}}
    <div class="product-size-list">

        @forelse ($product->sizes as $size)

            <div class="product-size-row">

                <form
                    action="{{ route('admin.sizes.update', $size) }}"
                    method="POST"
                    class="product-size-edit-form"
                >
                    @csrf
                    @method('PUT')

                    <input
                        type="text"
                        name="name"
                        value="{{ $size->name }}"
                        required
                    >

                    <input
                        type="number"
                        name="price"
                        value="{{ number_format((float) $size->price, 2, '.', '') }}"
                        min="0"
                        step="0.01"
                        required
                    >

                    <input
                        type="number"
                        name="order"
                        value="{{ $size->order }}"
                        min="0"
                        required
                    >

                    <label class="size-checkbox">
                        <input
                            type="checkbox"
                            name="is_default"
                            value="1"
                            @checked($size->is_default)
                        >
                        Default
                    </label>

                    <label class="size-checkbox">
                        <input
                            type="checkbox"
                            name="is_active"
                            value="1"
                            @checked($size->is_active)
                        >
                        Active
                    </label>

                    <button type="submit" class="size-save-button">
                        <i class="bi bi-check-lg"></i>
                        Save
                    </button>
                </form>

                <form
                    action="{{ route('admin.sizes.destroy', $size) }}"
                    method="POST"
                    onsubmit="return confirm('Delete this size?')"
                >
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="size-delete-button">
                        <i class="bi bi-trash"></i>
                    </button>
                </form>

            </div>

        @empty

            <div class="product-size-empty">
                No sizes added yet.
            </div>

        @endforelse

    </div>

</section>