<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#137fbd">
    <meta name="description" content="Children's Hope Foundation supports children with cancer and their caregivers through accommodation, meals, transport and psychosocial care in Moshi, Tanzania.">
    <title>Children's Hope Foundation Tanzania | Childhood Cancer Family Support</title>
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
            <a class="brand" href="#home" aria-label="Children's Hope Foundation home">
                <img src="{{ asset('images/chf-logo.png') }}" alt="Children's Hope Foundation logo" width="500" height="500">
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

    @php($pageHero = \App\Support\PageHeroContent::get('home'))

    <main id="main-content">
        @php($homeHeroSlides = [
            ['src' => \App\Support\PageHeroContent::imageUrl($pageHero['image_path']), 'alt' => 'Children’s Hope Foundation team members gathered in Moshi'],
            ['src' => asset('images/chf-hero-about-garden.jpeg'), 'alt' => 'CHF staff and children taking part in a garden activity'],
            ['src' => asset('images/chf-hero-play-recreation-swings.jpg'), 'alt' => 'Children enjoying outdoor play with CHF caregivers'],
            ['src' => asset('images/chf-hero-program-emotional-support.jpeg'), 'alt' => 'Children and caregivers sharing a support activity at CHF'],
            ['src' => asset('images/chf-hero-service-accommodation.jpeg'), 'alt' => 'Accommodation at the CHF home for families during treatment'],
        ])
        <section class="hero" id="home" aria-labelledby="hero-title" data-home-hero data-home-hero-slides='@json($homeHeroSlides)'>
            <img class="hero__image is-active" src="{{ $homeHeroSlides[0]['src'] }}" alt="{{ $homeHeroSlides[0]['alt'] }}" fetchpriority="high" data-home-hero-image>
            <img class="hero__image" alt="" aria-hidden="true" data-home-hero-image>
            <div class="hero__veil" aria-hidden="true"></div>
            <div class="container hero__inner">
                <div class="hero__copy">

                    <h1 id="hero-title">{{ $pageHero['title'] }} <em>{{ $pageHero['highlight'] }}</em></h1>
                    <p class="hero__lead">{{ $pageHero['intro'] }}</p>
                    <div class="hero__actions">
                        <a class="button button--orange" href="#donate">Support a child <span aria-hidden="true">→</span></a>
                        <a class="button button--outline-light" href="#services">Explore our services</a>
                    </div>
                </div>
            </div>
            <div class="hero__bottom-accent" aria-hidden="true"><span></span><span></span><span></span></div>
        </section>

        <section class="intro-cards" aria-label="Explore Children's Hope Foundation">
            <a class="intro-card intro-card--green" href="{{ route('cancer.index') }}">
                <span class="intro-card__icon" aria-hidden="true"><svg viewBox="0 0 48 48"><path d="M24 41S7 31 7 18c0-5 4-9 9-9 4 0 7 2 8 6 2-4 5-6 9-6 5 0 8 4 8 9 0 13-17 23-17 23ZM24 15v14M17 22h14"/></svg></span>
                <span class="intro-card__title">Childhood cancer</span>
                <span class="intro-card__text">Learn about childhood cancer, signs to discuss with a health professional and the support available to families.</span>
                <span class="intro-card__link">Learn more <b aria-hidden="true">↗</b></span>
            </a>
            <a class="intro-card intro-card--yellow" href="#about">
                <span class="intro-card__icon" aria-hidden="true"><svg viewBox="0 0 48 48"><path d="M5 21 24 6l19 15M10 19v23h28V19M19 42V28h10v14M19 19h.1M29 19h.1"/></svg></span>
                <span class="intro-card__title">Who we are</span>
                <span class="intro-card__text">Meet CHF, a local foundation in Moshi supporting children with cancer and their caregivers.</span>
                <span class="intro-card__link">About CHF <b aria-hidden="true">↗</b></span>
            </a>
            <a class="intro-card intro-card--orange" href="#get-involved">
                <span class="intro-card__icon" aria-hidden="true"><svg viewBox="0 0 48 48"><path d="M7 25h9l5 5h11l5-5 5 4-8 9H19l-7-5H7zM13 20c0-3 2-5 5-5 2 0 4 2 6 5 2-3 4-5 6-5 3 0 5 2 5 5 0 4-6 8-11 12-5-4-11-8-11-12Z"/></svg></span>
                <span class="intro-card__title">Get involved</span>
                <span class="intro-card__text">Help provide meals, hygiene supplies, learning materials and emotional support for children and caregivers.</span>
                <span class="intro-card__link">See how to help <b aria-hidden="true">↗</b></span>
            </a>
        </section>

        <section class="cancer-section cancer-section--text-only" id="cancer-info" aria-labelledby="cancer-title">
            <div class="container cancer-section__inner">
                <div class="cancer-section__copy">
                    <p class="eyebrow eyebrow--light"><span></span> Awareness matters</p>
                    <h2 id="cancer-title">Childhood cancer in Tanzania.</h2>
                    <p>CHF supports increased awareness of childhood cancer, early detection and timely medical care. Families should be able to seek help without distance or poverty standing in the way.</p>
                    @include('partials.cancer-statistics')
                    <a class="button button--outline-light" href="{{ route('cancer.index') }}">Learn about childhood cancer</a>
                </div>
            </div>
        </section>

        <section class="pillars" id="about" aria-labelledby="pillars-title">
            <div class="container pillars__inner">
                <div class="section-heading section-heading--center">
                    <p class="eyebrow"><span></span> Who we are</p>
                    <h2 id="pillars-title">Care that reaches beyond the hospital</h2>
                    <p>For a family travelling for treatment, support with the everyday needs can help make the journey more manageable.</p>
                </div>
                <div class="pillar-grid">
                    <article class="pillar">
                        <span class="pillar__icon pillar__icon--blue" aria-hidden="true"><svg viewBox="0 0 48 48"><path d="M5 22 24 7l19 15M10 20v22h28V20M19 42V28h10v14M19 19h.1M29 19h.1"/></svg></span>
                        <div><h3>A place to stay</h3><p>Free accommodation and meals for children and caregivers travelling from distant communities.</p></div>
                    </article>
                    <article class="pillar">
                        <span class="pillar__icon pillar__icon--orange" aria-hidden="true"><svg viewBox="0 0 48 48"><path d="M8 13h23v23H8zM31 21h6l5 7v8H31zM14 40a4 4 0 1 0 0-8 4 4 0 0 0 0 8ZM36 40a4 4 0 1 0 0-8 4 4 0 0 0 0 8ZM13 20h13M13 26h9"/></svg></span>
                        <div><h3>A safer trip to care</h3><p>Transport between the foundation's home and hospital appointments, with a safe return.</p></div>
                    </article>
                    <article class="pillar">
                        <span class="pillar__icon pillar__icon--green" aria-hidden="true"><svg viewBox="0 0 48 48"><path d="M24 41S7 31 7 18c0-5 4-9 9-9 4 0 7 2 8 6 2-4 5-6 9-6 5 0 8 4 8 9 0 13-17 23-17 23ZM17 24h14M24 17v14"/></svg></span>
                        <div><h3>Support for the whole family</h3><p>Counselling, play and peer support for children, parents and caregivers.</p></div>
                    </article>
                </div>
            </div>
        </section>

        <section class="home-purpose" aria-labelledby="purpose-title">
            <div class="container">
                <div class="section-heading section-heading--center"><p class="eyebrow"><span></span> Our purpose</p><h2 id="purpose-title">Hope, love and support.</h2></div>
                <div class="home-purpose__grid">
                    <article><p class="eyebrow"><span></span> Our vision</p><h3>Accessible care for every child.</h3><p>To see every child with cancer in Tanzania receive accessible, quality care in a safe and supportive environment.</p></article>
                    <article><p class="eyebrow"><span></span> Our mission</p><h3>Support throughout treatment and beyond.</h3><p>To give hope, share love, and support children with cancer and their caregivers throughout the treatment journey and beyond.</p></article>
                </div>
            </div>
        </section>

        <section class="service-feature" id="services" aria-labelledby="services-title">
            <div class="container service-feature__inner">
                <div class="service-feature__visual">
                    <img src="{{ asset('images/chf-family-activities.jpeg') }}" alt="Children and caregivers taking part in activities in the CHF garden" loading="lazy">
                    <span class="photo-caption"><span class="photo-caption__dot"></span> Care, comfort and connection</span>
                    <span class="visual-sun" aria-hidden="true"></span>
                </div>
                <div class="service-feature__copy">
                    <p class="eyebrow"><span></span> Our core services</p>
                    <h2 id="services-title">Support for children and their caregivers.</h2>
                    <p class="service-feature__lead">CHF supports children and caregivers with accommodation, nutrition, transport, psychosocial care and opportunities to play and learn.</p>
                    <ul class="service-list">
                        <li><span aria-hidden="true">✓</span> Free accommodation and nutritional support</li>
                        <li><span aria-hidden="true">✓</span> Transport to and from the nearby hospital</li>
                        <li><span aria-hidden="true">✓</span> Play, recreation and art activities</li>
                        <li><span aria-hidden="true">✓</span> Counselling and caregiver support</li>
                        <li><span aria-hidden="true">✓</span> Education support and learning activities</li>
                    </ul>
                    <a class="text-link" href="#get-involved">See how you can support <span aria-hidden="true">→</span></a>
                </div>
            </div>
        </section>



        <section class="stories container" id="stories" aria-labelledby="stories-title">
            <div class="section-heading section-heading--row">
                <div><p class="eyebrow"><span></span> Learn about our work</p><h2 id="stories-title">Care, learning and support at CHF.</h2></div>
                <p>Our work brings together nutrition, emotional support, learning activities, play and a safe place to stay.</p>
            </div>
            <div class="story-grid">
                <article class="story-card">
                    <div class="story-card__image story-card__image--home"><span class="story-label">Home away from home</span></div>
                    <div class="story-card__body"><span class="story-card__tag">Family support</span><h3>More than a place to stay</h3><p>Children and caregivers can access free accommodation and meals, alongside transport, play and psychosocial support.</p><a href="#services" class="text-link">Explore our services <span aria-hidden="true">→</span></a></div>
                </article>
                <article class="story-card">
                    <div class="story-card__image story-card__image--care"><span class="story-label">Care for caregivers</span></div>
                    <div class="story-card__body"><span class="story-card__tag">Emotional support</span><h3>Families need care, too</h3><p>Guidance, counselling and peer support help caregivers face the challenges of long-term treatment.</p><a href="#services" class="text-link">How CHF helps <span aria-hidden="true">→</span></a></div>
                </article>
                <article class="story-card">
                    <div class="story-card__image story-card__image--learning"><span class="story-label">Play and learning</span></div>
                    <div class="story-card__body"><span class="story-card__tag">Education support</span><h3>Room to learn and create</h3><p>CHF’s education support objective recognises that children need opportunities to learn alongside their care. Contact our team to discuss available support.</p><a href="{{ route('programs.show', ['slug' => 'education-support']) }}" class="text-link">Explore education support <span aria-hidden="true">→</span></a></div>
                </article>
            </div>
        </section>

        <section class="support-banner" aria-labelledby="support-title">
            <div class="container support-banner__inner">
                <div><p class="eyebrow eyebrow--light"><span></span> Every contribution counts</p><h2 id="support-title">Your support brings hope.</h2><p>Help us care for children with cancer and the families who travel beside them.</p></div>
                <a class="button button--yellow" href="#donate">Find a way to help <span aria-hidden="true">→</span></a>
            </div>
        </section>

        <section class="action-grid" id="get-involved" aria-label="Ways to support CHF">
            <article class="action-card action-card--orange" id="donate">
                <span class="action-card__icon" aria-hidden="true">♡</span><h3>Help us keep hope alive.</h3>
                <p>We welcome food supplies, hygiene products and financial contributions.</p>
                <a class="button button--dark" href="mailto:homeofchildrens26@gmail.com?subject=Supporting%20Children's%20Hope%20Foundation">Ask how to donate</a>
            </article>
            <article class="action-card action-card--yellow">
                <span class="action-card__icon" aria-hidden="true">✳</span><h3>Become a partner.</h3>
                <p>Join CHF and local stakeholders in supporting children and their caregivers.</p>
                <a class="button button--dark" href="#contact">Connect with CHF</a>
            </article>
            <article class="action-card action-card--green">
                <span class="action-card__icon" aria-hidden="true">↗</span><h3>Share hope with others.</h3>
                <p>Share information about childhood cancer and help families find support.</p>
                <a class="button button--dark" href="{{ route('cancer.index') }}">Learn about awareness</a>
            </article>
        </section>

        <section class="connect-section" id="contact" aria-labelledby="connect-title">
            <div class="connect-section__photo" role="img" aria-label="Children and caregivers together at CHF"></div>
            <div class="connect-section__content">
                <p class="eyebrow"><span></span> Stay connected</p>
                <h2 id="connect-title">Contact Children’s Hope Foundation</h2>
                <p>Have a question, want to support a family, or explore working together? Get in touch with our team in Moshi.</p>
                <div class="contact-card">
                    <a href="mailto:homeofchildrens26@gmail.com"><span class="contact-card__label">Email</span><strong>homeofchildrens26@gmail.com</strong></a>
                    <a href="tel:+255795469469"><span class="contact-card__label">Call CHF</span><strong>+255 795 469 469</strong></a>
                </div>
                <a class="button button--blue" href="mailto:homeofchildrens26@gmail.com?subject=Hello%20CHF">Email our team</a>
            </div>
        </section>

        <section class="partner-callout" aria-labelledby="partner-title">
            <div class="partner-callout__mark" aria-hidden="true"><span>CHF</span><i></i></div>
            <p class="eyebrow"><span></span> Together, we can do more</p>
            <h2 id="partner-title">Hope grows when we stand together.</h2>
            <p>We welcome people and organizations who want to support children with cancer and their caregivers in Tanzania.</p>
            <a class="button button--blue" href="mailto:homeofchildrens26@gmail.com?subject=Partner%20with%20CHF">Partner with CHF</a>
        </section>
    </main>

    <footer class="site-footer" id="site-footer">
        <div class="container footer-contact-strip">
            <a class="footer-contact-item" href="tel:+255795469469">
                <span class="footer-contact-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M6.6 3.8 9.4 7l-1.8 2.4a15.4 15.4 0 0 0 7 7l2.4-1.8 3.2 2.8-.8 2.9c-.2.8-1 1.3-1.8 1.2C9.8 20.6 3.4 14.2 2.5 6.4c-.1-.8.4-1.6 1.2-1.8z"/></svg></span>
                <span><small>Call us</small><strong>+255 795 469 469</strong></span>
            </a>
            <a class="footer-contact-item" href="mailto:homeofchildrens26@gmail.com">
                <span class="footer-contact-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M3 5.5h18v13H3zM3.5 6l8.5 7 8.5-7"/></svg></span>
                <span><small>Email us</small><strong>homeofchildrens26@gmail.com</strong></span>
            </a>
            <a class="footer-contact-item" href="#contact">
                <span class="footer-contact-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M20 10c0 5.2-8 12-8 12S4 15.2 4 10a8 8 0 1 1 16 0Z"/><circle cx="12" cy="10" r="2.5"/></svg></span>
                <span><small>Our office</small><strong>Moshi, Kilimanjaro<br>Near the hospital</strong></span>
            </a>
        </div>
        <div class="container footer-grid">
            <div class="footer-brand">
                <a href="#home" aria-label="Children's Hope Foundation home"><img src="{{ asset('images/chf-logo.png') }}" alt="Children's Hope Foundation" width="500" height="500"></a>
                <p>Children's Hope Foundation cares for children with cancer and their families in Tanzania.</p>
            </div>
            <div class="footer-column footer-column--solutions"><h2>Useful Links</h2><a href="{{ route('about') }}">About CHF</a><a href="{{ route('programs.index') }}">All programs</a><a href="{{ route('programs.show', ['slug' => 'accommodation']) }}">Accommodation and meals</a><a href="{{ route('programs.show', ['slug' => 'transport']) }}">Transport to the nearby hospital</a><a href="{{ route('programs.show', ['slug' => 'additional-programmes']) }}">Play and recreation</a><a href="{{ route('cancer.index') }}">Childhood cancer information</a><a href="#stories">News &amp; stories</a></div>
            <div class="footer-column footer-column--contact"><h2>Get in touch</h2><p>Moshi, Kilimanjaro, Tanzania<br>Near the hospital</p><a href="mailto:homeofchildrens26@gmail.com">homeofchildrens26@gmail.com</a><a href="tel:+255795469469">+255 795 469 469</a></div>
            <div class="footer-column footer-column--connect"><h2>Stay connected</h2><p>Join us in bringing hope, care and support to children and their families.</p><a class="footer-connect-link" href="#get-involved">Get involved <span aria-hidden="true">↗</span></a><a class="footer-connect-link" href="#donate">Support a child <span aria-hidden="true">↗</span></a></div>
        </div>
        <div class="footer-bottom"><div class="container footer-bottom__inner">
            <span>© {{ date('Y') }} Children's Hope Foundation (CHF). All rights reserved.</span>
            <nav aria-label="Footer navigation"><a href="#about">About</a><a href="#services">Services</a><a href="#contact">Contact</a><a href="#get-involved">Get involved</a></nav>
        </div><a class="footer-to-top" href="#home" aria-label="Back to top"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 19V5m-7 7 7-7 7 7"/></svg></a></div>
    </footer>

    <script src="{{ asset('js/site.js') }}?v={{ filemtime(public_path('js/site.js')) }}" defer></script>
</body>
</html>
