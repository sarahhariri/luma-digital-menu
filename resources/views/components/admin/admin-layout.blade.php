@props([
    'title' => 'Dashboard',
    'pageTitle' => 'Dashboard',
])
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title }} | LUMA Admin</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
</head>

<body class="admin-body">

    <div class="admin-layout">

        <aside class="admin-sidebar">

            <a href="{{ route('admin.dashboard') }}" class="sidebar-logo">
                <span class="sidebar-logo__name">LUMA</span>

                <span class="sidebar-logo__tagline">
                    Coffee · Bites · Moments
                </span>
            </a>

            <nav class="admin-navigation">

                <span class="admin-navigation__title">
                    Workspace
                </span>

                <a href="{{ route('admin.dashboard') }}"
                    class="admin-navigation__link
                    {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>

                <a href="{{ url('/admin/categories') }}"
                    class="admin-navigation__link
                    {{ request()->is('admin/categories*') ? 'active' : '' }}">
                    <i class="bi bi-tags"></i>
                    <span>Categories</span>
                </a>

                <a href="{{ url('/admin/products') }}"
                    class="admin-navigation__link
                    {{ request()->is('admin/products*') ? 'active' : '' }}">
                    <i class="bi bi-cup-hot"></i>
                    <span>Products</span>
                </a>

                <a href="{{ url('/admin/extras') }}"
                    class="admin-navigation__link
                    {{ request()->is('admin/extras*') ? 'active' : '' }}">
                    <i class="bi bi-plus-circle"></i>
                    <span>Extras</span>
                </a>

                <a href="{{ route('admin.cafe-settings.edit') }}"
                    class="admin-navigation__link
        {{ request()->routeIs('admin.cafe-settings.*') ? 'active' : '' }}">
                    <i class="bi bi-shop"></i>
                    <span>Cafe Information</span>
                </a>

            </nav>

            <div class="admin-sidebar__bottom">

                <a href="{{ url('/') }}" class="admin-navigation__link">
                    <i class="bi bi-arrow-left"></i>
                    <span>View main menu</span>
                </a>

                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf

                    <button type="submit" class="admin-logout-button">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Logout</span>
                    </button>
                </form>

            </div>

        </aside>

        <main class="admin-main">

            <header class="admin-topbar">

                <div>
                    <span class="admin-topbar__eyebrow">
                        LUMA workspace
                    </span>

                    <h1>{{ $pageTitle }}</h1>
                </div>

                <a href="{{ url('/') }}" class="admin-view-menu">
                    View menu
                    <i class="bi bi-arrow-up-right"></i>
                </a>

            </header>

            <section class="admin-content">
                {{ $slot }}
            </section>

        </main>

    </div>

</body>

</html>
