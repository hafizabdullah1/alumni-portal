<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Alumni Portal | Join the Network</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=dm-sans:300,400,500,600,700&family=dm-serif-display:400,400i" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --cream: #f8f6f1;
            --warm-white: #fdfcfa;
            --ink: #1a1a1a;
            --ink-soft: #4a4a4a;
            --ink-muted: #9a9a9a;
            --accent: #2d5a3d;
            --accent-light: #e8f0eb;
            --border: #e8e4dc;
            --serif: 'DM Serif Display', Georgia, serif;
            --sans: 'DM Sans', sans-serif;
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: var(--sans);
            background-color: var(--warm-white);
            color: var(--ink);
            -webkit-font-smoothing: antialiased;
            overflow-x: hidden;
        }

        /* NAV */
        nav {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 50;
            background: rgba(253, 252, 250, 0.92);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            border-bottom: 1px solid var(--border);
        }

        .nav-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }

        .logo-mark {
            width: 32px;
            height: 32px;
            background: var(--ink);
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--warm-white);
            font-family: var(--serif);
            font-size: 16px;
        }

        .logo-text {
            font-size: 15px;
            font-weight: 600;
            color: var(--ink);
            letter-spacing: -0.02em;
        }

        .logo-text span {
            font-weight: 300;
            color: var(--ink-muted);
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 2.5rem;
            list-style: none;
        }

        .nav-links a {
            text-decoration: none;
            font-size: 14px;
            font-weight: 400;
            color: var(--ink-soft);
            transition: color 0.2s;
            letter-spacing: -0.01em;
        }

        .nav-links a:hover { color: var(--ink); }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 20px;
            background: var(--ink);
            color: var(--warm-white);
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
            border-radius: 6px;
            transition: background 0.2s, transform 0.2s;
            letter-spacing: -0.01em;
        }

        .btn-primary:hover {
            background: #333;
            transform: translateY(-1px);
        }

        .btn-secondary {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 20px;
            background: transparent;
            color: var(--ink-soft);
            text-decoration: none;
            font-size: 13px;
            font-weight: 400;
            border-radius: 6px;
            border: 1px solid var(--border);
            transition: all 0.2s;
        }

        .btn-secondary:hover {
            border-color: var(--ink-soft);
            color: var(--ink);
        }

        /* HERO */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding-top: 64px;
            background-color: var(--warm-white);
        }

        .hero-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 6rem 2rem 4rem;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 6rem;
            align-items: center;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 14px;
            background: var(--accent-light);
            color: var(--accent);
            border-radius: 100px;
            font-size: 12px;
            font-weight: 500;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            margin-bottom: 1.5rem;
        }

        .badge-dot {
            width: 6px;
            height: 6px;
            background: var(--accent);
            border-radius: 50%;
        }

        .hero-heading {
            font-family: var(--serif);
            font-size: clamp(2.8rem, 5vw, 4.2rem);
            line-height: 1.1;
            color: var(--ink);
            letter-spacing: -0.02em;
            margin-bottom: 1.5rem;
        }

        .hero-heading em {
            font-style: italic;
            color: var(--ink-soft);
        }

        .hero-sub {
            font-size: 17px;
            color: var(--ink-soft);
            line-height: 1.7;
            font-weight: 300;
            margin-bottom: 2.5rem;
            max-width: 460px;
        }

        .hero-actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .hero-actions .btn-main {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 14px 28px;
            background: var(--ink);
            color: var(--warm-white);
            text-decoration: none;
            font-size: 15px;
            font-weight: 500;
            border-radius: 8px;
            transition: all 0.2s;
            letter-spacing: -0.01em;
        }

        .hero-actions .btn-main:hover {
            background: #2a2a2a;
            transform: translateY(-2px);
        }

        .hero-actions .btn-ghost {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 14px 28px;
            background: transparent;
            color: var(--ink-soft);
            text-decoration: none;
            font-size: 15px;
            font-weight: 400;
            border-radius: 8px;
            border: 1px solid var(--border);
            transition: all 0.2s;
        }

        .hero-actions .btn-ghost:hover {
            border-color: var(--ink-soft);
            color: var(--ink);
        }

        /* HERO VISUAL */
        .hero-visual {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .stat-card {
            background: var(--warm-white);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 20px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: transform 0.3s, box-shadow 0.3s;
            animation: slideUp 0.6s ease both;
        }

        .stat-card:hover {
            transform: translateX(4px);
            box-shadow: 0 4px 20px rgba(0,0,0,0.06);
        }

        .stat-card:nth-child(2) { animation-delay: 0.1s; }
        .stat-card:nth-child(3) { animation-delay: 0.2s; }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(16px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .stat-left { display: flex; flex-direction: column; gap: 4px; }
        .stat-label { font-size: 12px; color: var(--ink-muted); font-weight: 400; letter-spacing: 0.03em; text-transform: uppercase; }
        .stat-value { font-family: var(--serif); font-size: 2rem; color: var(--ink); line-height: 1; }

        .stat-icon {
            width: 44px;
            height: 44px;
            background: var(--cream);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--ink-soft);
        }

        .stat-icon svg { width: 20px; height: 20px; }

        /* DIVIDER */
        .divider {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            border-top: 1px solid var(--border);
        }

        /* FEATURES */
        .features {
            padding: 7rem 2rem;
            background: var(--cream);
        }

        .section-inner {
            max-width: 1200px;
            margin: 0 auto;
        }

        .section-label {
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--accent);
            margin-bottom: 1rem;
        }

        .section-title {
            font-family: var(--serif);
            font-size: clamp(2rem, 3.5vw, 3rem);
            color: var(--ink);
            letter-spacing: -0.02em;
            line-height: 1.15;
            max-width: 560px;
            margin-bottom: 4rem;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2px;
            border: 1px solid var(--border);
            border-radius: 16px;
            overflow: hidden;
            background: var(--border);
        }

        .feature-item {
            background: var(--warm-white);
            padding: 2.5rem;
            transition: background 0.2s;
            cursor: default;
        }

        .feature-item:hover { background: #fbfaf8; }

        .feature-num {
            font-family: var(--serif);
            font-size: 2.5rem;
            color: var(--border);
            line-height: 1;
            margin-bottom: 1.5rem;
            font-style: italic;
        }

        .feature-title {
            font-size: 17px;
            font-weight: 600;
            color: var(--ink);
            margin-bottom: 0.75rem;
            letter-spacing: -0.02em;
        }

        .feature-desc {
            font-size: 14px;
            color: var(--ink-muted);
            line-height: 1.65;
            font-weight: 300;
        }

        /* CTA */
        .cta-section {
            padding: 7rem 2rem;
            background: var(--warm-white);
        }

        .cta-box {
            max-width: 1200px;
            margin: 0 auto;
            background: var(--ink);
            border-radius: 20px;
            padding: 5rem;
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 4rem;
            align-items: center;
        }

        .cta-heading {
            font-family: var(--serif);
            font-size: clamp(2rem, 3.5vw, 2.8rem);
            color: var(--warm-white);
            letter-spacing: -0.02em;
            line-height: 1.15;
            margin-bottom: 1rem;
        }

        .cta-heading em { font-style: italic; color: rgba(255,255,255,0.5); }

        .cta-desc {
            font-size: 15px;
            color: rgba(255,255,255,0.5);
            font-weight: 300;
            line-height: 1.65;
            max-width: 500px;
        }

        .cta-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 16px 32px;
            background: var(--warm-white);
            color: var(--ink);
            text-decoration: none;
            font-size: 15px;
            font-weight: 600;
            border-radius: 8px;
            white-space: nowrap;
            transition: all 0.2s;
            letter-spacing: -0.01em;
        }

        .cta-btn:hover {
            background: var(--cream);
            transform: translateY(-2px);
        }

        /* FOOTER */
        footer {
            border-top: 1px solid var(--border);
            padding: 2.5rem 2rem;
            background: var(--warm-white);
        }

        .footer-inner {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 2rem;
            flex-wrap: wrap;
        }

        .footer-links {
            display: flex;
            gap: 2rem;
            list-style: none;
        }

        .footer-links a {
            font-size: 13px;
            color: var(--ink-muted);
            text-decoration: none;
            transition: color 0.2s;
        }

        .footer-links a:hover { color: var(--ink); }

        .footer-copy {
            font-size: 13px;
            color: var(--ink-muted);
        }

        /* RESPONSIVE */
        @media (max-width: 900px) {
            .hero-inner { grid-template-columns: 1fr; gap: 3rem; }
            .hero-visual { display: none; }
            .features-grid { grid-template-columns: 1fr; }
            .cta-box { grid-template-columns: 1fr; padding: 3rem 2rem; gap: 2rem; }
            .nav-links { display: none; }
        }
    </style>
</head>
<body>

    <!-- Navigation -->
    <nav>
        <div class="nav-inner">
            <a href="/" class="logo">
                <div class="logo-mark">A</div>
                <div class="logo-text">Alumni<span>Portal</span></div>
            </a>

            <ul class="nav-links">
                <li><a href="#features">Features</a></li>
                <li><a href="#benefits">Benefits</a></li>
                @if (Route::has('login'))
                    @auth
                        <li><a href="{{ url('/dashboard') }}" class="btn-primary">Dashboard</a></li>
                    @else
                        <li><a href="{{ route('login') }}">Log in</a></li>
                        @if (Route::has('register'))
                            <li><a href="{{ route('register') }}" class="btn-primary" style="color: white !important;">Join Network</a></li>
                        @endif
                    @endauth
                @endif
            </ul>
        </div>
    </nav>

    <!-- Hero -->
    <section class="hero">
        <div class="hero-inner">
            <div>
                <div class="hero-badge">
                    <div class="badge-dot"></div>
                    Official University Network
                </div>
                <h1 class="hero-heading">
                    Where alumni<br>
                    <em>shape</em> what<br>
                    comes next.
                </h1>
                <p class="hero-sub">
                    A verified community for graduates to connect, share opportunities, and stay rooted with the institution that started it all.
                </p>
                <div class="hero-actions">
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn-main">
                            Get Verified Access
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                        </a>
                    @endif
                    <a href="#features" class="btn-ghost">Learn more</a>
                </div>
            </div>

            <div class="hero-visual">
                <div class="stat-card">
                    <div class="stat-left">
                        <div class="stat-label">Verified Alumni</div>
                        <div class="stat-value">12k+</div>
                    </div>
                    <div class="stat-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-left">
                        <div class="stat-label">Open Opportunities</div>
                        <div class="stat-value">340</div>
                    </div>
                    <div class="stat-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v2"/></svg>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-left">
                        <div class="stat-label">Events This Year</div>
                        <div class="stat-value">28</div>
                    </div>
                    <div class="stat-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features -->
    <section id="features" class="features">
        <div class="section-inner">
            <div class="section-label">What you get</div>
            <h2 class="section-title">Everything you need to grow professionally.</h2>

            <div class="features-grid">
                <div class="feature-item">
                    <div class="feature-num">01</div>
                    <div class="feature-title">Global Directory</div>
                    <p class="feature-desc">Search and connect with thousands of verified alumni across industries, companies, and cities worldwide.</p>
                </div>
                <div class="feature-item">
                    <div class="feature-num">02</div>
                    <div class="feature-title">Career Board</div>
                    <p class="feature-desc">Access exclusive job postings, internships, and referrals shared within the trusted alumni network.</p>
                </div>
                <div class="feature-item">
                    <div class="feature-num">03</div>
                    <div class="feature-title">Events & Reunions</div>
                    <p class="feature-desc">Stay updated on institutional news, grand reunions, seminars, and local chapter meetups near you.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section id="benefits" class="cta-section">
        <div class="cta-box">
            <div>
                <h2 class="cta-heading">Ready to reconnect with <em>your network?</em></h2>
                <p class="cta-desc">Create your profile, get verified by administration, and unlock thousands of meaningful connections — instantly.</p>
            </div>
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="cta-btn">
                    Create Profile
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </a>
            @endif
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="footer-inner">
            <a href="/" class="logo">
                <div class="logo-mark">A</div>
                <div class="logo-text">Alumni<span>Portal</span></div>
            </a>
            <ul class="footer-links">
                <li><a href="#">About</a></li>
                <li><a href="#">Privacy</a></li>
                <li><a href="#">Terms</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
            <div class="footer-copy">&copy; {{ date('Y') }} University Alumni System.</div>
        </div>
    </footer>

</body>
</html>