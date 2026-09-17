@props([
    'category' => null,
    'action',
    'method' => 'POST',
    'submitLabel' => 'Save category',
])

<form
    action="{{ $action }}"
    method="POST"
    class="admin-form-card"
>
    @csrf

    @if ($method !== 'POST')
        @method($method)
    @endif

    <div class="admin-form-grid">

        <div class="admin-form-group">
            <label for="name">
                Category name
                <span>*</span>
            </label>

            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name', $category?->name) }}"
                placeholder="Example: Hot Coffee"
                required
            >

            @error('name')
                <small class="admin-field__error">
                    {{ $message }}
                </small>
            @enderror
        </div>

        <div class="admin-form-group">
            <label for="icon">Icon</label>

            <select id="icon" name="icon">
                <option value="">Choose an icon</option>

                <option
                    value="bi-cup-hot"
                    @selected(old('icon', $category?->icon) === 'bi-cup-hot')
                >
                    Hot Coffee
                </option>

                <option
                    value="bi-cup-straw"
                    @selected(old('icon', $category?->icon) === 'bi-cup-straw')
                >
                    Iced Coffee
                </option>

                <option
                    value="bi-feather"
                    @selected(old('icon', $category?->icon) === 'bi-feather')
                >
                    Matcha
                </option>

                <option
                    value="bi-basket"
                    @selected(old('icon', $category?->icon) === 'bi-basket')
                >
                    Bakery
                </option>

                <option
                    value="bi-cake2"
                    @selected(old('icon', $category?->icon) === 'bi-cake2')
                >
                    Desserts
                </option>

                <option
                    value="bi-tag"
                    @selected(old('icon', $category?->icon) === 'bi-tag')
                >
                    General
                </option>
            </select>

            @error('icon')
                <small class="admin-field__error">
                    {{ $message }}
                </small>
            @enderror
        </div>

        <div class="admin-form-group admin-form-group--full">
            <label for="description">Description</label>

            <textarea
                id="description"
                name="description"
                rows="4"
                placeholder="A short description for this category..."
            >{{ old('description', $category?->description) }}</textarea>

            @error('description')
                <small class="admin-field__error">
                    {{ $message }}
                </small>
            @enderror
        </div>

        <div class="admin-form-group">
            <label for="order">Display order</label>

            <input
                type="number"
                id="order"
                name="order"
                value="{{ old('order', $category?->order ?? 0) }}"
                min="0"
            >

            @error('order')
                <small class="admin-field__error">
                    {{ $message }}
                </small>
            @enderror
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
                        $category?->is_active ?? true
                    ))
                >

                <span class="admin-switch__slider"></span>
                <span>Active on the menu</span>
            </label>
        </div>

    </div>

    <div class="admin-form-actions">

        <a
            href="{{ route('admin.categories.index') }}"
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