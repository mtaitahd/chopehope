<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#137fbd">
    <meta name="description" content="{{ $page['lead'] }}">
    <title>{{ $page['name'] }} | Children's Hope Foundation</title>
    <link rel="icon" type="image/png" href="{{ asset('images/chf-logo.png') }}?v=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Nunito+Sans:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/site.css') }}?v={{ filemtime(public_path('css/site.css')) }}">
</head>
<body>
    <a class="skip-link" href="#main-content">Skip to main content</a>
    <header class="site-header">
        <div class="container brand-row">
            <a class="brand" href="{{ route('home') }}#home" aria-label="Children's Hope Foundation home"><img src="{{ asset('images/chf-logo.png') }}" alt="Children's Hope Foundation" width="500" height="500"></a>
            <div class="brand-message"><span class="brand-message__eyebrow">Children's Hope Foundation</span><span class="brand-message__line">Hope, love and support for children with cancer.</span></div>
            <div class="brand-actions" aria-label="Quick links"><a class="button button--orange button--small" href="{{ route('involved.show', ['slug' => 'donate']) }}">Donate</a><a class="button button--yellow button--small" href="{{ route('involved.show', ['slug' => 'volunteer']) }}">Get involved</a><a class="button button--blue button--small" href="{{ route('contact') }}">Contact CHF</a></div>
        </div>
    </header>
    @include('partials.main-nav')

    <main id="main-content" class="info-page info-page--{{ $pageType }} info-page--{{ $page['theme'] }}">
        <section class="program-hero info-hero info-hero--{{ $page['theme'] }}" aria-labelledby="info-hero-title">
            <img class="program-hero__image" src="{{ \App\Support\PageHeroContent::imageUrl($hero['image_path']) }}" alt="{{ $page['image_alt'] }}" fetchpriority="high">
            <div class="program-hero__veil" aria-hidden="true"></div>
            <div class="container program-hero__inner">
                <div class="program-hero__copy">
                    <p class="eyebrow eyebrow--light"><span></span>{{ $hero['eyebrow'] }}</p>
                    <h1 id="info-hero-title">{{ $hero['title'] }} <em>{{ $hero['highlight'] }}</em></h1>
                    <p class="hero__lead">{{ $hero['intro'] }}</p>
                    <div class="program-hero__actions"><a class="button button--yellow" href="#page-details">Explore this page <span aria-hidden="true">↓</span></a><a class="button button--outline-light" href="{{ route('contact') }}">Talk with CHF</a></div>
                </div>
                <div class="program-hero__note"><span aria-hidden="true">{{ $pageType === 'service' ? '♡' : '✳' }}</span><strong>{{ $pageType === 'service' ? 'Practical care, close by' : 'Every act of care matters' }}</strong><small>Moshi, Tanzania · Near KCMC</small></div>
            </div>
            <div class="hero__bottom-accent" aria-hidden="true"><span></span><span></span><span></span></div>
        </section>

        <section class="info-details" id="page-details" aria-labelledby="info-details-title">
            <div class="container">
                <header class="info-details__heading"><p class="eyebrow"><span></span>{{ $page['name'] }}</p><h2 id="info-details-title">{{ $page['intro_title'] }}</h2><p>{{ $page['intro'] }}</p></header>
                <div class="info-card-grid">
                    @foreach($page['points'] as $index => $point)
                        <article class="info-card info-card--{{ $index + 1 }}"><span class="info-card__number">0{{ $index + 1 }}</span><h3>{{ $point['title'] }}</h3><p>{{ $point['text'] }}</p></article>
                    @endforeach
                </div>
                @if(isset($page['account']))
                    <aside class="info-donation-account" aria-label="CHF donation bank details">
                        <div><p class="eyebrow"><span></span> Bank transfer</p><h3>Support CHF’s work</h3><p>Use these details for a bank transfer. Please contact us if you need help with your donation.</p></div>
                        <div class="info-donation-account__details"><span>Account number</span><strong>{{ $page['account'] }}</strong><span>Account name</span><b>{{ $page['account_name'] }}</b>
                            @if(request()->route('slug') === 'donate')
                                <button class="button button--blue donation-mobile-trigger" type="button" data-donation-open>Donate via mobile money <span aria-hidden="true">→</span></button>
                                <small class="donation-mobile-hint">Pay securely from your mobile money line. Your PIN stays private on your phone.</small>
                            @endif
                        </div>
                    </aside>
                @endif
            </div>
        </section>

        <section class="info-feature info-feature--{{ $page['theme'] }}">
            <div class="container info-feature__inner">
                <div class="info-feature__visual"><img src="{{ asset($page['feature_image']) }}" alt="{{ $page['feature_alt'] }}" loading="lazy"><span class="info-feature__badge"><b>CHF</b><small>Hope, love and support</small></span></div>
                <div class="info-feature__copy"><p class="eyebrow"><span></span>{{ $pageType === 'service' ? 'Support around treatment' : 'Stand with families' }}</p><h2>{{ $page['feature_title'] }}</h2><p>{{ $page['feature_text'] }}</p><a class="button button--blue" href="{{ route('contact') }}">{{ $page['cta'] }} <span aria-hidden="true">→</span></a></div>
            </div>
        </section>

        <section class="info-related" aria-labelledby="info-related-title">
            <div class="container">
                <div class="info-related__heading"><div><p class="eyebrow"><span></span>{{ $pageType === 'service' ? 'Our services' : 'Get involved' }}</p><h2 id="info-related-title">{{ $pageType === 'service' ? 'Care that works together.' : 'Choose another way to help.' }}</h2></div><a href="{{ route('contact') }}">Contact CHF <span aria-hidden="true">→</span></a></div>
                <div class="info-related__grid">
                    @foreach($relatedPages as $relatedSlug => $relatedPage)
                        @if($relatedSlug !== request()->route('slug'))
                            <a class="info-related-card" href="{{ route($routeName, ['slug' => $relatedSlug]) }}"><span>{{ $relatedPage['name'] }}</span><b aria-hidden="true">↗</b><small>{{ $relatedPage['lead'] }}</small></a>
                        @endif
                    @endforeach
                </div>
            </div>
        </section>
    </main>

    @include('partials.site-footer')
    @if(request()->route('slug') === 'donate')
        <dialog class="donation-dialog" aria-labelledby="donation-dialog-title" data-donation-dialog data-status-url="{{ url('/donate/mobile-money/__DONATION_ID__') }}">
            <div class="donation-dialog__header"><div><p class="eyebrow"><span></span> Secure mobile payment</p><h2 id="donation-dialog-title">Donate with mobile money</h2></div><button class="donation-dialog__close" type="button" aria-label="Close" data-donation-close>&times;</button></div>
            <p class="donation-dialog__intro">Enter your details. Abliner will route the request to the mobile money network for your number.</p>
            <form data-donation-form action="{{ route('donate.mobile-money') }}" method="post">
                @csrf
                <label for="donor-name">Your name</label><input id="donor-name" name="name" type="text" autocomplete="name" minlength="2" maxlength="120" required>
                <label for="donor-amount">Donation amount (TZS)</label><input id="donor-amount" name="amount" type="number" min="500" max="3000000" step="1" inputmode="numeric" required><small>Minimum TZS 500. Maximum TZS 3,000,000.</small>
                <label for="donor-phone">Mobile money number</label><input id="donor-phone" name="phone" type="tel" autocomplete="tel" inputmode="tel" placeholder="07XX XXX XXX or +255 7XX XXX XXX" pattern="(\+?255[ -]?|0)?[67]([0-9][ -]?){8}" maxlength="24" required><small>Carrier routing is selected automatically. You approve the charge with your PIN on your phone.</small>
                <p class="donation-dialog__status" role="status" aria-live="polite" data-donation-status hidden></p>
                <button class="button button--blue donation-dialog__submit" type="submit" data-donation-submit>Continue to mobile money <span aria-hidden="true">→</span></button>
            </form>
        </dialog>
    @endif
    <script src="{{ asset('js/site.js') }}" defer></script>
    @if(request()->route('slug') === 'donate')<script src="{{ asset('js/donation.js') }}?v={{ filemtime(public_path('js/donation.js')) }}" defer></script>@endif
</body>
</html>
