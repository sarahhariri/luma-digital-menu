<x-layout title="LUMA">

    <main class="menu-page" id="top">

        <div class="container py-4">

            <header class="luma-top">
                <div class="brand">
                    <h1>LUMA</h1>
                    <p>coffee <span>•</span> bites <span>•</span> moments</p>
                </div>

                <button class="menu-icon" id="menuToggle" type="button" aria-label="Open navigation menu"
                    aria-expanded="false" aria-controls="mainNavigation">
                    ☰
                </button>

                <div class="navigation-overlay" id="navigationOverlay"></div>

                <nav class="luma-navigation" id="mainNavigation" aria-hidden="true">
                    <div class="navigation-header">
                        <div class="navigation-brand">
                            <strong>LUMA</strong>
                            <span>COFFEE • BITES • MOMENTS</span>
                        </div>

                        <button type="button" class="navigation-close" id="navigationClose"
                            aria-label="Close navigation menu">
                            ×
                        </button>
                    </div>

                    <p class="navigation-label">DISCOVER LUMA</p>

                    <div class="navigation-links">
                        <a href="#top">
                            <span class="navigation-number">01</span>

                            <span>
                                <strong>Home</strong>
                                <small>Back to the beginning</small>
                            </span>
                        </a>

                        <a href="#todays-picks">
                            <span class="navigation-number">02</span>

                            <span>
                                <strong>Today’s Picks</strong>
                                <small>Our featured selections</small>
                            </span>
                        </a>

                        <a href="#explore-menu">
                            <span class="navigation-number">03</span>

                            <span>
                                <strong>Explore Menu</strong>
                                <small>Discover every flavor</small>
                            </span>
                        </a>
                    </div>

                    <div class="navigation-footer">
                        <span>Made for your mood.</span>
                        <span>✦</span>
                    </div>
                </nav>
            </header>

            <section class="welcome-area">
                <div class="welcome-content">
                    <p class="welcome-small" id="welcomeGreeting">GOOD MORNING ☀️</p>

                    <h2>
                        What are you<br>
                        craving today?
                    </h2>

                    <div class="menu-search">
                        <span>⌕</span>

                        <input id="menuSearch" type="text" placeholder="Search coffee, matcha, bites...">
                    </div>


                    <div class="menu-categories">

                        @foreach ($categories as $category)
                            <button type="button" class="category-item {{ $loop->first ? 'active' : '' }}"
                                data-target="category-{{ $category->slug }}">

                                <i class="bi {{ $category->icon ?: 'bi-tag' }}"></i>

                                {{ $category->name }}

                            </button>
                        @endforeach

                    </div>
                </div>

                <div class="welcome-visual" aria-hidden="true">

                    <div class="visual-circle"></div>

                    <div class="coffee-steam">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <div class="hero-symbols">
                        <span class="hero-symbol symbol-one">✦</span>
                        <span class="hero-symbol symbol-two">+</span>
                        <span class="hero-symbol symbol-three">•</span>
                        <span class="hero-symbol symbol-four">◇</span>
                    </div>
                    <img src="{{ asset('assets/images/luma-cup2.png') }}" alt="LUMA coffee cup" class="hero-cup-image">
                </div>
            </section>

            <section class="todays-picks" id="todays-picks">

                <div class="section-heading">
                    <div>
                        <p>TODAY'S PICKS</p>
                        <h2>Made for your mood.</h2>
                    </div>

                    <a href="#explore-menu" class="see-all">
                        See all →
                    </a>
                </div>

                <div class="row g-4">

                    @forelse ($featuredProducts as $product)
                        <div class="col-md-4">
                            <div class="pick-card product-trigger" role="button" tabindex="0"
                                aria-label="View {{ $product->name }}" data-name="{{ $product->name }}"
                                data-description="{{ $product->description }}"
                                data-price="{{ number_format((float) $product->price, 2) }}"
                                data-image="{{ $product->image ? asset($product->image) : '' }}"
                                data-sizes="{{ $product->sizes->toJson() }}"
                                data-extras="{{ $product->extras->toJson() }}">

                                <div class="pick-image">

                                    @if ($product->image)
                                        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                                    @else
                                        <div class="pick-image-placeholder">
                                            <i class="bi bi-cup-hot"></i>
                                        </div>
                                    @endif

                                </div>

                                <div class="pick-info">

                                    <div>
                                        <h3>{{ $product->name }}</h3>

                                        <p>
                                            {{ \Illuminate\Support\Str::limit($product->description, 60) }}
                                        </p>
                                    </div>

                                    <span class="price">
                                        ${{ number_format((float) $product->price, 2) }}
                                    </span>

                                </div>

                            </div>
                        </div>

                    @empty

                        <div class="col-12">
                            <p class="featured-empty">
                                No featured products available yet.
                            </p>
                        </div>
                    @endforelse

                </div>

            </section>
            <section class="explore-menu" id="explore-menu">

                <div class="menu-section-heading">
                    <p>EXPLORE THE MENU</p>
                    <h2>Find your favorite.</h2>
                </div>
                <div class="menu-no-results" id="menuNoResults" hidden>
                    <i class="bi bi-emoji-frown"></i>
                    <p>No products found matching your search.</p>
                </div>

                @foreach ($categories as $categoryIndex => $category)
                    <div class="menu-category" id="category-{{ $category->slug }}">

                        <div class="menu-category-title">

                            <div>
                                <span>{{ str_pad($categoryIndex + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                <h3>{{ $category['name'] }}</h3>
                            </div>

                            <p>{{ $category['subtitle'] }}</p>

                        </div>


                        <div class="menu-list">

                            @foreach ($category->products as $productIndex => $product)
                                <div class="menu-product">

                                    <div class="product-number">
                                        {{ str_pad($productIndex + 1, 2, '0', STR_PAD_LEFT) }}
                                    </div>
                                    <div class="menu-product-image">
                                        @if ($product->image)
                                            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}"
                                                loading="lazy">
                                        @else
                                            <div class="menu-product-image-placeholder">
                                                <i class="bi bi-cup-hot"></i>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="product-details">
                                        <h4>{{ $product->name }}</h4>
                                        <p>{{ $product->description }}</p>
                                    </div>

                                    <span class="product-price">
                                        ${{ number_format((float) $product->price, 2) }}
                                    </span>

                                    <button type="button" class="product-more product-trigger"
                                        data-name="{{ $product->name }}"
                                        data-description="{{ $product->description }}"
                                        data-price="{{ number_format((float) $product->price, 2) }}"
                                        data-image="{{ $product->image ? asset($product->image) : '' }}"
                                        data-sizes="{{ $product->sizes->toJson() }}"
                                        data-extras="{{ $product->extras->toJson() }}">
                                        +
                                    </button>

                                </div>
                            @endforeach

                        </div>

                    </div>
                @endforeach

            </section>

            <div class="drawer-overlay" id="drawerOverlay"></div>

            <aside class="product-drawer" id="productDrawer">

                <button class="drawer-close" id="drawerClose">
                    ×
                </button>

                <div class="drawer-content">

                    <p class="drawer-label">LUMA SELECTION</p>

                    <h2 id="drawerProductName"></h2>

                    <p class="drawer-description" id="drawerProductDescription"></p>
                    <div class="drawer-product-image" id="drawerProductImageContainer" hidden>
                        <img src="" alt="" id="drawerProductImage">
                    </div>

                    <div class="drawer-option" id="drawerSizesSection">
                        <h3>Choose your size</h3>

                        <div id="drawerSizes"></div>
                    </div>

                    <div class="drawer-option" id="drawerExtrasSection">
                        <h3>Make it yours</h3>

                        <div id="drawerExtras"></div>
                    </div>

                </div>

                <div class="drawer-bottom">
                    <span>Total</span>
                    <strong id="drawerProductPrice"></strong>
                </div>

            </aside>


        </div>

    </main>
    <script>
        const welcomeGreeting =
            document.getElementById('welcomeGreeting');

        const currentHour = new Date().getHours();

        if (currentHour < 12) {
            welcomeGreeting.textContent = 'GOOD MORNING ☀️';
        } else if (currentHour < 18) {
            welcomeGreeting.textContent = 'GOOD AFTERNOON ✦';
        } else {
            welcomeGreeting.textContent = 'GOOD EVENING 🌙';
        }


        const drawer = document.getElementById('productDrawer');
        const overlay = document.getElementById('drawerOverlay');
        const closeButton = document.getElementById('drawerClose');
        const productTriggers = document.querySelectorAll('.product-trigger');
        const drawerProductImageContainer = document.getElementById( 'drawerProductImageContainer' );
        const drawerProductImage = document.getElementById(  'drawerProductImage' );
        const drawerContent = document.querySelector('.drawer-content');

        const drawerName =
            document.getElementById('drawerProductName');

        const drawerDescription =
            document.getElementById('drawerProductDescription');

        const drawerPrice =
            document.getElementById('drawerProductPrice');

        const drawerSizesSection =
            document.getElementById('drawerSizesSection');

        const drawerSizes =
            document.getElementById('drawerSizes');

        const drawerExtrasSection =
            document.getElementById('drawerExtrasSection');

        const drawerExtras =
            document.getElementById('drawerExtras');

        let selectedSizePrice = 0;
        let selectedExtrasPrice = 0;

        function updateTotal() {
            const total =
                selectedSizePrice + selectedExtrasPrice;

            drawerPrice.textContent = `$${total.toFixed(2)}`;
        }

        function renderSizes(sizes, basePrice) {
            drawerSizes.replaceChildren();
            selectedSizePrice = Number(basePrice);

            if (sizes.length === 0) {
                drawerSizesSection.hidden = true;
                updateTotal();
                return;
            }

            drawerSizesSection.hidden = false;

            const defaultSize =
                sizes.find(size => size.is_default) || sizes[0];

            selectedSizePrice = Number(defaultSize.price);

            sizes.forEach(size => {
                const label = document.createElement('label');
                label.className = 'size-option';

                const leftSide = document.createElement('div');

                const input = document.createElement('input');
                input.type = 'radio';
                input.name = 'drawer-size';
                input.value = size.id;
                input.checked = size.id === defaultSize.id;

                const name = document.createElement('span');
                name.textContent = size.name;

                const price = document.createElement('span');
                price.textContent =
                    `$${Number(size.price).toFixed(2)}`;

                input.addEventListener('change', () => {
                    selectedSizePrice = Number(size.price);
                    updateTotal();
                });

                leftSide.append(input, name);
                label.append(leftSide, price);
                drawerSizes.append(label);
            });

            updateTotal();
        }

        function renderExtras(extras) {
            drawerExtras.replaceChildren();
            selectedExtrasPrice = 0;

            if (extras.length === 0) {
                drawerExtrasSection.hidden = true;
                updateTotal();
                return;
            }

            drawerExtrasSection.hidden = false;

            extras.forEach(extra => {
                const label = document.createElement('label');
                label.className = 'size-option';

                const leftSide = document.createElement('div');

                const input = document.createElement('input');
                input.type = 'checkbox';
                input.value = extra.id;
                input.dataset.price = extra.price;

                const name = document.createElement('span');
                name.textContent = extra.name;

                const price = document.createElement('span');
                price.textContent =
                    `+$${Number(extra.price).toFixed(2)}`;

                input.addEventListener('change', () => {
                    const checkedExtras =
                        drawerExtras.querySelectorAll(
                            'input:checked'
                        );

                    selectedExtrasPrice =
                        Array.from(checkedExtras).reduce(
                            (total, checkbox) =>
                            total +
                            Number(checkbox.dataset.price),
                            0
                        );

                    updateTotal();
                });

                leftSide.append(input, name);
                label.append(leftSide, price);
                drawerExtras.append(label);
            });

            updateTotal();
        }

        function openProductDrawer(trigger) {
            document.body.classList.add('drawer-open');
            const sizes = JSON.parse(
                trigger.dataset.sizes || '[]'
            );

            const extras = JSON.parse(
                trigger.dataset.extras || '[]'
            );

            drawerName.textContent =
                trigger.dataset.name;

            drawerDescription.textContent =
                trigger.dataset.description ||
                'No description available.';
             const imageUrl = trigger.dataset.image;

if (imageUrl) {
    drawerProductImage.src = imageUrl;
    drawerProductImage.alt = trigger.dataset.name;
    drawerProductImageContainer.hidden = false;
} else {
    drawerProductImage.src = '';
    drawerProductImage.alt = '';
    drawerProductImageContainer.hidden = true;
}
            renderSizes(
                sizes,
                trigger.dataset.price
            );

            renderExtras(extras);

            drawer.classList.add('open');
            overlay.classList.add('open');
            requestAnimationFrame(() => {
                drawerContent.scrollTop = 0;
            });
        }

        productTriggers.forEach(trigger => {
            trigger.addEventListener('click', () => {
                openProductDrawer(trigger);
            });

            if (trigger.tagName !== 'BUTTON') {
                trigger.addEventListener('keydown', event => {
                    if (
                        event.key === 'Enter' ||
                        event.key === ' '
                    ) {
                        event.preventDefault();
                        openProductDrawer(trigger);
                    }
                });
            }
        });

        function closeDrawer() {
            document.body.classList.remove('drawer-open');
            drawer.classList.remove('open');
            overlay.classList.remove('open');
        }

        closeButton.addEventListener('click', closeDrawer);
        overlay.addEventListener('click', closeDrawer);

        const categoryButtons =
            document.querySelectorAll('.category-item');

        categoryButtons.forEach(button => {
            button.addEventListener('click', () => {
                const target = document.getElementById(
                    button.dataset.target
                );

                if (!target) {
                    return;
                }

                categoryButtons.forEach(item => {
                    item.classList.remove('active');
                });

                button.classList.add('active');

                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            });
        });

        const menuSearch =
            document.getElementById('menuSearch');

        const menuNoResults =
            document.getElementById('menuNoResults');

        const menuSections =
            document.querySelectorAll(
                '.explore-menu .menu-category'
            );

        const todaysPicks =
            document.querySelector('.todays-picks');

        menuSearch.addEventListener('input', () => {
            const searchValue =
                menuSearch.value.trim().toLowerCase();

            todaysPicks.hidden = searchValue !== '';

            let totalMatches = 0;

            menuSections.forEach(section => {
                const categoryName =
                    section.querySelector('h3')
                    .textContent
                    .toLowerCase();

                const products =
                    section.querySelectorAll('.menu-product');

                let sectionMatches = 0;

                products.forEach(product => {
                    const searchableText =
                        `${categoryName} ${product.textContent}`
                        .toLowerCase();

                    const matches =
                        searchableText.includes(searchValue);

                    product.hidden = !matches;

                    if (matches) {
                        sectionMatches++;
                        totalMatches++;
                    }
                });

                section.hidden = sectionMatches === 0;
            });

            menuNoResults.hidden = totalMatches !== 0;
        });

        const menuToggle =
            document.getElementById('menuToggle');

        const mainNavigation =
            document.getElementById('mainNavigation');

        const navigationOverlay =
            document.getElementById('navigationOverlay');

        const navigationClose =
            document.getElementById('navigationClose');

        function openNavigation() {
            mainNavigation.classList.add('open');
            navigationOverlay.classList.add('open');
            document.body.classList.add('navigation-open');

            mainNavigation.setAttribute('aria-hidden', 'false');
            menuToggle.setAttribute('aria-expanded', 'true');
        }

        function closeNavigation() {
            mainNavigation.classList.remove('open');
            navigationOverlay.classList.remove('open');
            document.body.classList.remove('navigation-open');

            mainNavigation.setAttribute('aria-hidden', 'true');
            menuToggle.setAttribute('aria-expanded', 'false');
        }

        menuToggle.addEventListener('click', () => {
            const isOpen =
                mainNavigation.classList.contains('open');

            if (isOpen) {
                closeNavigation();
            } else {
                openNavigation();
            }
        });

        navigationClose.addEventListener(
            'click',
            closeNavigation
        );

        navigationOverlay.addEventListener(
            'click',
            closeNavigation
        );

        mainNavigation.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', closeNavigation);
        });

        document.addEventListener('keydown', event => {
            if (
                event.key === 'Escape' &&
                mainNavigation.classList.contains('open')
            ) {
                closeNavigation();
            }
        });
    </script>
    <x-footer :cafe-Setting="$cafeSetting" />
</x-layout>
