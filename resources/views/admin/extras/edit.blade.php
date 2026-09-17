<x-admin.admin-layout
    title="Edit Extra"
    page-title="Edit Extra"
>

    <div class="admin-page-intro">
        <div>
            <span class="admin-page-eyebrow">
                MENU CUSTOMIZATIONS
            </span>

            <h2>Edit {{ $extra->name }}</h2>

            <p>
                Update the price, order or availability
                of this extra.
            </p>
        </div>
    </div>

    <x-admin.extra-form
        :extra="$extra"
        :action="route('admin.extras.update', $extra)"
        method="PUT"
        submit-label="Save changes"
    />

</x-admin.admin-layout>