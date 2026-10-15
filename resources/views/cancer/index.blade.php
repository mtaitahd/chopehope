<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#137fbd">
    <meta name="description" content="Childhood cancer information and family support from Children's Hope Foundation in Moshi, Tanzania.">
    <title>Childhood Cancer Information | Children's Hope Foundation</title>
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
        <div class="brand-actions" aria-label="Quick links"><a class="button button--orange button--small" href="{{ route('home') }}#donate">Donate</a><a class="button button--yellow button--small" href="{{ route('home') }}#get-involved">Get involved</a><a class="button button--blue button--small" href="{{ route('home') }}#contact">Contact CHF</a></div>
    </div></header>
    @include('partials.main-nav')
    @php($pageHero = \App\Support\PageHeroContent::get('cancer'))
    <main id="main-content" class="program-page cancer-topic-page">
        <section class="program-hero cancer-topic-hero" aria-labelledby="cancer-hero-title">
            <img class="program-hero__image" src="{{ \App\Support\PageHeroContent::imageUrl($pageHero['image_path']) }}" alt="A healthcare worker supporting a child" fetchpriority="high">
            <div class="program-hero__veil" aria-hidden="true"></div>
            <div class="container program-hero__inner"><div class="program-hero__copy">
                <p class="eyebrow eyebrow--light"><span></span> {{ $pageHero['eyebrow'] }}</p>
                <h1 id="cancer-hero-title">{{ $pageHero['title'] }} <em>{{ $pageHero['highlight'] }}</em></h1>
                <p class="hero__lead">{{ $pageHero['intro'] }}</p>
                <a class="button button--yellow" href="#cancer-topics">Explore topics <span aria-hidden="true">↓</span></a>
            </div><div class="program-hero__note"><span aria-hidden="true">♡</span><strong>Care for the whole family</strong><small>Children's Hope Foundation</small></div></div>
            <div class="hero__bottom-accent" aria-hidden="true"><span></span><span></span><span></span></div>
        </section>
        <section class="program-overview" id="cancer-topics" aria-labelledby="cancer-topics-title"><div class="container">
            <div class="program-section-heading"><p class="eyebrow"><span></span> Childhood cancer topics</p><h2 id="cancer-topics-title">Information for every step.</h2><p>Choose a topic to learn more. For individual medical questions, please speak with a qualified healthcare professional.</p></div>
            <div class="program-card-grid">
                @foreach($topics as $slug => $topic)
                    <a class="program-card" href="{{ route('cancer.show', ['slug' => $slug]) }}">
                        <div class="program-card__image-wrap"><img src="{{ asset($topic['image']) }}" alt="{{ $topic['image_alt'] }}" loading="lazy"><span class="program-card__number">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span></div>
                        <div class="program-card__body"><p class="eyebrow"><span></span> {{ $topic['eyebrow'] }}</p><h3>{{ $topic['name'] }}</h3><p>{{ $topic['lead'] }}</p><span class="program-card__link">Read this topic <b aria-hidden="true">→</b></span></div>
                    </a>
                @endforeach
            </div>
        </div></section>
        <section class="program-cta"><div class="container program-cta__inner"><div><p class="eyebrow eyebrow--light"><span></span> Family support in Moshi</p><h2>Questions about CHF support?</h2><p>Contact us to learn about practical and psychosocial support for families near KCMC.</p></div><a class="button button--yellow" href="{{ route('home') }}#contact">Contact CHF <span aria-hidden="true">→</span></a></div></section>
    </main>
    @include('partials.site-footer')
    <script src="{{ asset('js/site.js') }}" defer></script>
</body>
</html>
