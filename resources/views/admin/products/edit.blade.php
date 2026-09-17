<x-admin.admin-layout
    title="Edit Product"
    page-title="Edit Product"
>

    <div class="admin-page-toolbar">

        <div>
            <h2>Edit product details</h2>

            <p>
                Update the product information, image and visibility.
            </p>
        </div>

    </div>

    <x-admin.product-form
        :product="$product"
        :categories="$categories"
        :action="route('admin.products.update', $product)"
        method="PUT"
        submit-label="Save changes"
    />
    <x-admin.product-size-manager
    :product="$product"
    
/>
<x-admin.product-extra-manager
    :product="$product"
    :extras="$extras"
/>

</x-admin.admin-layout>
