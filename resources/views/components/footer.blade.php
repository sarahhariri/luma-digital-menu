@props(['cafeSetting' => null])

<footer class="luma-footer">

    <span class="footer-watermark" aria-hidden="true">
        {{ $cafeSetting?->cafe_name ?? 'LUMA' }}
    </span>

    <div class="footer-shell">

        <div class="footer-intro">
            <span class="footer-eyebrow">MORE THAN A MENU</span>

            <h2>
                Your next favorite
                <em>moment starts here.</em>
            </h2>

            @if ($cafeSetting?->tagline)
                <p>{{ $cafeSetting->tagline }}</p>
            @endif

            <div class="footer-actions">

                @if ($cafeSetting?->maps_url)
                    <a
                        href="{{ $cafeSetting->maps_url }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="footer-btn footer-btn-light"
                    >
                        Get directions
                        <i class="bi bi-arrow-up-right"></i>
                    </a>
                @endif

                @if ($cafeSetting?->whatsapp)
                    <a
                        href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $cafeSetting->whatsapp) }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="footer-btn footer-btn-outline"
                    >
                        <i class="bi bi-whatsapp"></i>
                        Message us
                    </a>
                @endif

            </div>
        </div>

        <div class="footer-info-card">
            <span class="footer-card-label">COME SAY HELLO</span>

            @if ($cafeSetting?->address)
                <div class="footer-info-row">
                    <i class="bi bi-geo-alt"></i>

                    <div>
                        <small>Location</small>
                        <span>{{ $cafeSetting->address }}</span>
                    </div>
                </div>
            @endif

            @if ($cafeSetting?->opening_hours)
                <div class="footer-info-row">
                    <i class="bi bi-clock"></i>

                    <div>
                        <small>Opening hours</small>
                        <span>{{ $cafeSetting->opening_hours }}</span>
                    </div>
                </div>
            @endif

            @if ($cafeSetting?->phone)
                <div class="footer-info-row">
                    <i class="bi bi-telephone"></i>

                    <div>
                        <small>Call us</small>

                        <a href="tel:{{ preg_replace('/[^0-9+]/', '', $cafeSetting->phone) }}">
                            {{ $cafeSetting->phone }}
                        </a>
                    </div>
                </div>
            @endif

            @if ($cafeSetting?->instagram)
                <a
                    href="https://instagram.com/{{ ltrim($cafeSetting->instagram, '@') }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="footer-instagram"
                >
                    <i class="bi bi-instagram"></i>
                    {{ $cafeSetting->instagram }}
                    <i class="bi bi-arrow-up-right"></i>
                </a>
            @endif
        </div>

    </div>

    <div class="footer-bottom">
        <span>
            © {{ date('Y') }}
            {{ $cafeSetting?->cafe_name ?? 'LUMA' }}
        </span>

        <span>Designed for better coffee moments.</span>
    </div>

</footer>