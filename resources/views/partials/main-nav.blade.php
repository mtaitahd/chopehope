<nav class="main-nav" aria-label="Main navigation">
    <div class="container main-nav__inner">
        <button class="nav-toggle" type="button" aria-expanded="false" aria-controls="main-menu">
            <span class="nav-toggle__icon" aria-hidden="true"><i></i><i></i><i></i></span>
            <span>Menu</span>
        </button>
        <div class="nav-links" id="main-menu">
            <a class="nav-link {{ request()->routeIs('home') ? 'is-active' : '' }}" href="{{ route('home') }}#home">Home</a>
            <details class="nav-dropdown" onmouseenter="this.open = true" onmouseleave="this.open = false">
                <summary class="nav-link {{ request()->routeIs('about') ? 'is-active' : '' }}" @if(request()->routeIs('about')) aria-current="page" @endif>About CHF</summary>
                <div class="nav-dropdown__menu">
                    <a class="nav-dropdown__link" href="{{ route('about') }}">About overview</a>
                    <a class="nav-dropdown__link" href="{{ route('about') }}#history">Foundation history</a>
                    <a class="nav-dropdown__link" href="{{ route('about') }}#mission-vision">Mission &amp; vision</a>
                    <a class="nav-dropdown__link" href="{{ route('about') }}#objectives">Our objectives</a>
                    <a class="nav-dropdown__link" href="{{ route('about') }}#support-services">Support services</a>
                    <a class="nav-dropdown__link" href="{{ route('about') }}#office">Office location</a>
                </div>
            </details>
            <details class="nav-dropdown nav-dropdown--services" onmouseenter="this.open = true" onmouseleave="this.open = false">
                <summary class="nav-link {{ request()->routeIs('services.*') ? 'is-active' : '' }}" @if(request()->routeIs('services.*')) aria-current="page" @endif>Our services</summary>
                <div class="nav-dropdown__menu">
                    @foreach(config('service_pages') as $slug => $service)
                        <a class="nav-dropdown__link" href="{{ route('services.show', ['slug' => $slug]) }}">{{ $service['name'] }}</a>
                    @endforeach
                </div>
            </details>
            <details class="nav-dropdown nav-dropdown--programs" onmouseenter="this.open = true" onmouseleave="this.open = false">
                <summary class="nav-link {{ request()->routeIs('programs.*') ? 'is-active' : '' }}" @if(request()->routeIs('programs.*')) aria-current="page" @endif>Programs</summary>
                <div class="nav-dropdown__menu">
                    <a class="nav-dropdown__link nav-dropdown__link--all" href="{{ route('programs.index') }}">All programs <span aria-hidden="true">→</span></a>
                    @foreach(config('programs') as $slug => $program)
                        <a class="nav-dropdown__link" href="{{ route('programs.show', ['slug' => $slug]) }}">{{ $program['name'] }}</a>
                    @endforeach
                </div>
            </details>
            <details class="nav-dropdown nav-dropdown--cancer" onmouseenter="this.open = true" onmouseleave="this.open = false">
                <summary class="nav-link {{ request()->routeIs('cancer.*') ? 'is-active' : '' }}" @if(request()->routeIs('cancer.*')) aria-current="page" @endif>Childhood cancer</summary>
                <div class="nav-dropdown__menu">
                    <a class="nav-dropdown__link nav-dropdown__link--all" href="{{ route('cancer.index') }}">All topics <span aria-hidden="true">→</span></a>
                    @foreach(config('cancer_topics') as $slug => $topic)
                        <a class="nav-dropdown__link" href="{{ route('cancer.show', ['slug' => $slug]) }}">{{ $topic['name'] }}</a>
                    @endforeach
                </div>
            </details>
            <details class="nav-dropdown nav-dropdown--news" onmouseenter="this.open = true" onmouseleave="this.open = false">
                <summary class="nav-link {{ request()->routeIs('news.*') ? 'is-active' : '' }}" @if(request()->routeIs('news.*')) aria-current="page" @endif>News &amp; stories</summary>
                <div class="nav-dropdown__menu">
                    <a class="nav-dropdown__link" href="{{ route('news.index') }}">News &amp; updates</a>
                    <a class="nav-dropdown__link" href="{{ route('news.events') }}">Events</a>
                    <a class="nav-dropdown__link" href="{{ route('news.vacancies') }}">Vacancies</a>
                </div>
            </details>
            <details class="nav-dropdown nav-dropdown--involved" onmouseenter="this.open = true" onmouseleave="this.open = false">
                <summary class="nav-link {{ request()->routeIs('involved.*') ? 'is-active' : '' }}" @if(request()->routeIs('involved.*')) aria-current="page" @endif>Get involved</summary>
                <div class="nav-dropdown__menu">
                    @foreach(config('involvement_pages') as $slug => $opportunity)
                        <a class="nav-dropdown__link" href="{{ route('involved.show', ['slug' => $slug]) }}">{{ $opportunity['name'] }}</a>
                    @endforeach
                </div>
            </details>
            <a class="nav-link {{ request()->routeIs('contact') ? 'is-active' : '' }}" href="{{ route('contact') }}" @if(request()->routeIs('contact')) aria-current="page" @endif>Contact</a>
        </div>
    </div>
</nav>
