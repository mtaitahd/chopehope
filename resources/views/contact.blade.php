<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#137fbd">
    <meta name="description" content="Contact Children's Hope Foundation in Moshi, Tanzania, for family support, partnerships, donations and directions to our office near KCMC.">
    <title>{{ $hero['label'] }} | Children's Hope Foundation</title>
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

    <main id="main-content" class="contact-page">
        <section class="program-hero contact-hero" aria-labelledby="contact-hero-title">
            <img class="program-hero__image" src="{{ \App\Support\PageHeroContent::imageUrl($hero['image_path']) }}" alt="" fetchpriority="high">
            <div class="program-hero__veil" aria-hidden="true"></div>
            <div class="container program-hero__inner">
                <div class="program-hero__copy">
                    <p class="eyebrow eyebrow--light"><span></span>{{ $hero['eyebrow'] }}</p>
                    <h1 id="contact-hero-title">{{ $hero['title'] }} <em>{{ $hero['highlight'] }}</em></h1>
                    <p class="hero__lead">{{ $hero['intro'] }}</p>
                    <div class="program-hero__actions"><a class="button button--yellow" href="#contact-details">Get in touch <span aria-hidden="true">↓</span></a><a class="button button--outline-light" href="#donate">Make a donation</a></div>
                </div>
                <div class="program-hero__note"><span aria-hidden="true">♡</span><strong>Here for children and families</strong><small>Moshi, Tanzania · Near KCMC</small></div>
            </div>
            <div class="hero__bottom-accent" aria-hidden="true"><span></span><span></span><span></span></div>
        </section>

        <section class="contact-details" id="contact-details" aria-labelledby="contact-details-title">
            <div class="container">
                <div class="contact-section-heading"><p class="eyebrow"><span></span> Contact CHF</p><h2 id="contact-details-title">We would be glad to hear from you.</h2><p>Our team is based in Moshi, close to KCMC Zonal Referral Hospital.</p></div>
                <div class="contact-card-grid">
                    <a class="contact-info-card contact-info-card--phone" href="tel:+255795469469"><span class="contact-info-card__icon" aria-hidden="true">☎</span><span class="contact-info-card__label">Call our team</span><strong>+255 795 469 469</strong><span class="contact-info-card__action">Call CHF <b aria-hidden="true">↗</b></span></a>
                    <a class="contact-info-card contact-info-card--email" href="mailto:homeofchildrens26@gmail.com"><span class="contact-info-card__icon" aria-hidden="true">✉</span><span class="contact-info-card__label">Send us an email</span><strong>homeofchildrens26@gmail.com</strong><span class="contact-info-card__action">Email CHF <b aria-hidden="true">↗</b></span></a>
                    <a class="contact-info-card contact-info-card--place" href="#find-us"><span class="contact-info-card__icon" aria-hidden="true">⌖</span><span class="contact-info-card__label">Visit our office</span><strong>Moshi, Kilimanjaro</strong><span class="contact-info-card__detail">Near KCMC Zonal Referral Hospital</span><span class="contact-info-card__action">View the map <b aria-hidden="true">↓</b></span></a>
                </div>
            </div>
        </section>

        <section class="contact-donation" id="donate" aria-labelledby="contact-donation-title">
            <div class="container contact-donation__inner">
                <div class="contact-donation__copy"><p class="eyebrow eyebrow--light"><span></span> Give hope</p><h2 id="contact-donation-title">Your support helps families stay close to care.</h2><p>To support CHF by bank transfer, use the account details below. Please contact us if you need donation assistance.</p><a class="button button--yellow" href="mailto:homeofchildrens26@gmail.com?subject=CHF%20Donation">Ask about donating <span aria-hidden="true">→</span></a></div>
                <div class="donation-account" aria-label="CHF donation account details"><span class="donation-account__label">Donation account</span><span class="donation-account__number">3391749733</span><span class="donation-account__rule"></span><span class="donation-account__label">Account name</span><strong>CHILDREN’S HOPE FOUNDATION</strong><button class="button button--blue donation-mobile-trigger" type="button" data-donation-open>Donate via mobile money <span aria-hidden="true">→</span></button><small class="donation-mobile-hint">Pay securely from your mobile money line. Your PIN stays private on your phone.</small></div>
            </div>
        </section>

        <section class="contact-location" id="find-us" aria-labelledby="contact-location-title">
            <div class="container contact-location__layout">
                <div class="contact-location__copy"><p class="eyebrow"><span></span> Find us in Moshi</p><h2 id="contact-location-title">Close to KCMC. Here for families.</h2><p>Children's Hope Foundation is based near KCMC Zonal Referral Hospital in Moshi, Kilimanjaro, Tanzania.</p><p class="contact-location__note">The map points to KCMC and the surrounding area. Contact us for directions to the CHF office.</p><a class="button button--blue" href="https://www.google.com/maps/search/?api=1&query=KCMC+Zonal+Referral+Hospital%2C+Moshi%2C+Tanzania" target="_blank" rel="noopener">Open directions <span aria-hidden="true">↗</span></a></div>
                <div class="contact-map"><iframe title="Map showing KCMC Zonal Referral Hospital in Moshi, near the CHF office" src="https://www.google.com/maps?q=KCMC+Zonal+Referral+Hospital,+Moshi,+Tanzania&output=embed" loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe></div>
            </div>
        </section>
    </main>

    @include('partials.site-footer')
    @include('partials.donation-dialog')
    <script src="{{ asset('js/site.js') }}" defer></script>
    <script src="{{ asset('js/donation.js') }}?v={{ filemtime(public_path('js/donation.js')) }}" defer></script>
</body>
</html>
