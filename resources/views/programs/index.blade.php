<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#137fbd">
    <meta name="description" content="Explore Children's Hope Foundation programmes for children with cancer and their families, including accommodation, meals, transport and psychosocial support in Moshi, Tanzania.">
    <title>Childhood Cancer Support Programmes in Tanzania | CHF</title>
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
    @php($pageHero = \App\Support\PageHeroContent::get('programs'))

    <main id="main-content" class="program-page">
        <section class="program-hero program-hero--index" aria-labelledby="program-hero-title">
            <img class="program-hero__image" src="{{ \App\Support\PageHeroContent::imageUrl($pageHero['image_path']) }}" alt="Children painting together at CHF" fetchpriority="high">
            <div class="program-hero__veil" aria-hidden="true"></div>
            <div class="container program-hero__inner">
                <div class="program-hero__copy">

                    <h1 id="program-hero-title">{{ $pageHero['title'] }} <em>{{ $pageHero['highlight'] }}</em></h1>
                    <p class="hero__lead">{{ $pageHero['intro'] }}</p>
                    <a class="button button--yellow" href="#program-list">Explore our programs <span aria-hidden="true">↓</span></a>
                </div>

            </div>
            <div class="hero__bottom-accent" aria-hidden="true"><span></span><span></span><span></span></div>
        </section>

        <section class="program-overview" id="program-list" aria-labelledby="program-list-title">
            <div class="container">
                <div class="program-section-heading">
                    <p class="eyebrow"><span></span> Our programs</p>
                    <h2 id="program-list-title">Practical support, made personal.</h2>
                    <p>Each program responds to a different part of the journey. Choose one to learn how CHF stands alongside children and caregivers.</p>
                </div>
                <div class="program-card-grid">
                    @foreach($programs as $slug => $program)
                        <a class="program-card" href="{{ route('programs.show', ['slug' => $slug]) }}">
                            <div class="program-card__image-wrap"><img src="{{ asset($program['image']) }}" alt="{{ $program['image_alt'] }}" loading="lazy"><span class="program-card__number">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span></div>
                            <div class="program-card__body"><p class="eyebrow"><span></span> {{ $program['eyebrow'] }}</p><h3>{{ $program['name'] }}</h3><p>{{ $program['lead'] }}</p><span class="program-card__link">Discover this program <b aria-hidden="true">→</b></span></div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="program-cta">
            <div class="container program-cta__inner"><div><p class="eyebrow eyebrow--light"><span></span> Here for families</p><h2>Questions about support?</h2><p>Talk with CHF about the support available to your family in Moshi.</p></div><a class="button button--yellow" href="{{ route('home') }}#contact">Contact CHF <span aria-hidden="true">→</span></a></div>
        </section>
    </main>

    @include('partials.site-footer')
    <script src="{{ asset('js/site.js') }}" defer></script>
</body>
</html>
