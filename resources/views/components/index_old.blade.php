<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ministry of Gender, Culture &amp; Children Services</title>
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700;800&family=Playfair+Display:ital,wght@0,700;0,900;1,700;1,900&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Barlow', sans-serif;
            background: #f0f0f0;
            min-height: 100vh;
        }

        :root {
            --red:    #B50000;
            --green:  #006300;
            --purple: #4a0066;
            --white:  #ffffff;
            --bg:     #fdfdfd;
            --border: #e2e2e2;
            --exit:   #cc0000;
            --wa:     #25D366;
            --t:      0.22s ease;
        }

        /* ── Top bar ── */
        .topbar {
            width: 100%;
            background: var(--bg);
            box-shadow: 0 2px 12px rgba(0,0,0,0.1);
            font-family: 'Barlow', sans-serif;
            position: fixed;
        }

        /* Kenya flag strip */
        .flag-strip { display: flex; height: 5px; }
        .flag-strip span:nth-child(1) { flex:1; background: var(--red); }
        .flag-strip span:nth-child(2) { flex:0 0 5px; background: #000000; }
        .flag-strip span:nth-child(3) { flex:1; background: var(--green); }
        .flag-strip span:nth-child(4) { flex:0 0 5px; background: #000000; }
        .flag-strip span:nth-child(5) { flex:1; background: var(--red); }

        /* Inner */
        .topbar-inner {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            min-height: 64px;
        }

        /* ── Brand ── */
        .brand {
            display: flex;
            align-items: center;
            gap: 0;
            padding: 0;
            margin: 0;
            text-decoration: none;
            flex-shrink: 0;
        }

        .logo-img {
            height: 56px;
            width: auto;
            display: block;
            padding: 0;
            margin: 0;
            border: none;
            flex-shrink: 0;
            transition: transform var(--t);
        }

        .brand:hover .logo-img {
            height: 56px;
            width: auto;
            display: block;
            padding: 0;
            margin: 0;
            border: none;
            flex-shrink: 0;
            transition: transform var(--t);
        }

        /* ── Actions ── */
        .actions {
            display: flex; align-items: center;
            gap: 1.2rem; flex-shrink: 0;
        }

        /* WhatsApp */
        .wa-link {
            display: flex; flex-direction: column;
            align-items: flex-end; gap: 0.18rem;
            text-decoration: none;
            padding: 0.35rem 0.6rem;
            border-radius: 0.45rem;
            transition: background var(--t);
        }

        .wa-link:hover { background: rgba(37,211,102,0.08); }

        .wa-label {
            font-size: 0.69rem; font-weight: 500;
            color: #555; letter-spacing: 0.01rem;
        }

        .wa-number {
            display: flex; align-items: center; gap: 0.45rem;
            font-size: 0.95rem; font-weight: 700;
            color: var(--wa); letter-spacing: 0.02rem;
            transition: color var(--t);
        }

        .wa-link:hover .wa-number { color: #1da851; }

        .wa-icon { width: 22px; height: 22px; flex-shrink: 0; }

        /* Divider */
        .divider {
            width: 1px; height: 38px;
            background: var(--border); flex-shrink: 0;
        }

        /* Quick Exit */
        .btn-exit {
            display: inline-flex; align-items: center; gap: 0.5rem;
            padding: 0.58rem 1.35rem;
            background: var(--exit); color: #fff;
            font-family: 'Barlow', sans-serif;
            font-size: 0.9rem; font-weight: 700;
            letter-spacing: 0.05rem; text-transform: uppercase;
            border: none; border-radius: 0.35rem;
            cursor: pointer; position: relative; overflow: hidden;
            transition: background var(--t), transform var(--t), box-shadow var(--t);
            box-shadow: 0 3px 10px rgba(204,0,0,0.35);
            white-space: nowrap;
        }

        .btn-exit::after {
            content: '';
            position: absolute; top: 0; left: -75%;
            width: 50%; height: 100%;
            background: linear-gradient(to right, transparent, rgba(255,255,255,0.3), transparent);
            transform: skewX(-20deg);
            transition: left 0.45s ease;
        }

        .btn-exit:hover::after { left: 150%; }
        .btn-exit:hover { background: #a00000; transform: translateY(-1px); box-shadow: 0 5px 16px rgba(204,0,0,0.45); }
        .btn-exit:active { transform: translateY(0); }

        .exit-icon { width: 15px; height: 15px; flex-shrink: 0; }

        /* ── Mobile toggle ── */
        .mob-toggle {
            display: none; background: none;
            border: 1px solid var(--border); cursor: pointer;
            padding: 0.4rem 0.5rem; border-radius: 0.35rem;
            transition: background var(--t); flex-shrink: 0;
            align-items: center; justify-content: center;
        }

        .mob-toggle:hover { background: rgba(0,0,0,0.05); }
        .mob-toggle svg { width: 20px; height: 20px; display:block; color:#444; }

        /* Mobile drawer */
        .mob-drawer {
            display: none; background: #f8f8f7;
            border-top: 1px solid var(--border);
            padding: 0.9rem 1.5rem;
            flex-direction: column; gap: 0.9rem;
        }

        .mob-drawer.open { display: flex; }
        .mob-drawer .wa-link { align-items: flex-start; }
        .mob-drawer .btn-exit { width: 100%; justify-content: center; }

        /* ── Responsive ── */
        @media (max-width: 900px) {
            .topbar-inner {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            min-height: 64px;
        }
            .logo-img {
            height: 56px;
            width: auto;
            display: block;
            padding: 0;
            margin: 0;
            border: none;
            flex-shrink: 0;
            transition: transform var(--t);
        }
            .wa-number { font-size: 0.84rem; }
            .btn-exit { padding: 0.5rem 1rem; font-size: 0.82rem; }
        }

        @media (max-width: 640px) {
            .actions { display: none; }
            .mob-toggle { display: flex; }
            .topbar-inner {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            min-height: 64px;
        }
            .logo-img {
            height: 56px;
            width: auto;
            display: block;
            padding: 0;
            margin: 0;
            border: none;
            flex-shrink: 0;
            transition: transform var(--t);
        }
        }

        @media (max-width: 380px) {
            .brand {
            display: flex;
            align-items: center;
            gap: 0;
            padding: 0;
            margin: 0;
            text-decoration: none;
            flex-shrink: 0;
        }
        }

        @media print {
            .btn-exit, .mob-toggle, .mob-drawer { display: none !important; }
        }

        /* ── Report Abuse Button ── */
        .btn-report {
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            padding: 0.55rem 1.2rem;
            background: #C8A2C8;
            color: #1A1022;
            font-family: 'Barlow', sans-serif;
            font-size: 0.88rem;
            font-weight: 700;
            letter-spacing: 0.04rem;
            text-transform: uppercase;
            border: 2px solid #C8A2C8;
            border-radius: 0.4rem;
            cursor: pointer;
            text-decoration: none;
            position: relative;
            overflow: hidden;
            white-space: nowrap;
            transition: color 0.3s ease, background 0.3s ease, border-color 0.3s ease, box-shadow 0.3s ease, transform 0.2s ease;
            animation: report-flicker 3s ease-in-out infinite;
        }

        /* Shimmer sweep */
        .btn-report::before {
            content: '';
            position: absolute;
            top: 0; left: -80%;
            width: 60%; height: 100%;
            background: linear-gradient(to right, transparent, rgba(255,255,255,0.35), transparent);
            transform: skewX(-18deg);
            animation: report-sweep 3s ease-in-out infinite;
        }

        .btn-report:hover {
            background: #25D366;
            color: #ffffff;
            border-color: #25D366;
            box-shadow: 0 0 18px rgba(37,211,102,0.55), 0 4px 14px rgba(37,211,102,0.3);
            transform: translateY(-1px);
            animation: none;
        }

        .btn-report:hover::before { display: none; }

        .btn-report .report-icon {
            width: 14px; height: 14px; flex-shrink: 0;
            transition: transform 0.2s ease;
        }

        .btn-report:hover .report-icon { transform: scale(1.15); }

        /* Flicker: lilac glow pulses */
        @keyframes report-flicker {
            0%   { box-shadow: 0 0 4px rgba(200,162,200,0.3); border-color: #C8A2C8; background: #C8A2C8; }
            18%  { box-shadow: 0 0 14px rgba(200,162,200,0.85), 0 0 28px rgba(200,162,200,0.4); border-color: #e4cbe4; background: #d9b8d9; }
            20%  { box-shadow: 0 0 3px rgba(200,162,200,0.15); border-color: #9E6FA0; background: #b88ab8; }
            38%  { box-shadow: 0 0 16px rgba(200,162,200,0.9), 0 0 32px rgba(200,162,200,0.45); border-color: #e4cbe4; background: #d9b8d9; }
            40%  { box-shadow: 0 0 3px rgba(200,162,200,0.15); border-color: #9E6FA0; background: #b88ab8; }
            65%  { box-shadow: 0 0 8px rgba(200,162,200,0.5); border-color: #C8A2C8; background: #C8A2C8; }
            100% { box-shadow: 0 0 4px rgba(200,162,200,0.3); border-color: #C8A2C8; background: #C8A2C8; }
        }

        /* Shimmer sweep animation */
        @keyframes report-sweep {
            0%   { left: -80%; opacity: 0; }
            30%  { opacity: 1; }
            55%  { left: 130%; opacity: 0; }
            100% { left: 130%; opacity: 0; }
        }

        /* Mobile drawer report button */
        .mob-drawer .btn-report {
            width: 100%;
            justify-content: center;
            font-size: 0.9rem;
        }

        /* ── Demo section ── */
        .demo {
            max-width: 860px; margin: 3rem auto;
            padding: 0 1.5rem; text-align: center;
            font-family: 'Barlow', sans-serif;
        }

        .demo h2 { font-size: 1.5rem; color:#333; margin-bottom:.6rem; }
        .demo p  { font-size: .88rem; color:#777; line-height:1.7; }

        .demo-note {
            display: inline-block; margin-top: 1.5rem;
            background: #fff; border: 1px solid #ddd;
            border-radius: .5rem; padding: .6rem 1.2rem;
            font-size: .73rem; color:#555; letter-spacing:.02rem;
        }

        .demo-note strong { color: var(--purple); }
        /* ══════════════════════════════════════
           WHAT WE DO SECTION
        ══════════════════════════════════════ */
        .wwd-section {
            width: 100%;
            padding: 4.5rem 2rem 5rem;
            background: #ffffff;
        }

        .wwd-inner {
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Section heading */
        .wwd-heading {
            text-align: center;
            margin-bottom: 3rem;
        }

        .wwd-heading h2 {
            font-family: 'Barlow', sans-serif;
            font-size: 2.6rem;
            font-weight: 800;
            color: #C8A2C8;
            letter-spacing: -0.03rem;
            line-height: 1.15;
        }

        /* Cards grid */
        .wwd-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
        }

        /* Individual card */
        .wwd-card {
            background: #ffffff;
            border-radius: 1rem;
            box-shadow: 0 2px 18px rgba(0,0,0,0.07);
            overflow: hidden;
            transition: transform 0.28s ease, box-shadow 0.28s ease;
            display: flex;
            flex-direction: column;
            position: relative;
        }

        .wwd-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 36px rgba(0,0,0,0.13);
        }

        /* Coloured banner at top of card */
        .wwd-card__banner {
            width: 100%;
            height: 140px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
            flex-shrink: 0;
        }

        .wwd-card__banner--safety {
            background: linear-gradient(135deg, #1e8ef0 0%, #0fcaa8 100%);
        }

        .wwd-card__banner--tfgbv {
            background: linear-gradient(135deg, #7b2ff7 0%, #f107a3 100%);
        }

        .wwd-card__banner--tech {
            background: linear-gradient(135deg, #9b6dbd 0%, #C8A2C8 100%);
        }

        /* Soft glow circle behind icon */
        .wwd-card__banner::before {
            content: '';
            position: absolute;
            width: 110px;
            height: 110px;
            border-radius: 50%;
            background: rgba(255,255,255,0.12);
            pointer-events: none;
        }

        .wwd-card__icon {
            font-size: 3rem;
            position: relative;
            z-index: 1;
            line-height: 1;
            filter: drop-shadow(0 2px 8px rgba(0,0,0,0.18));
        }

        /* Card body */
        .wwd-card__body {
            padding: 1.5rem 1.5rem 1.75rem;
            flex: 1;
        }

        .wwd-card__title {
            font-family: 'Barlow', sans-serif;
            font-size: 1.1rem;
            font-weight: 800;
            color: #1a1a2e;
            margin-bottom: 0.85rem;
            line-height: 1.3;
        }

        .wwd-card__desc {
            font-family: 'Barlow', sans-serif;
            font-size: 0.9rem;
            color: #4a4a6a;
            line-height: 1.75;
        }

        /* Tablet */
        @media (max-width: 900px) {
            .wwd-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        /* Mobile */
        @media (max-width: 560px) {
            .wwd-section {
                padding: 3rem 1.25rem 3.5rem;
            }

            .wwd-heading h2 {
                font-size: 1.9rem;
            }

            .wwd-grid {
                grid-template-columns: 1fr;
            }

            .wwd-card__banner {
                height: 120px;
            }
        }

        /* ══════════════════════════════════════
           ABOUT US SECTION
        ══════════════════════════════════════ */
        .about-section {
            width: 100%;
            background: #ffffff;
            padding: 5rem 2rem;
            border-top: 1px solid #f0eaf8;
        }

        .about-inner {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
        }

        /* ── Left: Image with badge ── */
        .about-img-wrap {
            position: relative;
            flex-shrink: 0;
        }

        .about-img-placeholder {
            width: 100%;
            border-radius: 1.2rem;
            background: linear-gradient(135deg, #f3edfb 0%, #e8daf5 100%);
            box-shadow: 0 8px 36px rgba(150, 100, 180, 0.18);
            aspect-ratio: 4 / 3;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .placeholder-inner {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.75rem;
        }

        .placeholder-inner svg {
            width: 96px;
            height: 96px;
            opacity: 0.8;
        }

        .placeholder-inner p {
            font-size: 0.85rem;
            font-weight: 600;
            color: #C8A2C8;
            letter-spacing: 0.05rem;
            text-transform: uppercase;
            margin: 0;
        }

        /* Floating badge at bottom-right of image */
        .about-badge {
            position: absolute;
            bottom: -1px;
            right: 1.5rem;
            background: #ffffff;
            border-radius: 0.75rem;
            padding: 0.85rem 1.2rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            box-shadow: 0 6px 24px rgba(150, 100, 180, 0.22);
            min-width: 210px;
            border-bottom: 3px solid #C8A2C8;
        }

        .about-badge__icon {
            width: 38px;
            height: 38px;
            background: linear-gradient(135deg, #C8A2C8, #9b6dbd);
            border-radius: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 1.2rem;
        }

        .about-badge__text strong {
            display: block;
            font-size: 0.82rem;
            font-weight: 700;
            color: #1a1a2e;
            white-space: nowrap;
        }

        .about-badge__text span {
            font-size: 0.72rem;
            color: #7a7a9a;
            white-space: nowrap;
        }

        /* ── Right: Text content ── */
        .about-content {}

        .about-content h2 {
            font-family: 'Barlow', sans-serif;
            font-size: 2.6rem;
            font-weight: 800;
            color: #C8A2C8;
            margin-bottom: 1.5rem;
            line-height: 1.15;
        }

        .about-content p {
            font-family: 'Barlow', sans-serif;
            font-size: 0.97rem;
            color: #3a3a5a;
            line-height: 1.8;
            margin-bottom: 1.1rem;
        }

        .about-content p:last-child {
            margin-bottom: 0;
        }

        /* ── Responsive ── */
        @media (max-width: 860px) {
            .about-inner {
                grid-template-columns: 1fr;
                gap: 2.5rem;
            }

            .about-content h2 {
                font-size: 2rem;
            }

            .about-badge {
                right: 1rem;
                min-width: 180px;
            }
        }

        @media (max-width: 560px) {
            .about-section {
                padding: 3rem 1.25rem;
            }

            .about-content h2 {
                font-size: 1.8rem;
            }

            .about-badge {
                right: 0.75rem;
                padding: 0.65rem 0.9rem;
                min-width: 160px;
            }

            /* ===== MISSION SECTION ===== */
        .mission {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: var(--white);
            padding: 80px 0;
        }

        .mission-content {
            text-align: center;
            max-width: 800px;
            margin: 0 auto;
        }

        .mission-content h2 {
            font-size: 2.5rem;
            margin-bottom: 30px;
        }

        .mission-content p {
            font-size: 1.2rem;
            line-height: 1.8;
            opacity: 0.95;
        }
        }
    </style>
</head>
<body class="relative">
<div class="z-[1111]">
    @include('components.home.header')
</div>
<!-- ══════════════════════════════════════
     WHAT WE DO SECTION
══════════════════════════════════════ -->
<section class="wwd-section" aria-labelledby="wwd-title">

    <div class="wwd-inner">

        <div class="wwd-heading">
            <h2 id="wwd-title">What We Do</h2>
        </div>

        <div class="wwd-grid">

            <!-- Card 1: Digital Safety -->
            <article class="wwd-card">
                <div class="wwd-card__banner wwd-card__banner--safety" aria-hidden="true">
                    <span class="wwd-card__icon">🛡️</span>
                </div>
                <div class="wwd-card__body">
                    <h3 class="wwd-card__title">Digital Safety and Awareness</h3>
                    <p class="wwd-card__desc">
                        Strengthen digital safety for online users. To provide referral pathways for people experiencing people experiencing online abuse to relevant services that are within their reach.
                    </p>
                </div>
            </article>

            <!-- Card 2: TFGBV -->
            <article class="wwd-card">
                <div class="wwd-card__banner wwd-card__banner--tfgbv" aria-hidden="true">
                    <span class="wwd-card__icon">💜</span>
                </div>
                <div class="wwd-card__body">
                    <h3 class="wwd-card__title">TFGBV Reporting and Support</h3>
                    <p class="wwd-card__desc">
                        To Strengthen survivor cent reporting and referral system. Provide survivors with a timely, holistic and dignified support that prioritises their right, safety and recovery. Ensuring survivors are immediately connected to essential services
                    </p>
                </div>
            </article>

            <!-- Card 3: Innovation -->
            <article class="wwd-card">
                <div class="wwd-card__banner wwd-card__banner--tech" aria-hidden="true">
                    <span class="wwd-card__icon">🚀</span>
                </div>
                <div class="wwd-card__body">
                    <h3 class="wwd-card__title">Innovation and Technology</h3>
                    <p class="wwd-card__desc">
                        We believe technology can be a force for good. That's why we support victims in developing digital solutions that promote safety, inclusivity,
                        and justice. We teach report, and create awareness on digital literacy to bridge
                        the digital divide.
                    </p>
                </div>
            </article>

        </div><!-- /.wwd-grid -->
    </div><!-- /.wwd-inner -->

</section>

{{--Added reporting section--}}
<section class="my-50 bg-green-300">
    <a href="{{route('report')}}"  class="h-30 flex flex-col py-8 bg-primary">
        <span style="align-self: center; width: fit-content; inset: auto; margin: auto; text-align:center; background:var(--red); color: white; padding: 20px; font-size: medium; font-weight: bold; border-radius: 5px; text-wrap: nowrap;">Click to here report abuse</span>
    </a>
</section>



<!-- ══════════════════════════════════════
     ABOUT US SECTION
══════════════════════════════════════ -->
<section class="about-section" aria-labelledby="about-title">
    <div class="about-inner">

        <!-- LEFT: Photo placeholder + floating badge -->
        <div class="about-img-wrap">
            <div class="about-img-placeholder" aria-label="">
                <div class="placeholder-inner">
                    <svg viewBox="0 0 80 80" fill="none" aria-hidden="true">
                        <rect width="80" height="80" rx="8" fill="rgba(200,162,200,0.15)"/>
                        <circle cx="40" cy="28" r="14" fill="rgba(200,162,200,0.5)"/>
                        <path d="M10 72 C10 52 70 52 70 72" fill="rgba(200,162,200,0.5)"/>
                        <circle cx="20" cy="32" r="9" fill="rgba(200,162,200,0.35)"/>
                        <path d="M2 72 C2 56 38 56 38 72" fill="rgba(200,162,200,0.35)"/>
                        <circle cx="60" cy="32" r="9" fill="rgba(200,162,200,0.35)"/>
                        <path d="M42 72 C42 56 78 56 78 72" fill="rgba(200,162,200,0.35)"/>
                    </svg>
                    <p></p>
                </div>
            </div>
            <div class="about-badge">
                <div class="about-badge__icon">✦</div>
                <div class="about-badge__text">
                    <strong>Supporting Communities</strong>
                    <span>Inclusive digital empowerment</span>
                </div>
            </div>
        </div>

        <!-- RIGHT: Text -->
        <div class="about-content">
            <h2 id="about-title">About Us</h2>
            <p style="text-align: justify;">As digital spaces continue to grow, so do the risks of online harassment, cyberstalking, non-consensual sharing of intimate images, online exploitation, and other forms of digital abuse that disproportionately affect individuals of all genders. We are therefore a dedicated platform committed to raising awareness, preventing, and responding to Technology-Facilitated Gender-Based Violence (TFGBV).</p>
            <p></p>
            <p></p>
        </div>
        </div>

    </div>
</section>

<section>
    <div style="
    width: 100%;
    background: linear-gradient(135deg, #c6a3c8, #b690c2);
    padding: 80px 20px;
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
    box-sizing: border-box;
">
    <div style="max-width: 900px;">
        <h2 style="
            font-size: 36px;
            font-weight: 700;
            margin-bottom: 25px;
            color: white;
        ">
            Our Mission
        </h2>

        <p style="
            font-size: 18px;
            line-height: 1.8;
            color: #f2f2f2;
            margin: 0 auto;
        ">
            To provide a secure, confidential and survivor centered platform for reporting, preventing and responding to Technology Facilitated Gender Based Violence. To ensure that all individual can enjoy the benefits of technologies without fear of violence and protecting digital rights.

        </p>
    </div>
</div>
</section>


<!-- ══════════════════════════════════════
     JOIN US SECTION
══════════════════════════════════════ -->
<style>
  /* ── JOIN US ── */
  .join-section {
    position: relative;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    padding: 6rem 1.5rem;
    overflow: hidden;
    background: #1A1022;
  }
  .join-section::before {
    content: '';
    position: absolute;
    inset: 0;
    background:
      radial-gradient(ellipse 80% 60% at 20% 30%, rgba(200,162,200,0.35) 0%, transparent 60%),
      radial-gradient(ellipse 60% 70% at 80% 70%, rgba(107,62,114,0.45) 0%, transparent 55%),
      radial-gradient(ellipse 100% 80% at 50% 50%, rgba(26,16,34,1) 0%, transparent 100%);
    z-index: 0;
  }
  .join-orb {
    position: absolute;
    border-radius: 50%;
    filter: blur(60px);
    opacity: 0.25;
    animation: join-drift 12s ease-in-out infinite alternate;
    z-index: 0;
  }
  .join-orb-1 { width: 420px; height: 420px; background: #C8A2C8; top: -80px; left: -100px; animation-duration: 14s; }
  .join-orb-2 { width: 300px; height: 300px; background: #6B3E72; bottom: 0; right: -80px; animation-duration: 10s; animation-delay: -4s; }
  .join-orb-3 { width: 200px; height: 200px; background: #E4CBE4; top: 40%; left: 55%; animation-duration: 18s; animation-delay: -7s; }
  @keyframes join-drift {
    from { transform: translate(0, 0) scale(1); }
    to   { transform: translate(30px, 20px) scale(1.08); }
  }
  .join-grain {
    position: absolute; inset: 0;
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.04'/%3E%3C/svg%3E");
    opacity: 0.5; pointer-events: none; z-index: 1;
  }
  .join-content {
    position: relative; z-index: 2;
    max-width: 760px; margin: 0 auto;
  }
  .join-eyebrow {
    display: inline-block;
    font-size: 0.75rem; font-weight: 500;
    letter-spacing: 0.25em; text-transform: uppercase;
    color: #C8A2C8;
    border: 1px solid rgba(200,162,200,0.4);
    padding: 0.35rem 1rem; border-radius: 100px;
    margin-bottom: 2rem;
    backdrop-filter: blur(8px);
    background: rgba(200,162,200,0.08);
    animation: join-fadeUp 0.7s ease both;
  }
  .join-title {
    font-family: 'Playfair Display', serif;
    font-size: clamp(2.4rem, 6vw, 4.2rem);
    font-weight: 900; line-height: 1.1;
    color: #ffffff; margin-bottom: 1.5rem;
    animation: join-fadeUp 0.7s 0.1s ease both;
  }
  .join-title span { color: #C8A2C8; font-style: italic; }
  .join-body {
    font-family: 'DM Sans', sans-serif;
    font-size: clamp(1rem, 2vw, 1.15rem);
    font-weight: 300; line-height: 1.75;
    color: rgba(255,255,255,0.72);
    max-width: 580px; margin: 0 auto 2.8rem;
    animation: join-fadeUp 0.7s 0.2s ease both;
  }
  .join-btn {
    display: inline-flex; align-items: center; gap: 0.6rem;
    background: #C8A2C8; color: #1A1022;
    font-family: 'DM Sans', sans-serif;
    font-weight: 500; font-size: 1rem;
    padding: 0.9rem 2.2rem; border-radius: 100px;
    border: none; cursor: pointer;
    text-decoration: none; letter-spacing: 0.02em;
    position: relative; overflow: hidden;
    transition: background 0.35s ease, color 0.35s ease, transform 0.2s ease, box-shadow 0.35s ease;
    animation: join-fadeUp 0.7s 0.3s ease both;
    box-shadow: 0 0 0 0 rgba(200,162,200,0);
  }
  .join-btn::after {
    content: ''; position: absolute; inset: 0;
    background: linear-gradient(135deg, rgba(255,255,255,0.25) 0%, transparent 60%);
    opacity: 0; transition: opacity 0.3s;
  }
  .join-btn:hover {
    background: #6B3E72; color: #ffffff;
    transform: translateY(-3px);
    box-shadow: 0 12px 36px rgba(200,162,200,0.35);
  }
  .join-btn:hover::after { opacity: 1; }
  .join-btn svg { transition: transform 0.3s ease; }
  .join-btn:hover svg { transform: translateX(4px); }
  @keyframes join-fadeUp {
    from { opacity: 0; transform: translateY(24px); }
    to   { opacity: 1; transform: translateY(0); }
  }
  .join-stats {
    position: relative; z-index: 2;
    display: flex; justify-content: center;
    gap: 3rem; flex-wrap: wrap;
    margin-top: 4rem; padding-top: 3rem;
    border-top: 1px solid rgba(200,162,200,0.15);
    animation: join-fadeUp 0.7s 0.45s ease both;
  }
  .join-stat { text-align: center; }
  .join-stat-num {
    font-family: 'Playfair Display', serif;
    font-size: 2rem; font-weight: 700; color: #C8A2C8;
  }
  .join-stat-label {
    font-size: 0.8rem; font-weight: 300;
    color: rgba(255,255,255,0.5);
    letter-spacing: 0.08em; text-transform: uppercase; margin-top: 0.25rem;
  }

  /* ── FOOTER ── */
  .sm-footer {
    background: #0D0813;
    border-top: 1px solid rgba(200,162,200,0.12);
    padding: 4rem 1.5rem 2rem;
    font-family: 'DM Sans', sans-serif;
  }
  .sm-footer-inner { max-width: 1200px; margin: 0 auto; }
  .sm-footer-top {
    display: grid;
    grid-template-columns: 1.6fr repeat(3, 1fr);
    gap: 3rem; margin-bottom: 3rem;
  }
  @media (max-width: 900px) { .sm-footer-top { grid-template-columns: 1fr 1fr; } }
  @media (max-width: 560px) { .sm-footer-top { grid-template-columns: 1fr; gap: 2rem; } }
  .sm-brand-logo {
    display: flex; align-items: center; gap: 0.7rem;
    margin-bottom: 1rem; text-decoration: none;
  }
  .sm-brand-icon {
    width: 42px; height: 42px;
    background: linear-gradient(135deg, #6B3E72, #C8A2C8);
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
  }
  .sm-brand-icon svg { width: 22px; height: 22px; }
  .sm-brand-name {
    font-family: 'Playfair Display', serif;
    font-size: 1.15rem; font-weight: 700;
    color: #ffffff; line-height: 1.2;
  }
  .sm-brand-name small {
    display: block; font-family: 'DM Sans', sans-serif;
    font-size: 0.65rem; font-weight: 300;
    letter-spacing: 0.15em; color: #C8A2C8;
    text-transform: uppercase;
  }
  .sm-footer-tagline {
    font-size: 0.88rem; font-weight: 300;
    color: rgba(255,255,255,0.5); line-height: 1.7;
    margin-bottom: 1.5rem; max-width: 260px;
  }
  .sm-emergency-badge {
    display: inline-flex; align-items: center; gap: 0.55rem;
    background: #cc2222;
    border: none;
    border-radius: 6px; padding: 0.6rem 1.1rem;
    font-size: 0.88rem; font-weight: 600;
    color: #ffffff;
    cursor: pointer; text-decoration: none;
    letter-spacing: 0.01em;
    box-shadow: 0 3px 12px rgba(204,34,34,0.45);
    transition: background 0.2s, transform 0.2s, box-shadow 0.2s;
  }
  .sm-emergency-badge:hover {
    background: #aa1a1a;
    transform: translateY(-1px);
    box-shadow: 0 6px 18px rgba(204,34,34,0.55);
  }
  .sm-emergency-badge .sm-emergency-dot { display: none; }
  .sm-col-title {
    font-size: 0.75rem; font-weight: 500;
    letter-spacing: 0.18em; text-transform: uppercase;
    color: #C8A2C8; margin-bottom: 1.2rem;
  }
  .sm-footer-links { list-style: none; display: flex; flex-direction: column; gap: 0.7rem; }
  .sm-footer-links a {
    text-decoration: none; font-size: 0.9rem; font-weight: 300;
    color: rgba(255,255,255,0.55);
    transition: color 0.2s, padding-left 0.2s; display: inline-block;
  }
  .sm-footer-links a:hover { color: #E4CBE4; padding-left: 4px; }
  .sm-footer-divider {
    border: none; border-top: 1px solid rgba(200,162,200,0.1); margin: 0 0 1.8rem;
  }
  .sm-footer-bottom {
    display: flex; align-items: center;
    justify-content: space-between; flex-wrap: wrap; gap: 1rem;
  }
  .sm-footer-copy { font-size: 0.8rem; color: rgba(255,255,255,0.3); }
  .sm-social-links { display: flex; gap: 0.75rem; }
  .sm-social-btn {
    width: 36px; height: 36px; border-radius: 50%;
    border: 1px solid rgba(200,162,200,0.2);
    display: flex; align-items: center; justify-content: center;
    transition: background 0.25s, border-color 0.25s, transform 0.2s;
    color: rgba(255,255,255,0.5); text-decoration: none;
  }
  .sm-social-btn:hover {
    background: rgba(200,162,200,0.15); border-color: #C8A2C8;
    color: #C8A2C8; transform: translateY(-2px);
  }
  .sm-social-btn svg { width: 15px; height: 15px; }
  .sm-footer-legal { display: flex; gap: 1.2rem; flex-wrap: wrap; }
  .sm-footer-legal a {
    font-size: 0.78rem; color: rgba(255,255,255,0.3);
    text-decoration: none; transition: color 0.2s;
  }
  .sm-footer-legal a:hover { color: #C8A2C8; }
</style>

<section class="join-section" aria-label="Join Us">
  <div class="join-orb join-orb-1"></div>
  <div class="join-orb join-orb-2"></div>
  <div class="join-orb join-orb-3"></div>
  <div class="join-grain"></div>
  <div class="join-content">
    <span class="join-eyebrow">🛡 Collective Action</span>
    <h1 class="join-title">Join Us in Making<br>a <span>Difference</span></h1>
    <p class="join-body">
      At State Department for Gender and Affirmative Action, we believe in the power of collective action. Together, we create safer and more inclusive digital spaces for everyone. Get involved today to help fight Technology-Facilitated Gender-Based Violence and advocate for the rights of marginalized communities online.
    </p>
    <a href="#" class="join-btn">
      Get Involved
      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
        <line x1="5" y1="12" x2="19" y2="12"/>
        <polyline points="12 5 19 12 12 19"/>
      </svg>
    </a>
    <div class="join-stats">
      <div class="join-stat">
        <div class="join-stat-num" data-target="12000">0</div>
        <div class="join-stat-label">Community Members</div>
      </div>
      <div class="join-stat">
        <div class="join-stat-num" data-target="4200">0</div>
        <div class="join-stat-label">Cases Supported</div>
      </div>
      <div class="join-stat">
        <div class="join-stat-num" data-target="30">0</div>
        <div class="join-stat-label">Countries Reached</div>
      </div>
    </div>
  </div>
</section>

<!-- ══════════════════════════════════════
     FAQ SECTION
══════════════════════════════════════ -->
<style>
  .faq-section {
    background: #f5eef8;
    padding: 5rem 1.5rem;
  }
  .faq-inner {
    max-width: 800px;
    margin: 0 auto;
  }
  .faq-heading {
    text-align: center;
    margin-bottom: 3rem;
  }
  .faq-heading h2 {
    font-family: 'Playfair Display', serif;
    font-size: clamp(2rem, 5vw, 3rem);
    font-weight: 900;
    color: #6B3E72;
    line-height: 1.15;
    margin-bottom: 0.75rem;
  }
  .faq-heading p {
    font-family: 'DM Sans', sans-serif;
    font-size: 1rem;
    color: #7a6080;
    font-weight: 300;
  }
  .faq-list {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
  }
  .faq-item {
    background: #ffffff;
    border-radius: 0.85rem;
    border: 1px solid rgba(200,162,200,0.25);
    overflow: hidden;
    transition: box-shadow 0.25s ease;
  }
  .faq-item:hover {
    box-shadow: 0 6px 24px rgba(107,62,114,0.1);
  }
  .faq-item.open {
    border-color: #C8A2C8;
    box-shadow: 0 6px 24px rgba(107,62,114,0.12);
  }
  .faq-question {
    width: 100%;
    background: none;
    border: none;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
    padding: 1.25rem 1.5rem;
    text-align: left;
    font-family: 'Barlow', sans-serif;
    font-size: 1rem;
    font-weight: 600;
    color: #1a1a2e;
    transition: color 0.2s;
  }
  .faq-item.open .faq-question {
    color: #6B3E72;
  }
  .faq-icon {
    flex-shrink: 0;
    width: 28px; height: 28px;
    border-radius: 50%;
    background: #f5eef8;
    display: flex; align-items: center; justify-content: center;
    transition: background 0.25s, transform 0.3s ease;
  }
  .faq-item.open .faq-icon {
    background: #C8A2C8;
    transform: rotate(45deg);
  }
  .faq-icon svg {
    width: 14px; height: 14px;
    stroke: #6B3E72;
    transition: stroke 0.25s;
  }
  .faq-item.open .faq-icon svg { stroke: #fff; }
  .faq-answer {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.4s ease, padding 0.3s ease;
  }
  .faq-answer-inner {
    padding: 0 1.5rem 1.4rem;
    font-family: 'DM Sans', sans-serif;
    font-size: 0.93rem;
    font-weight: 300;
    color: #4a4a6a;
    line-height: 1.8;
  }
  .faq-item.open .faq-answer {
    max-height: 500px;
  }
  @media (max-width: 560px) {
    .faq-section { padding: 3.5rem 1.25rem; }
    .faq-question { font-size: 0.93rem; padding: 1rem 1.2rem; }
    .faq-answer-inner { padding: 0 1.2rem 1.2rem; }
  }
</style>

<section class="faq-section" aria-labelledby="faq-title">
  <div class="faq-inner">
    <div class="faq-heading">
      <h2 id="faq-title">Frequently Asked Questions</h2>
      <p>Everything you need to know about our work and how to get help.</p>
    </div>

    <div class="faq-list" role="list">

      <div class="faq-item" role="listitem">
        <button class="faq-question" aria-expanded="false">
          What is Technology-Facilitated Gender-Based Violence (TFGBV)?
          <span class="faq-icon" aria-hidden="true">
            <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
          </span>
        </button>
        <div class="faq-answer">
          <div class="faq-answer-inner">
            TFGBV Refers to an act of violence committed through digital technologies e.g mobile phones, social media etc
          </div>
        </div>
      </div>

      <div class="faq-item" role="listitem">
        <button class="faq-question" aria-expanded="false">
          What are the common examples of TFGBV
          <span class="faq-icon" aria-hidden="true">
            <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
          </span>
        </button>
        <div class="faq-answer">
          <div class="faq-answer-inner">
            Online harassment, cyber bullying, non-consensual sharing of intimate images.
          </div>
        </div>
      </div>

      <div class="faq-item" role="listitem">
        <button class="faq-question" aria-expanded="false">
          Who is most at risk?
          <span class="faq-icon" aria-hidden="true">
            <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
          </span>
        </button>
        <div class="faq-answer">
          <div class="faq-answer-inner">
            Women and girls, female politicians, young people and public figures.
          </div>
        </div>
      </div>

      <div class="faq-item" role="listitem">
        <button class="faq-question" aria-expanded="false">
          How can someone report TFGBV?
          <span class="faq-icon" aria-hidden="true">
            <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
          </span>
        </button>
        <div class="faq-answer">
          <div class="faq-answer-inner">
            A survivor can: report to the national TFGBV reporting system, report to the nearest police station, report directly to the online platform were abuse occurred.
          </div>
        </div>
      </div>

      <div class="faq-item" role="listitem">
        <button class="faq-question" aria-expanded="false">
          Is reporting confidential?
          <span class="faq-icon" aria-hidden="true">
            <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
          </span>
        </button>
        <div class="faq-answer">
          <div class="faq-answer-inner">
            Yes. Reporting mechanisms must: Protect survivor identity, follow data protection law, ensure secure storage of digital evidence.
          </div>
        </div>
      </div>

      <div class="faq-item" role="listitem">
        <button class="faq-question" aria-expanded="false">
          What happens when the user reports?
          <span class="faq-icon" aria-hidden="true">
            <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
          </span>
        </button>
        <div class="faq-answer">
          <div class="faq-answer-inner">
            You will get a follow up call for psychosocial support, counselling and referral for other services.
          </div>
        </div>
      </div>


      <div class="faq-item" role="listitem">
        <button class="faq-question" aria-expanded="false">
          What is the typical response time?
          <span class="faq-icon" aria-hidden="true">
            <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
          </span>
        </button>
        <div class="faq-answer">
          <div class="faq-answer-inner">
            48 Hours.
          </div>
        </div>
      </div>


      <div class="faq-item" role="listitem">
        <button class="faq-question" aria-expanded="false">
          What law address TFGBV in Kenya?
          <span class="faq-icon" aria-hidden="true">
            <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
          </span>
        </button>
        <div class="faq-answer">
          <div class="faq-answer-inner">
            TFGBV falls under existing laws such as computed misuse, data protection act, sexual offences act, PADV Act, children’s act, Penal Code, National Policy of Protection against GBV.
          </div>
        </div>
      </div>


      <div class="faq-item" role="listitem">
        <button class="faq-question" aria-expanded="false">
          What Support services are available to survivors?
          <span class="faq-icon" aria-hidden="true">
            <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
          </span>
        </button>
        <div class="faq-answer">
          <div class="faq-answer-inner">
            Survivors may Access: psychosocial Counselling, Legal assistance, medical services if require, digital safety guidance, shelter services.
          </div>
        </div>
      </div>


      <div class="faq-item" role="listitem">
        <button class="faq-question" aria-expanded="false">
          What should a survivor do immediately after experiencing TFGBV?
          <span class="faq-icon" aria-hidden="true">
            <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
          </span>
        </button>
        <div class="faq-answer">
          <div class="faq-answer-inner">
            <ul>
                <li>Do not delete evidence.</li>
                <li>Take screen shots (Include date and URL).</li>
                <li>Secure accounts- Change password</li>
                <li>Enable 2FA</li>
                <li>Report to the platform</li>
                <li>Report to the authorities</li>
                <li>Seek support services</li>
            </ul>
          </div>
        </div>
      </div>


      <div class="faq-item" role="listitem">
        <button class="faq-question" aria-expanded="false">
          Can TFGBV incidents be prosecuted?
          <span class="faq-icon" aria-hidden="true">
            <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
          </span>
        </button>
        <div class="faq-answer">
          <div class="faq-answer-inner">
            Yes, if sufficient evidence exists. Perpetrators may face fines, imprisonment, civil damaged, platform burns.
          </div>
        </div>
      </div>


      <div class="faq-item" role="listitem">
        <button class="faq-question" aria-expanded="false">
          What roles do online communities play in prevention of TFGBV?
          <span class="faq-icon" aria-hidden="true">
            <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
          </span>
        </button>
        <div class="faq-answer">
          <div class="faq-answer-inner">
            You will get a follow up call for psychosocial support, counselling and referral for other services.
            <ul>
                <li>To come up with clear guidelines</li>
                <li>Restrictions of further forward</li>

            </ul>
          </div>
        </div>
      </div>

    </div><!-- /.faq-list -->
  </div>
</section>

<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script>
  (function () {
    document.querySelectorAll('.faq-question').forEach(function (btn) {
      btn.addEventListener('click', function () {
        var item = btn.closest('.faq-item');
        var isOpen = item.classList.contains('open');
        // Close all
        document.querySelectorAll('.faq-item').forEach(function (el) {
          el.classList.remove('open');
          el.querySelector('.faq-question').setAttribute('aria-expanded', 'false');
        });
        // Toggle clicked
        if (!isOpen) {
          item.classList.add('open');
          btn.setAttribute('aria-expanded', 'true');
        }
      });
    });
  })();
</script>

<footer class="sm-footer" role="contentinfo">
  <div class="sm-footer-inner">
    <div class="sm-footer-top">
      <div>
        <a class="sm-brand-logo" href="#">
          <div class="sm-brand-icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
            </svg>
          </div>
          <div class="sm-brand-name">
            The State Department for Gender and Affirmative action
            <small>Secure Spaces. Safe Lives.</small>
          </div>
        </a>
        <p class="sm-footer-tagline">Dedicated to creating safer digital spaces for everyone, everywhere.</p>
      </div>
      <div>
        <p class="sm-col-title">Resources</p>
        <ul class="sm-footer-links">
          <li><a href="#">Support Services</a></li>
          <li><a href="#">Emergency Contacts</a></li>
          <li><a href="#">Legal Resources</a></li>
          <li><a href="#">Safety Quiz</a></li>
        </ul>
      </div>
      <div>
        <p class="sm-col-title">Organization</p>
        <ul class="sm-footer-links">
          <li><a href="#">What We Do</a></li>
          <li><a href="#">Our Mission</a></li>
          <li><a href="#">Contact Us</a></li>
          <li><a href="#">Report Incident</a></li>
        </ul>
      </div>
      <div>
        <p class="sm-col-title">Legal</p>
        <ul class="sm-footer-links">
          <li><a href="#">Privacy Policy</a></li>
          <li><a href="#">Terms of Service</a></li>
          <li><a href="#">Data Usage</a></li>
          <li><a href="#">Code of Conduct</a></li>
        </ul>
      </div>
    </div>
    <hr class="sm-footer-divider" />
    <div class="sm-footer-bottom">
      <p class="sm-footer-copy">Copyright <script>document.write("&copy; " + new Date().getFullYear());</script>
 The State Department for Gender and Affirmative Action. All rights reserved.</p>
      <div class="sm-footer-legal">
        <a href="#">Privacy Policy</a>
        <a href="#">Terms of Service</a>
        <a href="#">Data Usage</a>
      </div>
      <div class="sm-social-links">
        <a href="tel:1195" class="sm-emergency-badge">
          <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" style="width:15px;height:15px;stroke:#fff;flex-shrink:0;">
            <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81 19.79 19.79 0 01.12 1.18 2 2 0 012.11 0h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/>
          </svg>
          Emergency: 911
        </a>
        <a href="#" class="sm-social-btn" aria-label="Twitter">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
            <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
          </svg>
        </a>
        <a href="#" class="sm-social-btn" aria-label="Instagram">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
            <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/>
            <circle cx="12" cy="12" r="4"/>
            <circle cx="17.5" cy="6.5" r="1" fill="currentColor" stroke="none"/>
          </svg>
        </a>
        <a href="#" class="sm-social-btn" aria-label="LinkedIn">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 0 1-2.063-2.065 2.064 2.064 0 1 1 2.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
          </svg>
        </a>
      </div>
    </div>
  </div>
</footer>

<script>
  /* ── Animated counters ── */
  (function () {
    function animateCount(el) {
      var target = +el.dataset.target;
      var duration = 2000;
      var step = target / (duration / 16);
      var current = 0;
      var timer = setInterval(function () {
        current += step;
        if (current >= target) { current = target; clearInterval(timer); }
        el.textContent = Math.floor(current).toLocaleString() + (target >= 100 ? '+' : '');
      }, 16);
    }
    var counters = document.querySelectorAll('.join-stat-num[data-target]');
    var obs = new IntersectionObserver(function (entries) {
      entries.forEach(function (e) {
        if (e.isIntersecting) { animateCount(e.target); obs.unobserve(e.target); }
      });
    }, { threshold: 0.5 });
    counters.forEach(function (c) { obs.observe(c); });
  })();
</script>
