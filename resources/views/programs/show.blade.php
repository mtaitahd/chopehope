<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#137fbd">
    <meta name="description" content="{{ $program['lead'] }}">
    <title>{{ $program['name'] }} for Children with Cancer | CHF Tanzania</title>
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
    @php($pageHero = \App\Support\PageHeroContent::get('program-'.$slug))

    <main id="main-content" class="program-page">
        <section class="program-hero" aria-labelledby="program-hero-title">
            <img class="program-hero__image" src="{{ \App\Support\PageHeroContent::imageUrl($pageHero['image_path']) }}" alt="{{ $program['image_alt'] }}" fetchpriority="high">
            <div class="program-hero__veil" aria-hidden="true"></div>
            <div class="container program-hero__inner">
                <div class="program-hero__copy">

                    <h1 id="program-hero-title">{{ $pageHero['title'] }} <em>{{ $pageHero['highlight'] }}</em></h1>
                    <p class="hero__lead">{{ $pageHero['intro'] }}</p>
                    <div class="program-hero__actions"><a class="button button--yellow" href="#program-details">Discover this program <span aria-hidden="true">↓</span></a><a class="button button--outline-light" href="{{ route('programs.index') }}">All programs</a></div>
                </div>
                <div class="program-hero__note"><span aria-hidden="true">♡</span><strong>Children and caregivers</strong><small>Support through treatment</small></div>
            </div>
            <div class="hero__bottom-accent" aria-hidden="true"><span></span><span></span><span></span></div>
        </section>

        <section class="program-detail" id="program-details" aria-labelledby="program-intro-title">
            <div class="container">
                <div class="program-detail__intro"><p class="eyebrow"><span></span> {{ $program['name'] }}</p><h2 id="program-intro-title">{{ $program['intro_title'] }}</h2><p>{{ $program['intro'] }}</p></div>
                <div class="program-point-grid">
                    @foreach($program['points'] as $index => $point)
                        <article class="program-point program-point--{{ $index + 1 }}"><span class="program-point__number">0{{ $index + 1 }}</span><h3>{{ $point['title'] }}</h3><p>{{ $point['text'] }}</p></article>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="program-feature">
            <div class="container program-feature__inner">
                <div class="program-feature__visual"><img src="{{ asset($program['image2']) }}" alt="{{ $program['image2_alt'] }}" loading="lazy"><span class="program-feature__badge"><b>CHF</b><small>Care for the whole family</small></span></div>
                <div class="program-feature__copy"><p class="eyebrow"><span></span> Support that stays close</p><h2>{{ $program['feature_title'] }}</h2><p>{{ $program['feature_text'] }}</p><a class="button button--blue" href="{{ route('home') }}#contact">{{ $program['cta'] }} <span aria-hidden="true">→</span></a></div>
            </div>
        </section>

        <section class="related-programs" aria-labelledby="related-programs-title">
            <div class="container"><div class="related-programs__heading"><div><p class="eyebrow"><span></span> More from CHF</p><h2 id="related-programs-title">Support works together.</h2></div><a href="{{ route('programs.index') }}">View all programs <span aria-hidden="true">→</span></a></div>
                <div class="related-programs__grid">
                    @foreach($programs as $relatedSlug => $related)
                        @if($relatedSlug !== $slug)
                            <a class="related-program" href="{{ route('programs.show', ['slug' => $relatedSlug]) }}"><span>{{ $related['name'] }}</span><b aria-hidden="true">↗</b></a>
                        @endif
                    @endforeach
                </div>
            </div>
        </section>
    </main>

    @include('partials.site-footer')
    <script src="{{ asset('js/site.js') }}" defer></script>
</body>
</html>
