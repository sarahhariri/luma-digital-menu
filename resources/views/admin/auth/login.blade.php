<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>LUMA | Admin Login</title>

    <link
        rel="stylesheet"
        href="{{ asset('assets/css/admin.css') }}"
    >
</head>

<body class="admin-auth-body">

    <main class="admin-auth">

        <section class="admin-auth__brand">

            <div class="admin-logo">
                <span class="admin-logo__name">LUMA</span>

                <span class="admin-logo__tagline">
                    Coffee · Bites · Moments
                </span>
            </div>

            <div class="admin-auth__message">
                <span>Admin space</span>

                <h1>
                    Your menu,<br>
                    beautifully managed.
                </h1>

                <p>
                    Manage categories, products, prices and availability
                    from one simple space.
                </p>
            </div>

            <div class="admin-auth__footer">
                A brighter day tastes better here.
            </div>

        </section>

        <section class="admin-auth__panel">

            <div class="admin-login-card">

                <span class="admin-login-card__eyebrow">
                    Welcome back
                </span>

                <h2>Sign in</h2>

                <p class="admin-login-card__subtitle">
                    Enter your details to access the LUMA dashboard.
                </p>

                <form
                    action="{{ route('admin.login.submit') }}"
                    method="POST"
                >
                    @csrf

                    <div class="admin-field">
                        <label for="email">Email address</label>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="admin@luma.com"
                            required
                            autofocus
                        >

                        @error('email')
                            <span class="admin-field__error">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="admin-field">
                        <label for="password">Password</label>

                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Enter your password"
                            required
                        >

                        @error('password')
                            <span class="admin-field__error">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="admin-login-options">
                        <label class="admin-remember">
                            <input
                                type="checkbox"
                                name="remember"
                                value="1"
                            >

                            Remember me
                        </label>
                    </div>

                    <button
                        type="submit"
                        class="admin-login-button"
                    >
                        Sign in to dashboard
                    </button>

                </form>

                <a href="{{ url('/') }}" class="admin-back-link">
                    ← Back to LUMA menu
                </a>

            </div>

        </section>

    </main>

</body>
</html>