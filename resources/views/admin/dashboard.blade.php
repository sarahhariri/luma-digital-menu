
<x-admin.admin-layout
    title="Dashboard"
    page-title="Dashboard"
>

    <div class="dashboard-welcome">

        <div>
            <span class="dashboard-welcome__eyebrow">
                Good to see you
            </span>

            <h2>
                Welcome back,
                {{ auth()->user()->name }}.
            </h2>

            <p>
                Manage the LUMA menu, products and customizations
                from one place.
            </p>
        </div>

        <div class="dashboard-welcome__mark">
            L
        </div>

    </div>

    <div class="dashboard-stats">

        <div class="dashboard-stat-card">
            <div class="dashboard-stat-card__icon">
                <i class="bi bi-tags"></i>
            </div>

            <div>
                <span>Categories</span>
                <strong>{{ $categoriesCount }}</strong>
            </div>
        </div>

        <div class="dashboard-stat-card">
            <div class="dashboard-stat-card__icon">
                <i class="bi bi-cup-hot"></i>
            </div>

            <div>
                <span>Products</span>
                <strong>{{ $productsCount }}</strong>
            </div>
        </div>

        <div class="dashboard-stat-card">
            <div class="dashboard-stat-card__icon">
                <i class="bi bi-arrows-angle-expand"></i>
            </div>

            <div>
                <span>Product sizes</span>
                <strong>{{ $sizesCount }}</strong>
            </div>
        </div>

        <div class="dashboard-stat-card">
            <div class="dashboard-stat-card__icon">
                <i class="bi bi-plus-circle"></i>
            </div>

            <div>
                <span>Extras</span>
                <strong>{{ $extrasCount }}</strong>
            </div>
        </div>

    </div>

</x-admin.admin-layout>