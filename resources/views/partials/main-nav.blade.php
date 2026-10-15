<nav class="main-nav" aria-label="Main navigation">
    <div class="container main-nav__inner">
        <button class="nav-toggle" type="button" aria-expanded="false" aria-controls="main-menu">
            <span class="nav-toggle__icon" aria-hidden="true"><i></i><i></i><i></i></span>
            <span>Menu</span>
        </button>
        <div class="nav-links" id="main-menu">
            <a class="nav-link {{ request()->routeIs('home') ? 'is-active' : '' }}" href="{{ route('home') }}#home">Home</a>
            <details class="nav-dropdown">
                <summary class="nav-link {{ request()->routeIs('about') ? 'is-active' : '' }}" @if(request()->routeIs('about')) aria-current="page" @endif>About CHF <span class="nav-dropdown__chevron" aria-hidden="true">⌄</span></summary>
                <div class="nav-dropdown__menu">
                    <a class="nav-dropdown__link" href="{{ route('about') }}">About overview</a>
                    <a class="nav-dropdown__link" href="{{ route('about') }}#history">Foundation history</a>
                    <a class="nav-dropdown__link" href="{{ route('about') }}#mission-vision">Mission &amp; vision</a>
                    <a class="nav-dropdown__link" href="{{ route('about') }}#objectives">Our objectives</a>
                    <a class="nav-dropdown__link" href="{{ route('about') }}#support-services">Support services</a>
                    <a class="nav-dropdown__link" href="{{ route('about') }}#office">Office location</a>
                </div>
            </details>
            <a class="nav-link" href="{{ route('home') }}#services">Our services</a>
            <details class="nav-dropdown nav-dropdown--programs">
                <summary class="nav-link {{ request()->routeIs('programs.*') ? 'is-active' : '' }}" @if(request()->routeIs('programs.*')) aria-current="page" @endif>Programs <span class="nav-dropdown__chevron" aria-hidden="true">⌄</span></summary>
                <div class="nav-dropdown__menu">
                    <a class="nav-dropdown__link nav-dropdown__link--all" href="{{ route('programs.index') }}">All programs <span aria-hidden="true">→</span></a>
                    @foreach(config('programs') as $slug => $program)
                        <a class="nav-dropdown__link" href="{{ route('programs.show', ['slug' => $slug]) }}">{{ $program['name'] }}</a>
                    @endforeach
                </div>
            </details>
            <a class="nav-link" href="{{ route('home') }}#cancer-info">Childhood cancer</a>
            <a class="nav-link" href="{{ route('home') }}#stories">News &amp; stories</a>
            <a class="nav-link" href="{{ route('home') }}#get-involved">Get involved</a>
            <a class="nav-link" href="{{ route('home') }}#contact">Contact</a>
        </div>
    </div>
</nav>
