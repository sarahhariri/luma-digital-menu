@props([
    'extra' => null,
    'action',
    'method' => 'POST',
    'submitLabel' => 'Save extra',
])

<form
    action="{{ $action }}"
    method="POST"
    class="extra-form-card"
>
    

    @if ($method !== 'POST')
        @method($method)
    @endif

    @if ($errors->any())
        <div class="admin-alert admin-alert--error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="extra-form-grid">

        <div class="extra-form-field">
            <label for="name">Extra name *</label>

            <input
                id="name"
                type="text"
                name="name"
                value="{{ old('name', $extra?->name) }}"
                placeholder="Example: Extra shot"
                required
            >
        </div>

        <div class="extra-form-field">
            <label for="price">Additional price *</label>

            <input
                id="price"
                type="number"
                name="price"
                value="{{ old('price', $extra?->price) }}"
                placeholder="0.00"
                min="0"
                step="0.01"
                required
            >
        </div>

        <div class="extra-form-field">
            <label for="order">Display order *</label>

            <input
                id="order"
                type="number"
                name="order"
                value="{{ old('order', $extra?->order ?? 1) }}"
                min="0"
                required
            >
        </div>

    </div>

    <div class="extra-form-status">

        <label class="size-checkbox">
            <input
                type="checkbox"
                name="is_active"
                value="1"
                @checked(old(
                    'is_active',
                    $extra?->is_active ?? true
                ))
            >

            Active on the menu
        </label>

    </div>

    <div class="extra-form-actions">

        <a
            href="{{ route('admin.extras.index') }}"
            class="admin-secondary-button"
        >
            Cancel
        </a>

        <button type="submit" class="admin-primary-button">
            {{ $submitLabel }}
        </button>

    </div>

</form>