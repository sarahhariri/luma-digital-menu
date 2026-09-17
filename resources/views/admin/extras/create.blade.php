<x-admin.admin-layout
    title="Add Extra"
    page-title="Add Extra"
>

    <div class="admin-page-intro">
        <div>
            <span class="admin-page-eyebrow">
                MENU CUSTOMIZATIONS
            </span>

            <h2>Create a new extra</h2>

            <p>
                Add an optional customization that can be
                attached to products.
            </p>
        </div>
    </div>

    <x-admin.extra-form
        :action="route('admin.extras.store')"
        method="POST"
        submit-label="Create extra"
    />

</x-admin.admin-layout>