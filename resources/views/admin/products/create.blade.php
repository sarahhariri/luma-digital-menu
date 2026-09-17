<x-admin.admin-layout
    title="Add Product"
    page-title="Add Product"
>

    <div class="admin-page-toolbar">

        <div>
            <h2>Create a new product</h2>

            <p>
                Add a new drink, bakery item or dessert
                to the LUMA menu.
            </p>
        </div>

    </div>

    <x-admin.product-form
        :categories="$categories"
        :action="route('admin.products.store')"
        submit-label="Create product"
    />

</x-admin.admin-layout>