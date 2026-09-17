<x-admin.admin-layout
    title="Edit Category"
    page-title="Edit Category"
>

    <div class="admin-page-toolbar">

        <div>
            <h2>Edit category details</h2>

            <p>
                Update the category information and menu visibility.
            </p>
        </div>

    </div>

    <x-admin.category-form
        :category="$category"
        :action="route('admin.categories.update', $category)"
        method="PUT"
        submit-label="Save changes"
    />

</x-admin.admin-layout>