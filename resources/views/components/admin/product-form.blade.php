@props([
    'product' => null,
    'categories',
    'action',
    'method' => 'POST',
    'submitLabel' => 'Save product',
])

<form
    action="{{ $action }}"
    method="POST"
    enctype="multipart/form-data"
    class="admin-form-card"
>
    @csrf

    @if ($method !== 'POST')
        @method($method)
    @endif

    <div class="admin-form-grid">

        <div class="admin-form-group">
            <label for="category_id">
                Category
                <span>*</span>
            </label>

            <select
                id="category_id"
                name="category_id"
                required
            >
                <option value="">Choose a category</option>

                @foreach ($categories as $category)
                    <option
                        value="{{ $category->id }}"
                        @selected(
                            old(
                                'category_id',
                                $product?->category_id
                            ) == $category->id
                        )
                    >
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            @error('category_id')
                <small class="admin-field__error">
                    {{ $message }}
                </small>
            @enderror
        </div>

        <div class="admin-form-group">
            <label for="name">
                Product name
                <span>*</span>
            </label>

            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name', $product?->name) }}"
                placeholder="Example: Spanish Latte"
                required
            >

            @error('name')
                <small class="admin-field__error">
                    {{ $message }}
                </small>
            @enderror
        </div>

        <div class="admin-form-group admin-form-group--full">
            <label for="description">
                Description
            </label>

            <textarea
                id="description"
                name="description"
                rows="4"
                placeholder="Describe this product..."
            >{{ old('description', $product?->description) }}</textarea>

            @error('description')
                <small class="admin-field__error">
                    {{ $message }}
                </small>
            @enderror
        </div>

        <div class="admin-form-group">
            <label for="price">
                Base price
                <span>*</span>
            </label>

            <input
                type="number"
                id="price"
                name="price"
                value="{{ old('price', $product?->price) }}"
                min="0"
                step="0.01"
                placeholder="4.50"
                required
            >

            @error('price')
                <small class="admin-field__error">
                    {{ $message }}
                </small>
            @enderror
        </div>

        <div class="admin-form-group">
            <label for="order">
                Display order
            </label>

            <input
                type="number"
                id="order"
                name="order"
                value="{{ old('order', $product?->order ?? 0) }}"
                min="0"
            >

            @error('order')
                <small class="admin-field__error">
                    {{ $message }}
                </small>
            @enderror
        </div>

        <div class="admin-form-group admin-form-group--full">
            <label for="image">Product image</label>

            @if ($product?->image)
                <div class="admin-current-image">
                    <img
                        src="{{ asset($product->image) }}"
                        alt="{{ $product->name }}"
                    >

                    <span>Current image</span>
                </div>
            @endif

            <input
                type="file"
                id="image"
                name="image"
                accept=".jpg,.jpeg,.png,.webp"
                class="admin-file-input"
            >

            <small class="admin-form-hint">
                JPG, PNG or WebP. Maximum size: 2MB.
            </small>

            @error('image')
                <small class="admin-field__error">
                    {{ $message }}
                </small>
            @enderror
        </div>

        <div class="admin-form-group">
            <label>Featured product</label>

            <input
                type="hidden"
                name="is_featured"
                value="0"
            >

            <label class="admin-switch">
                <input
                    type="checkbox"
                    name="is_featured"
                    value="1"
                    @checked(old(
                        'is_featured',
                        $product?->is_featured ?? false
                    ))
                >

                <span class="admin-switch__slider"></span>
                <span>Show in Today’s Picks</span>
            </label>
        </div>

        <div class="admin-form-group">
            <label>Status</label>

            <input
                type="hidden"
                name="is_active"
                value="0"
            >

            <label class="admin-switch">
                <input
                    type="checkbox"
                    name="is_active"
                    value="1"
                    @checked(old(
                        'is_active',
                        $product?->is_active ?? true
                    ))
                >

                <span class="admin-switch__slider"></span>
                <span>Active on the menu</span>
            </label>
        </div>

    </div>

    <div class="admin-form-actions">

        <a
            href="{{ route('admin.products.index') }}"
            class="admin-secondary-button"
        >
            Cancel
        </a>

        <button
            type="submit"
            class="admin-primary-button"
        >
            {{ $submitLabel }}
        </button>

    </div>

</form>
