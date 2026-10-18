<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#137fbd">
    <meta name="description" content="Learn about Children's Hope Foundation: our story, mission, vision, objectives and practical support for children with cancer and their caregivers in Tanzania.">
    <title>About CHF | Children's Hope Foundation</title>
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

    @php($pageHero = \App\Support\PageHeroContent::get('about'))

    <main id="main-content">
        <section class="hero" id="about-hero" aria-labelledby="hero-title">
            <img class="hero__image" src="{{ \App\Support\PageHeroContent::imageUrl($pageHero['image_path']) }}" alt="Children and caregivers taking part in an outdoor art activity at CHF" fetchpriority="high">
            <div class="hero__veil" aria-hidden="true"></div>
            <div class="container hero__inner">
                <div class="hero__copy">

                    <h1 id="hero-title">{{ $pageHero['title'] }} <em>{{ $pageHero['highlight'] }}</em></h1>
                    <p class="hero__lead">{{ $pageHero['intro'] }}</p>
                    <div class="hero__actions">
                        <a class="button button--orange" href="{{ route('home') }}#donate">Support a child <span aria-hidden="true">→</span></a>
                        <a class="button button--outline-light" href="#support-services">Explore our services</a>
                    </div>
                </div>
                <div class="hero-note">
                    <span class="hero-note__icon" aria-hidden="true">♡</span>
                    <span><strong>A home away from home</strong><small>Close to care at the nearby hospital</small></span>
                </div>
            </div>
            <div class="hero__bottom-accent" aria-hidden="true"><span></span><span></span><span></span></div>
        </section>

        <section class="about-intro" aria-labelledby="about-intro-title">
            <div class="container about-intro__grid">
                <div class="about-intro__copy">
                    <p class="eyebrow eyebrow--light"><span></span> About Children's Hope Foundation</p>
                    <h2 id="about-intro-title">What is CHF?</h2>
                    <p class="about-intro__subtitle">A Moshi-based foundation supporting children with cancer and their families.</p>
                    <div class="about-intro__prose">
                        <p>Children's Hope Foundation (CHF) is a non-governmental organization based in Moshi, Kilimanjaro, Tanzania. We help ease the medical, emotional and financial pressures childhood cancer can place on children and their caregivers.</p>
                        <p>Through our Home Away from Home near the hospital, families can find free accommodation, nutritional support, transport, psychosocial care, play and education support while a child receives treatment.</p>
                    </div>
                </div>
                <div class="about-intro__visual about-intro__visual--about">
                    <img src="{{ asset('images/abaut.png') }}" alt="The CHF support home in Moshi" loading="lazy">
                </div>
            </div>
        </section>

        <section class="about-values-strip" aria-label="CHF at a glance">
            <div class="container about-values-strip__grid">
                <div class="about-values-strip__heading">
                    <p class="eyebrow"><span></span> The foundation behind the care</p>
                    <h2>Where we keep hope alive.</h2>
                    <p>We stand alongside children and families, bringing care closer during a difficult journey.</p>
                </div>
                <article class="about-value-card">
                    <span class="about-value-card__icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M12 21s-8-4.4-8-11a4.5 4.5 0 0 1 8-2.8A4.5 4.5 0 0 1 20 10c0 6.6-8 11-8 11Z"/><path d="M8 12h8M12 8v8"/></svg></span>
                    <div><h3>Who we are</h3><p>A local foundation standing beside children with cancer and the caregivers who support them throughout treatment.</p></div>
                </article>
                <article class="about-value-card">
                    <span class="about-value-card__icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M12 3v18M3 12h18"/><path d="m5 5 14 14M19 5 5 19"/></svg></span>
                    <div><h3>Why we exist</h3><p>Distance, travel costs and a lack of nearby accommodation should not keep a child from reaching care.</p></div>
                </article>
            </div>
        </section>

        <section class="about-story" id="history" aria-labelledby="about-story-title">
            <div class="container">
                <div class="about-story__heading">
                    <p class="eyebrow"><span></span> Foundation history</p>
                    <h2 class="about-section-heading__title" id="about-story-title">A response to the long journey for care.</h2>
                    <p>CHF's work is rooted in the challenges families can face when they must travel to reach specialized childhood cancer treatment.</p>
                </div>
                <div class="about-story__grid">
                    <div class="about-story__copy">
                        <h3>Making the path to treatment easier.</h3>
                        <p>Specialized care is concentrated at hospitals including the nearby hospital. For families coming from distant communities, fares, meals and a safe place to stay can add strain to an already difficult time.</p>
                        <p>Children may need regular appointments and follow-up care. CHF helps bridge the distance between medical treatment and day-to-day family needs with a nearby support home and practical care.</p>
                        <p>Our work brings children and caregivers a place to rest, nourishing meals, transport to appointments and psychosocial support during the treatment journey.</p>
                    </div>
                    <div class="about-story__image">
                        <img src="{{ asset('images/chf-child-painting.jpeg') }}" alt="A child painting at CHF" loading="lazy">
                    </div>
                </div>
            </div>
        </section>

        <section class="about-mission" id="mission-vision" aria-labelledby="mission-vision-title">
            <div class="container">
                <div class="about-section-heading">
                    <p class="eyebrow"><span></span> Our direction</p>
                    <h2 id="mission-vision-title">The purpose behind every act of care.</h2>
                    <p>Our mission and vision guide the support we offer children and their caregivers.</p>
                </div>
                <div class="about-mission__grid">
                    <article class="about-statement about-statement--vision">
                        <span class="about-statement__label">Our vision</span>
                        <h3>Accessible care for every child.</h3>
                        <p>To see every child with cancer in Tanzania receive accessible, quality care in a safe and supportive environment.</p>
                    </article>
                    <article class="about-statement about-statement--mission">
                        <span class="about-statement__label">Our mission</span>
                        <h3>Support throughout treatment and beyond.</h3>
                        <p>To give hope, share love, and support children with cancer and their caregivers throughout the treatment journey and beyond.</p>
                    </article>
                </div>
            </div>
        </section>

        <section class="about-objectives" id="objectives" aria-labelledby="objectives-title">
            <div class="container">
                <div class="about-section-heading">
                    <p class="eyebrow"><span></span> Our objectives</p>
                    <h2 id="objectives-title">What we work towards.</h2>
                    <p>CHF's objectives focus on access to care, family wellbeing and childhood cancer awareness.</p>
                </div>
                <div class="about-objectives__grid">
                    <article class="about-objective">
                        <span class="about-objective__number">01</span>
                        <h3>Improve access to timely care</h3>
                        <p>Reduce barriers to diagnosis, treatment and follow-up through practical assistance and stronger health services.</p>
                    </article>
                    <article class="about-objective">
                        <span class="about-objective__number">02</span>
                        <h3>Strengthen support for families</h3>
                        <p>Help improve quality of life through counselling, play, education assistance and caregiver support.</p>
                    </article>
                    <article class="about-objective">
                        <span class="about-objective__number">03</span>
                        <h3>Grow awareness and early detection</h3>
                        <p>Promote understanding of childhood cancer, reduce stigma and encourage people to seek medical care early.</p>
                    </article>
                </div>
            </div>
        </section>

        <section class="about-support" id="support-services" aria-labelledby="support-services-title">
            <div class="container">
                <div class="about-section-heading">
                    <p class="eyebrow"><span></span> Support services</p>
                    <h2 id="support-services-title">Practical help at every step.</h2>
                    <p>Support for the needs around treatment can make the journey more manageable for children and caregivers.</p>
                </div>
                <div class="about-support__layout">
                    <div class="about-service-wheel" aria-label="CHF combines family support, awareness and practical care">
                        <div class="about-service-wheel__center"><span>CHF</span><small>Care around treatment</small></div>
                        <span class="about-service-wheel__label about-service-wheel__label--one">Family<br>support</span>
                        <span class="about-service-wheel__label about-service-wheel__label--two">Awareness</span>
                        <span class="about-service-wheel__label about-service-wheel__label--three">Practical<br>care</span>
                    </div>
                    <div class="about-support__faq" aria-label="CHF support services">
                        <details class="about-faq" name="chf-support-services">
                            <summary><span class="about-faq__number">01</span><span class="about-faq__title">Accommodation and meals</span><span class="about-faq__toggle" aria-hidden="true"></span></summary>
                            <div class="about-faq__answer"><p>CHF's Home Away from Home gives children and caregivers a safe place to stay near treatment, with nourishing meals during their time in Moshi.</p></div>
                        </details>
                        <details class="about-faq" name="chf-support-services">
                            <summary><span class="about-faq__number">02</span><span class="about-faq__title">Transport to treatment</span><span class="about-faq__toggle" aria-hidden="true"></span></summary>
                            <div class="about-faq__answer"><p>Transport support helps families reach hospital appointments and continue the treatment and follow-up visits their child needs.</p></div>
                        </details>
                        <details class="about-faq" name="chf-support-services">
                            <summary><span class="about-faq__number">03</span><span class="about-faq__title">Psychosocial care</span><span class="about-faq__toggle" aria-hidden="true"></span></summary>
                            <div class="about-faq__answer"><p>Children and caregivers can receive emotional support, guidance and connection with others who understand the challenges of treatment.</p></div>
                        </details>
                        <details class="about-faq" name="chf-support-services">
                            <summary><span class="about-faq__number">04</span><span class="about-faq__title">Play and recreation</span><span class="about-faq__toggle" aria-hidden="true"></span></summary>
                            <div class="about-faq__answer"><p>Play and age-appropriate activities give children room for joy, creativity and connection alongside their care.</p></div>
                        </details>
                    </div>
                </div>
            </div>
            <div class="about-offer-band">
                <img src="{{ asset('images/chf-caregiver-art-session.jpeg') }}" alt="" loading="lazy" aria-hidden="true">
                <div class="about-offer-band__veil" aria-hidden="true"></div>
                <div class="container about-offer-band__inner">
                    <div class="about-offer-card">
                        <p class="eyebrow eyebrow--light"><span></span> What we offer</p>
                        <h3>Practical care for the whole family.</h3>
                        <ul>
                            <li><span aria-hidden="true">✓</span> Accommodation close to treatment</li>
                            <li><span aria-hidden="true">✓</span> Nourishing meals for children and caregivers</li>
                            <li><span aria-hidden="true">✓</span> Transport to and from hospital appointments</li>
                            <li><span aria-hidden="true">✓</span> Psychosocial care, play and caregiver support</li>
                        </ul>
                        <a class="button button--yellow" href="{{ route('home') }}#services">Explore our services <span aria-hidden="true">→</span></a>
                    </div>
                </div>
            </div>
        </section>

        <section class="about-office" id="office" aria-labelledby="about-office-title">
            <div class="about-office__banner">
                <div class="container">
                    <p class="eyebrow eyebrow--light"><span></span> Find us in Moshi</p>
                    <h2 id="about-office-title">A welcoming place, close to care.</h2>
                    <p>Our office and family support home are based near the hospital in Moshi, Kilimanjaro.</p>
                </div>
            </div>
            <div class="container about-office__content">
                @foreach ([
                    [
                        'name' => "Children's Hope Foundation Office",
                        'subtitle' => 'Office & Home Away from Home',
                        'address' => 'Moshi, Kilimanjaro, Tanzania',
                        'landmark' => 'Near the hospital',
                        'image' => 'images/chf-support-home.jpeg',
                        'gallery' => ['images/chf-play-resources.jpeg', 'images/chf-creative-play.jpeg', 'images/chf-caregiver-art-session.jpeg', 'images/chf-children-art-activities.jpeg'],
                    ],
                ] as $office)
                    <article class="about-office-card">
                        <div class="about-office-card__gallery" aria-label="Five photos showing CHF care and support">
                            <img class="about-office-card__main-image" src="{{ asset($office['image']) }}" alt="The CHF support home and garden in Moshi" loading="lazy">
                            @foreach ($office['gallery'] as $photo)
                                <img class="about-office-card__gallery-image" src="{{ asset($photo) }}" alt="Activities and resources at the CHF home" loading="lazy">
                            @endforeach
                        </div>
                        <div class="about-office-card__details">
                            <p class="eyebrow"><span></span> Our office</p>
                            <h3>{{ $office['name'] }}</h3>
                            <p class="about-office-card__subtitle">{{ $office['subtitle'] }}</p>
                            <p class="about-office-card__address"><span aria-hidden="true">⌖</span><span>{{ $office['address'] }}<br>{{ $office['landmark'] }}</span></p>
                            <a class="button button--blue" href="{{ route('home') }}#contact">Contact CHF <span aria-hidden="true">→</span></a>
                        </div>
                    </article>
                @endforeach
            </div>
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
            <a class="footer-contact-item" href="{{ route('home') }}#contact">
                <span class="footer-contact-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M20 10c0 5.2-8 12-8 12S4 15.2 4 10a8 8 0 1 1 16 0Z"/><circle cx="12" cy="10" r="2.5"/></svg></span>
                <span><small>Our office</small><strong>Moshi, Kilimanjaro<br>Near the hospital</strong></span>
            </a>
        </div>
        <div class="container footer-grid">
            <div class="footer-brand">
                <a href="{{ route('home') }}#home" aria-label="Children's Hope Foundation home"><img src="{{ asset('images/chf-logo.png') }}" alt="Children's Hope Foundation" width="500" height="500"></a>
                <p>Children's Hope Foundation cares for children with cancer and their families in Tanzania.</p>
            </div>
            <div class="footer-column footer-column--solutions"><h2>Useful Links</h2><a href="{{ route('about') }}">About CHF</a><a href="{{ route('programs.index') }}">All programs</a><a href="{{ route('programs.show', ['slug' => 'accommodation']) }}">Accommodation and meals</a><a href="{{ route('programs.show', ['slug' => 'transport']) }}">Transport to the nearby hospital</a><a href="{{ route('programs.show', ['slug' => 'additional-programmes']) }}">Play and recreation</a><a href="{{ route('cancer.index') }}">Childhood cancer information</a><a href="{{ route('home') }}#stories">News &amp; stories</a></div>
            <div class="footer-column footer-column--contact"><h2>Get in touch</h2><p>Moshi, Kilimanjaro, Tanzania<br>Near the hospital</p><a href="mailto:homeofchildrens26@gmail.com">homeofchildrens26@gmail.com</a><a href="tel:+255795469469">+255 795 469 469</a></div>
            <div class="footer-column footer-column--connect"><h2>Stay connected</h2><p>Join us in bringing hope, care and support to children and their families.</p><a class="footer-connect-link" href="{{ route('home') }}#get-involved">Get involved <span aria-hidden="true">↗</span></a><a class="footer-connect-link" href="{{ route('home') }}#donate">Support a child <span aria-hidden="true">↗</span></a></div>
        </div>
        <div class="footer-bottom"><div class="container footer-bottom__inner">
            <span>© {{ date('Y') }} Children's Hope Foundation (CHF). All rights reserved.</span>
            <nav aria-label="Footer navigation"><a href="{{ route('about') }}">About</a><a href="{{ route('home') }}#services">Services</a><a href="{{ route('home') }}#contact">Contact</a><a href="{{ route('home') }}#get-involved">Get involved</a></nav>
        </div><a class="footer-to-top" href="#about-hero" aria-label="Back to top"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 19V5m-7 7 7-7 7 7"/></svg></a></div>
    </footer>

    <script src="{{ asset('js/site.js') }}" defer></script>
</body>
</html>
