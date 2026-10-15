<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#137fbd">
    <meta name="description" content="{{ $topic['lead'] }}">
    <title>{{ $topic['name'] }} | Childhood Cancer | Children's Hope Foundation</title>
    <link rel="icon" type="image/png" href="{{ asset('images/chf-logo.png') }}?v=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Nunito+Sans:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/site.css') }}?v={{ filemtime(public_path('css/site.css')) }}">
</head>
<body>
    <a class="skip-link" href="#main-content">Skip to main content</a>
    <header class="site-header"><div class="container brand-row">
        <a class="brand" href="{{ route('home') }}#home" aria-label="Children's Hope Foundation home"><img src="{{ asset('images/chf-logo.png') }}" alt="Children's Hope Foundation" width="500" height="500"></a>
        <div class="brand-message"><span class="brand-message__eyebrow">Children's Hope Foundation</span><span class="brand-message__line">Hope, love and support for children with cancer.</span></div>
        <div class="brand-actions" aria-label="Quick links"><a class="button button--orange button--small" href="{{ route('involved.show', ['slug' => 'donate']) }}">Donate</a><a class="button button--yellow button--small" href="{{ route('involved.show', ['slug' => 'volunteer']) }}">Get involved</a><a class="button button--blue button--small" href="{{ route('contact') }}">Contact CHF</a></div>
    </div></header>
    @include('partials.main-nav')
    @php($pageHero = \App\Support\PageHeroContent::get('cancer-'.$slug))
    <main id="main-content" class="program-page cancer-topic-page">
        <section class="program-hero cancer-topic-hero" aria-labelledby="cancer-hero-title">
            <img class="program-hero__image" src="{{ \App\Support\PageHeroContent::imageUrl($pageHero['image_path']) }}" alt="{{ $topic['image_alt'] }}" fetchpriority="high">
            <div class="program-hero__veil" aria-hidden="true"></div>
            <div class="container program-hero__inner"><div class="program-hero__copy">
                <p class="eyebrow eyebrow--light"><span></span> {{ $pageHero['eyebrow'] }}</p>
                <h1 id="cancer-hero-title">{{ $pageHero['title'] }} <em>{{ $pageHero['highlight'] }}</em></h1>
                <p class="hero__lead">{{ $pageHero['intro'] }}</p>
                <div class="program-hero__actions"><a class="button button--yellow" href="#topic-details">Read this topic <span aria-hidden="true">↓</span></a><a class="button button--outline-light" href="{{ route('cancer.index') }}">All topics</a></div>
            </div><div class="program-hero__note"><span aria-hidden="true">♡</span><strong>Children and caregivers</strong><small>Support through the journey</small></div></div>
            <div class="hero__bottom-accent" aria-hidden="true"><span></span><span></span><span></span></div>
        </section>
        <section class="program-detail" id="topic-details" aria-labelledby="topic-intro-title"><div class="container">
            <div class="program-detail__intro"><p class="eyebrow"><span></span> {{ $topic['name'] }}</p><h2 id="topic-intro-title">{{ $topic['intro_title'] }}</h2><p>{{ $topic['intro'] }}</p></div>
            <div class="program-point-grid">
                @foreach($topic['points'] as $index => $point)
                    <article class="program-point program-point--{{ $index + 1 }}"><span class="program-point__number">0{{ $index + 1 }}</span><h3>{{ $point['title'] }}</h3><p>{{ $point['text'] }}</p></article>
                @endforeach
            </div>
            <aside class="cancer-info-note"><span aria-hidden="true">i</span><p>This page offers general information and is not a medical diagnosis. For a child’s health, seek advice from a qualified healthcare professional.</p></aside>
        </div></section>
        <section class="program-feature cancer-topic-feature"><div class="container program-feature__inner">
            <div class="program-feature__visual"><img src="{{ asset($topic['image2']) }}" alt="{{ $topic['image2_alt'] }}" loading="lazy"><span class="program-feature__badge"><b>CHF</b><small>Hope, love and support</small></span></div>
            <div class="program-feature__copy"><p class="eyebrow"><span></span> Here for families</p><h2>{{ $topic['feature_title'] }}</h2><p>{{ $topic['feature_text'] }}</p><a class="button button--blue" href="{{ route('home') }}#contact">Contact CHF <span aria-hidden="true">→</span></a></div>
        </div></section>
        <section class="related-programs cancer-related" aria-labelledby="related-cancer-title"><div class="container">
            <div class="related-programs__heading"><div><p class="eyebrow"><span></span> Continue exploring</p><h2 id="related-cancer-title">More childhood cancer topics.</h2></div><a href="{{ route('cancer.index') }}">All topics <span aria-hidden="true">→</span></a></div>
            <div class="related-programs__grid">
                @foreach($topics as $relatedSlug => $related)
                    @if($relatedSlug !== $slug)
                        <a class="related-program" href="{{ route('cancer.show', ['slug' => $relatedSlug]) }}"><span>{{ $related['name'] }}</span><b aria-hidden="true">↗</b></a>
                    @endif
                @endforeach
            </div>
        </div></section>
    </main>
    @include('partials.site-footer')
    <script src="{{ asset('js/site.js') }}" defer></script>
</body>
</html>
