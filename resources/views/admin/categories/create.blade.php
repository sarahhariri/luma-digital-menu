<x-admin.admin-layout
    title="Add Category"
    page-title="Add Category"
>

    <div class="admin-page-toolbar">

        <div>
            <h2>Create a new category</h2>

            <p>
                Add a new section to the LUMA menu.
            </p>
        </div>

    </div>

    <x-admin.category-form
        :action="route('admin.categories.store')"
        submit-label="Create category"
    />

</x-admin.admin-layout>
