<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#137fbd">
    <meta name="description" content="Meet the team supporting children with cancer and their families at Children's Hope Foundation in Tanzania.">
    <title>Our Team | Children's Hope Foundation</title>
    <link rel="icon" type="image/png" href="{{ asset('images/chf-logo.png') }}?v=1">
    <link rel="apple-touch-icon" href="{{ asset('images/chf-logo.png') }}?v=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Nunito+Sans:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/site.css') }}?v={{ filemtime(public_path('css/site.css')) }}">
</head>
<body>
    <a class="skip-link" href="#main-content">Skip to main content</a>

    <header class="site-header">
        <div class="container brand-row">
            <a class="brand" href="{{ route('home') }}#home" aria-label="Children's Hope Foundation home">
                <img src="{{ asset('images/chf-logo.png') }}" alt="Children's Hope Foundation" width="500" height="500">
            </a>
            <div class="brand-message">
                <span class="brand-message__eyebrow">Children's Hope Foundation</span>
                <span class="brand-message__line">Hope, love and support for children with cancer.</span>
            </div>
            <div class="brand-actions" aria-label="Quick links">
                <a class="button button--orange button--small" href="{{ route('involved.show', ['slug' => 'donate']) }}">Donate</a>
                <a class="button button--yellow button--small" href="{{ route('involved.show', ['slug' => 'volunteer']) }}">Get involved</a>
                <a class="button button--blue button--small" href="{{ route('contact') }}">Contact CHF</a>
            </div>
        </div>
    </header>

    @include('partials.main-nav')



    @php($pageHero = \App\Support\PageHeroContent::get('team'))

    <main id="main-content">
        <section class="program-hero" aria-labelledby="team-title">
            <img class="program-hero__image" src="{{ \App\Support\PageHeroContent::imageUrl($pageHero['image_path']) }}" alt="CHF staff member at work in the office" fetchpriority="high">
            <div class="program-hero__veil" aria-hidden="true"></div>
            <div class="container program-hero__inner"><div class="program-hero__copy"><h1 id="team-title">{{ $pageHero['title'] }} <em>{{ $pageHero['highlight'] }}</em></h1><p class="program-hero__lead">{{ $pageHero['intro'] }}</p></div></div>
        </section>
        <section class="team-section" aria-labelledby="team-members-title"><div class="container">
            <div class="section-heading"><p class="eyebrow"><span></span> People who care</p><h2 id="team-members-title">Meet our team.</h2><p>Get to know the people supporting the work of Children's Hope Foundation.</p></div>
            <div class="team-grid">
            @forelse($members as $member)
                <article class="team-card">
                    @if($member->photo)<img class="team-card__photo" src="{{ Storage::disk('public')->url($member->photo) }}" alt="Portrait of {{ $member->name }}" loading="lazy">
                    @else<div class="team-card__placeholder" aria-hidden="true">{{ mb_substr($member->name, 0, 1) }}</div>@endif
                    <div class="team-card__body"><p class="eyebrow">{{ $member->role }}</p><h3>{{ $member->name }}</h3>@if($member->bio)<p class="team-card__bio">{{ $member->bio }}</p>@endif</div>
                </article>
            @empty
                <div class="team-empty"><h3>Connect with the CHF team</h3><p>For questions about our work, partnership opportunities or ways to support a family, please get in touch.</p><a class="button button--blue" href="{{ route('contact') }}">Contact our team</a></div>
            @endforelse
            </div>
        </div></section>
    </main>
    @include('partials.site-footer')
    <script src="{{ asset('js/site.js') }}" defer></script>
</body>
</html>
