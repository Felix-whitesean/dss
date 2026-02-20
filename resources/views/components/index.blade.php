<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ministry of Gender, Culture &amp; Children Services</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
Z    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700;800&family=Playfair+Display:ital,wght@0,700;0,900;1,700;1,900&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
    /* ═══════════════════════════════════════════
       RESET — safe for all elements including SVG
    ═══════════════════════════════════════════ */
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    html { scroll-behavior: smooth; overflow-x: hidden; }
    body {
        font-family: 'Barlow', sans-serif;
        background: #f0f0f0;
        min-height: 100vh;
        overflow-x: hidden;
        padding-top: 74px;
        word-break: break-word;
        overflow-wrap: break-word;
    }
    /* Only non-inline images get max-width — NOT svg/iframe which need explicit sizing */
    img { max-width: 100%; height: auto; display: block; }
    ul  { list-style: none; }

    /* ═══════════════════════════════════════════
       TOPBAR
    ═══════════════════════════════════════════ */


    /* ═══════════════════════════════════════════
       WHAT WE DO
    ═══════════════════════════════════════════ */
    .wwd-section {
        width:100%;
        padding: clamp(2rem,5vw,4.5rem) clamp(1rem,4vw,2rem) clamp(2.5rem,6vw,5rem);
        background:#fff;
    }
    .wwd-inner { max-width:1200px; margin:0 auto; }
    .wwd-heading { text-align:center; margin-bottom:clamp(1.2rem,3vw,2.5rem); }
    .wwd-heading h2 {
        font-size:clamp(1.5rem,4vw,2.6rem);
        font-weight:800; color:var(--lilac); line-height:1.15;
    }
    .wwd-grid {
        display:grid;
        grid-template-columns:repeat(3,1fr);
        gap:clamp(1rem,2.5vw,1.5rem);
    }
    .wwd-card {
        background:#fff; border-radius:1rem;
        box-shadow:0 2px 18px rgba(0,0,0,.07);
        overflow:hidden; display:flex; flex-direction:column;
        transition:transform .28s,box-shadow .28s;
    }
    .wwd-card:hover { transform:translateY(-5px); box-shadow:0 12px 36px rgba(0,0,0,.13); }
    .wwd-card__banner {
        width:100%; height:clamp(100px,15vw,140px);
        display:flex; align-items:center; justify-content:center;
        position:relative; overflow:hidden; flex-shrink:0;
    }
    .wwd-card__banner--safety { background:linear-gradient(135deg,#1e8ef0,#0fcaa8); }
    .wwd-card__banner--tfgbv  { background:linear-gradient(135deg,#7b2ff7,#f107a3); }
    .wwd-card__banner--tech   { background:linear-gradient(135deg,#9b6dbd,var(--lilac)); }
    .wwd-card__banner::before {
        content:''; position:absolute;
        width:90px; height:90px; border-radius:50%;
        background:rgba(255,255,255,.12);
    }
    .wwd-card__icon { font-size:clamp(2rem,4vw,2.8rem); position:relative; z-index:1; line-height:1; }
    .wwd-card__body { padding:clamp(1rem,2.5vw,1.5rem); flex:1; }
    .wwd-card__title { font-size:clamp(0.92rem,1.8vw,1.1rem); font-weight:800; color:#1a1a2e; margin-bottom:0.6rem; line-height:1.3; }
    .wwd-card__desc  { font-size:clamp(0.82rem,1.5vw,0.9rem); color:#4a4a6a; line-height:1.7; }

    /* ═══════════════════════════════════════════
       ABOUT US
    ═══════════════════════════════════════════ */
    .about-section {
        width:100%; background:#fff;
        padding:clamp(2rem,5vw,5rem) clamp(1rem,4vw,2rem);
        border-top:1px solid #f0eaf8;
    }
    .about-inner {
        max-width:1200px; margin:0 auto;
        display:grid; grid-template-columns:1fr 1fr;
        gap:clamp(1.5rem,4vw,4rem); align-items:center;
    }
    .about-img-wrap { position:relative; }
    .about-img-placeholder {
        width:100%; border-radius:1.2rem;
        background:linear-gradient(135deg,#f3edfb,#e8daf5);
        box-shadow:0 8px 36px rgba(150,100,180,.18);
        aspect-ratio:4/3;
        display:flex; align-items:center; justify-content:center; overflow:hidden;
    }
    .placeholder-inner { display:flex; flex-direction:column; align-items:center; gap:0.7rem; }
    .placeholder-inner svg { width:clamp(60px,10vw,96px); height:clamp(60px,10vw,96px); opacity:.8; display:block; }

    /* Badge — sits at bottom of image, full width on mobile */
    .about-badge {
        position:absolute; bottom:-1px; right:1rem;
        background:#fff; border-radius:0.75rem;
        padding:0.75rem 1rem;
        display:flex; align-items:center; gap:0.65rem;
        box-shadow:0 6px 24px rgba(150,100,180,.22);
        border-bottom:3px solid var(--lilac);
        max-width:calc(100% - 2rem);          /* never wider than image */
    }
    .about-badge__icon {
        width:34px; height:34px; flex-shrink:0;
        background:linear-gradient(135deg,var(--lilac),#9b6dbd);
        border-radius:0.5rem; display:flex; align-items:center; justify-content:center;
        font-size:1rem;
    }
    .about-badge__text { min-width:0; }      /* allow text to shrink */
    .about-badge__text strong {
        display:block; font-size:clamp(0.72rem,1.4vw,0.82rem); font-weight:700;
        color:#1a1a2e; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;
    }
    .about-badge__text span {
        font-size:clamp(0.65rem,1.2vw,0.72rem); color:#7a7a9a;
        overflow:hidden; text-overflow:ellipsis; white-space:nowrap; display:block;
    }
    .about-content h2 {
        font-size:clamp(1.4rem,3.5vw,2.6rem);
        font-weight:800; color:var(--lilac); margin-bottom:1rem; line-height:1.15;
    }
    .about-content p {
        font-size:clamp(0.88rem,1.6vw,0.97rem);
        color:#3a3a5a; line-height:1.8; margin-bottom:1rem;
    }

    /* ═══════════════════════════════════════════
       MISSION BANNER
    ═══════════════════════════════════════════ */
    .mission-banner { width:100%; background:linear-gradient(135deg,#c6a3c8,#b690c2); }
    .mission-banner-inner {
        max-width:900px; margin:0 auto; text-align:center;
        padding:clamp(2.5rem,7vw,5rem) clamp(1rem,4vw,2rem);
    }
    .mission-banner-inner h2 {
        font-size:clamp(1.4rem,4vw,2.25rem);
        font-weight:700; color:#fff; margin-bottom:1rem; line-height:1.25;
    }
    .mission-banner-inner p {
        font-size:clamp(0.9rem,2vw,1.1rem);
        line-height:1.8; color:#f2f2f2; max-width:740px; margin:0 auto;
    }

    /* ═══════════════════════════════════════════
       JOIN US
    ═══════════════════════════════════════════ */
    .join-section {
        position:relative; overflow:hidden; background:#1A1022;
        display:flex; align-items:center; justify-content:center;
        text-align:center;
        padding:clamp(3rem,8vw,6rem) clamp(1rem,4vw,1.5rem);
        min-height:clamp(500px,80vh,900px);
    }
    .join-section::before {
        content:''; position:absolute; inset:0;
        background:
          radial-gradient(ellipse 80% 60% at 20% 30%,rgba(200,162,200,.35) 0%,transparent 60%),
          radial-gradient(ellipse 60% 70% at 80% 70%,rgba(107,62,114,.45) 0%,transparent 55%),
          radial-gradient(ellipse 100% 80% at 50% 50%,rgba(26,16,34,1) 0%,transparent 100%);
        z-index:0;
    }
    .join-orb {
        position:absolute; border-radius:50%; filter:blur(55px); opacity:.22;
        animation:join-drift 12s ease-in-out infinite alternate; z-index:0;
    }
    .join-orb-1 { width:clamp(180px,35vw,380px); height:clamp(180px,35vw,380px); background:#C8A2C8; top:-60px; left:-80px; animation-duration:14s; }
    .join-orb-2 { width:clamp(130px,25vw,260px); height:clamp(130px,25vw,260px); background:#6B3E72; bottom:0; right:-60px; animation-duration:10s; animation-delay:-4s; }
    .join-orb-3 { width:clamp(100px,18vw,180px); height:clamp(100px,18vw,180px); background:#E4CBE4; top:40%; left:55%; animation-duration:18s; animation-delay:-7s; }
    @keyframes join-drift {
        from { transform:translate(0,0) scale(1); }
        to   { transform:translate(24px,16px) scale(1.07); }
    }
    .join-grain {
        position:absolute; inset:0; pointer-events:none; z-index:1; opacity:.5;
        background-image:url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.04'/%3E%3C/svg%3E");
    }
    .join-content { position:relative; z-index:2; max-width:720px; margin:0 auto; width:100%; }
    .join-eyebrow {
        display:inline-block; font-size:0.7rem; font-weight:500;
        letter-spacing:.2em; text-transform:uppercase; color:var(--lilac);
        border:1px solid rgba(200,162,200,.4); padding:.3rem .85rem;
        border-radius:100px; margin-bottom:1.6rem;
        background:rgba(200,162,200,.08); backdrop-filter:blur(8px);
    }
    .join-title {
        font-family:'Playfair Display',serif;
        font-size:clamp(1.8rem,6vw,4.2rem);
        font-weight:900; line-height:1.1; color:#fff; margin-bottom:1.2rem;
    }
    .join-title span { color:var(--lilac); font-style:italic; }
    .join-body {
        font-family:'DM Sans',sans-serif;
        font-size:clamp(0.88rem,2vw,1.1rem);
        font-weight:300; line-height:1.75;
        color:rgba(255,255,255,.72);
        max-width:560px; margin:0 auto 2.2rem;
    }
    .join-btn {
        display:inline-flex; align-items:center; gap:0.5rem;
        background:var(--lilac); color:#1A1022;
        font-family:'DM Sans',sans-serif; font-weight:500;
        font-size:clamp(0.88rem,1.8vw,1rem);
        padding:.82rem 1.8rem; border-radius:100px;
        border:none; cursor:pointer; text-decoration:none;
        transition:background .3s,color .3s,transform .2s,box-shadow .3s;
    }
    .join-btn:hover { background:#6B3E72; color:#fff; transform:translateY(-3px); box-shadow:0 12px 36px rgba(200,162,200,.35); }
    .join-btn svg { width:16px; height:16px; display:block; transition:transform .3s; }
    .join-btn:hover svg { transform:translateX(4px); }
    .join-stats {
        position:relative; z-index:2;
        display:flex; justify-content:center;
        gap:clamp(1.2rem,4vw,3rem); flex-wrap:wrap;
        margin-top:clamp(1.8rem,4vw,4rem); padding-top:clamp(1.2rem,3vw,3rem);
        border-top:1px solid rgba(200,162,200,.15);
    }
    .join-stat { text-align:center; }
    .join-stat-num {
        font-family:'Playfair Display',serif;
        font-size:clamp(1.3rem,3.5vw,2rem); font-weight:700; color:var(--lilac);
    }
    .join-stat-label {
        font-size:clamp(0.65rem,1.2vw,0.78rem); font-weight:300;
        color:rgba(255,255,255,.5); letter-spacing:.07em;
        text-transform:uppercase; margin-top:.2rem;
    }

    /* ═══════════════════════════════════════════
       FAQ
    ═══════════════════════════════════════════ */
    .faq-section {
        background:#f5eef8;
        padding:clamp(2rem,5vw,5rem) clamp(1rem,4vw,1.5rem);
    }
    .faq-inner { max-width:800px; margin:0 auto; }
    .faq-heading { text-align:center; margin-bottom:clamp(1.5rem,3vw,3rem); }
    .faq-heading h2 {
        font-family:'Playfair Display',serif;
        font-size:clamp(1.6rem,5vw,3rem); font-weight:900;
        color:#6B3E72; line-height:1.15; margin-bottom:.6rem;
    }
    .faq-heading p { font-family:'DM Sans',sans-serif; font-size:clamp(.85rem,1.6vw,1rem); color:#7a6080; font-weight:300; }
    .faq-list { display:flex; flex-direction:column; gap:.65rem; }
    .faq-item {
        background:#fff; border-radius:.8rem;
        border:1px solid rgba(200,162,200,.25); overflow:hidden;
        transition:box-shadow .25s;
    }
    .faq-item:hover { box-shadow:0 6px 24px rgba(107,62,114,.1); }
    .faq-item.open { border-color:var(--lilac); box-shadow:0 6px 24px rgba(107,62,114,.12); }
    .faq-question {
        width:100%; background:none; border:none; cursor:pointer;
        display:flex; align-items:center; justify-content:space-between;
        gap:.75rem; padding:clamp(.8rem,2vw,1.2rem) clamp(.9rem,2.5vw,1.4rem);
        text-align:left;
        font-family:'Barlow',sans-serif;
        font-size:clamp(.82rem,1.6vw,1rem); font-weight:600; color:#1a1a2e;
        transition:color .2s;
        min-width:0;                          /* allow flex children to shrink */
    }
    .faq-question span.faq-q-text { flex:1; min-width:0; }  /* text takes remaining space */
    .faq-item.open .faq-question { color:#6B3E72; }
    .faq-icon {
        flex-shrink:0; width:26px; height:26px; border-radius:50%;
        background:#f5eef8; display:flex; align-items:center; justify-content:center;
        transition:background .25s,transform .3s;
    }
    .faq-item.open .faq-icon { background:var(--lilac); transform:rotate(45deg); }
    .faq-icon svg { width:13px; height:13px; display:block; stroke:#6B3E72; transition:stroke .25s; }
    .faq-item.open .faq-icon svg { stroke:#fff; }
    .faq-answer { max-height:0; overflow:hidden; transition:max-height .4s ease; }
    .faq-item.open .faq-answer { max-height:600px; }
    .faq-answer-inner {
        padding:0 clamp(.9rem,2.5vw,1.4rem) 1.2rem;
        font-family:'DM Sans',sans-serif;
        font-size:clamp(.8rem,1.5vw,.93rem); font-weight:300;
        color:#4a4a6a; line-height:1.8;
    }
    .faq-answer-inner ul { padding-left:1.1rem; margin-top:.5rem; }
    .faq-answer-inner ul li { list-style:disc; margin-bottom:.3rem; }

    /* ═══════════════════════════════════════════
       FOOTER
    ═══════════════════════════════════════════ */
    .sm-footer {
        background:#0D0813;
        border-top:1px solid rgba(200,162,200,.12);
        padding:clamp(2rem,5vw,4rem) clamp(1rem,3vw,1.5rem) clamp(1rem,2vw,2rem);
        font-family:'DM Sans',sans-serif;
    }
    .sm-footer-inner { max-width:1200px; margin:0 auto; }
    .sm-footer-top {
        display:grid;
        grid-template-columns:1.4fr 1fr 1fr 1fr;
        gap:clamp(1.2rem,3vw,3rem); margin-bottom:clamp(1.5rem,3vw,3rem);
    }
    .sm-brand-logo { display:flex; align-items:center; gap:.65rem; margin-bottom:.9rem; text-decoration:none; }
    .sm-brand-icon {
        width:38px; height:38px; flex-shrink:0;
        background:linear-gradient(135deg,#6B3E72,var(--lilac));
        border-radius:9px; display:flex; align-items:center; justify-content:center;
    }
    .sm-brand-icon svg { width:19px; height:19px; display:block; }
    .sm-brand-name {
        font-family:'Playfair Display',serif;
        font-size:clamp(.85rem,1.6vw,1.05rem); font-weight:700; color:#fff; line-height:1.25;
        min-width:0;
    }
    .sm-brand-name small {
        display:block; font-family:'DM Sans',sans-serif;
        font-size:.6rem; font-weight:300; letter-spacing:.13em;
        color:var(--lilac); text-transform:uppercase;
    }
    .sm-footer-tagline {
        font-size:clamp(.78rem,1.3vw,.86rem); font-weight:300;
        color:rgba(255,255,255,.5); line-height:1.7; margin-bottom:1.3rem;
    }
    .sm-col-title {
        font-size:.7rem; font-weight:500; letter-spacing:.16em;
        text-transform:uppercase; color:var(--lilac); margin-bottom:1rem;
    }
    .sm-footer-links { display:flex; flex-direction:column; gap:.6rem; }
    .sm-footer-links a {
        text-decoration:none; font-size:clamp(.8rem,1.3vw,.88rem); font-weight:300;
        color:rgba(255,255,255,.55); transition:color .2s,padding-left .2s; display:inline-block;
    }
    .sm-footer-links a:hover { color:#E4CBE4; padding-left:4px; }
    .sm-footer-divider { border:none; border-top:1px solid rgba(200,162,200,.1); margin:0 0 1.4rem; }
    .sm-footer-bottom {
        display:flex; align-items:center; justify-content:space-between;
        flex-wrap:wrap; gap:.9rem;
    }
    .sm-footer-copy { font-size:clamp(.7rem,1.1vw,.78rem); color:rgba(255,255,255,.3); }
    .sm-footer-legal { display:flex; gap:.9rem; flex-wrap:wrap; }
    .sm-footer-legal a { font-size:.74rem; color:rgba(255,255,255,.3); text-decoration:none; transition:color .2s; }
    .sm-footer-legal a:hover { color:var(--lilac); }
    .sm-social-links { display:flex; gap:.65rem; flex-wrap:wrap; align-items:center; }
    .sm-social-btn {
        width:33px; height:33px; border-radius:50%;
        border:1px solid rgba(200,162,200,.2);
        display:flex; align-items:center; justify-content:center;
        color:rgba(255,255,255,.5); text-decoration:none;
        transition:background .25s,border-color .25s,transform .2s;
    }
    .sm-social-btn:hover { background:rgba(200,162,200,.15); border-color:var(--lilac); color:var(--lilac); transform:translateY(-2px); }
    .sm-social-btn svg { width:13px; height:13px; display:block; }
    .sm-emergency-badge {
        display:inline-flex; align-items:center; gap:.45rem;
        background:#cc2222; border:none; border-radius:6px;
        padding:.5rem .9rem; font-size:.82rem; font-weight:600;
        color:#fff; text-decoration:none; cursor:pointer;
        box-shadow:0 3px 12px rgba(204,34,34,.45);
        transition:background .2s,transform .2s; flex-shrink:0;
    }
    .sm-emergency-badge:hover { background:#aa1a1a; transform:translateY(-1px); }
    .sm-emergency-badge svg { width:13px; height:13px; display:block; flex-shrink:0; }

    /* ═══════════════════════════════════════════
       RESPONSIVE BREAKPOINTS — mobile-first cascade
    ═══════════════════════════════════════════ */

    /* Wide desktop only tweak */
    @media (min-width: 1200px) {
        .about-badge { right: 1.5rem; }
    }

    /* Small laptop / large tablet (≤1100px) */
    @media (max-width: 1100px) {
        .wwd-grid { grid-template-columns: repeat(2, 1fr); }
        .sm-footer-top { grid-template-columns: 1fr 1fr; }
    }

    /* Tablet landscape (≤900px) */
    @media (max-width: 900px) {
        .about-inner { grid-template-columns: 1fr; }
        .about-img-wrap { max-width: 560px; margin: 0 auto; }
        .wa-number { font-size: 0.82rem; }
        .btn-exit { padding: 0.42rem 0.85rem; font-size: 0.78rem; }
        .divider { display: none; }
    }

    /* Tablet portrait / iPad (≤768px) */
    @media (max-width: 768px) {
        body { padding-top: 69px; }
        .sm-footer-top { grid-template-columns: 1fr 1fr; gap: 1.6rem; }
        .sm-footer-bottom { flex-direction: column; align-items: flex-start; }
        .join-section { min-height: auto; }
    }

    /* Large phone / small tablet (≤640px) */
    @media (max-width: 640px) {
        .actions { display: none; }                        /* hide desktop nav */
        .mob-toggle { display: flex; }                    /* show hamburger */
        .wwd-grid { grid-template-columns: 1fr; }
        .sm-footer-top { grid-template-columns: 1fr; gap: 1.4rem; }
        .join-orb-3 { display: none; }
    }

    /* Phone portrait (≤480px) */
    @media (max-width: 480px) {
        body { padding-top: 62px; }
        .topbar-inner { min-height: 54px; padding: 0 0.9rem; }
        .logo-img { height: 42px; }
        .mob-drawer { padding: 0.8rem 0.9rem; }

        /* About badge: static, full-width strip under image */
        .about-badge {
            position: static;
            max-width: 100%;
            margin-top: 0.75rem;
            justify-content: flex-start;
            border-radius: 0.6rem;
            right: auto;
        }
        .about-badge__text strong,
        .about-badge__text span { white-space: normal; }

        /* Counters stack */
        .join-stats { flex-direction: column; gap: 1.2rem; align-items: center; }

        /* Footer bottom stacks tighter */
        .sm-footer-bottom { gap: 0.8rem; }
        .sm-footer-legal  { gap: 0.6rem; }
    }

    /* Very small phones (≤380px) */
    @media (max-width: 380px) {
        .topbar-inner { padding: 0 0.65rem; }
        .logo-img { height: 36px; }
        .mob-toggle svg { width: 18px; height: 18px; }
        .faq-icon { width: 22px; height: 22px; }
        .sm-emergency-badge { padding: 0.42rem 0.75rem; font-size: 0.76rem; }
    }

    /* Print */
    @media print {
        .topbar, .mob-toggle, .mob-drawer, .btn-exit, .btn-report { display: none !important; }
        body { padding-top: 0; background: #fff; }
        .join-section { -webkit-print-color-adjust: exact; print-color-adjust: exact; }
    }
    </style>
</head>
<body>

<!-- ══ TOPBAR ══ -->

<!-- ══ WHAT WE DO ══ -->
<section class="wwd-section" aria-labelledby="wwd-title">
    <div class="wwd-inner">
        <div class="wwd-heading"><h2 id="wwd-title">What We Do</h2></div>
        <div class="wwd-grid">
            <article class="wwd-card">
                <div class="wwd-card__banner wwd-card__banner--safety" aria-hidden="true">
                    <span class="wwd-card__icon">🛡️</span>
                </div>
                <div class="wwd-card__body">
                    <h3 class="wwd-card__title">Digital Safety and Awareness</h3>
                    <p class="wwd-card__desc">Strengthen digital safety for online users. Provide referral pathways for people experiencing online abuse to relevant services within their reach.</p>
                </div>
            </article>
            <article class="wwd-card">
                <div class="wwd-card__banner wwd-card__banner--tfgbv" aria-hidden="true">
                    <span class="wwd-card__icon">💜</span>
                </div>
                <div class="wwd-card__body">
                    <h3 class="wwd-card__title">TFGBV Reporting and Support</h3>
                    <p class="wwd-card__desc">Strengthen survivor-centred reporting and referral systems. Provide survivors with timely, holistic support that prioritises their rights, safety and recovery.</p>
                </div>
            </article>
            <article class="wwd-card">
                <div class="wwd-card__banner wwd-card__banner--tech" aria-hidden="true">
                    <span class="wwd-card__icon">🚀</span>
                </div>
                <div class="wwd-card__body">
                    <h3 class="wwd-card__title">Innovation and Technology</h3>
                    <p class="wwd-card__desc">We support victims in developing digital solutions that promote safety, inclusivity and justice, and build digital literacy to bridge the digital divide.</p>
                </div>
            </article>
        </div>
    </div>
</section>

<!-- ══ ABOUT US ══ -->
<section class="about-section" aria-labelledby="about-title">
    <div class="about-inner">
        <div class="about-img-wrap">
            <div class="about-img-placeholder" aria-hidden="true">
                <div class="placeholder-inner">
                    <svg viewBox="0 0 80 80" fill="none">
                        <rect width="80" height="80" rx="8" fill="rgba(200,162,200,0.15)"/>
                        <circle cx="40" cy="28" r="14" fill="rgba(200,162,200,0.5)"/>
                        <path d="M10 72 C10 52 70 52 70 72" fill="rgba(200,162,200,0.5)"/>
                        <circle cx="20" cy="32" r="9" fill="rgba(200,162,200,0.35)"/>
                        <path d="M2 72 C2 56 38 56 38 72" fill="rgba(200,162,200,0.35)"/>
                        <circle cx="60" cy="32" r="9" fill="rgba(200,162,200,0.35)"/>
                        <path d="M42 72 C42 56 78 56 78 72" fill="rgba(200,162,200,0.35)"/>
                    </svg>
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
        <div class="about-content">
            <h2 id="about-title">About Us</h2>
            <p>As digital spaces continue to grow, so do the risks of online harassment, cyberstalking, non-consensual sharing of intimate images, online exploitation, and other forms of digital abuse. We are a dedicated platform committed to raising awareness, preventing, and responding to Technology-Facilitated Gender-Based Violence (TFGBV).</p>
        </div>
    </div>
</section>

<!-- ══ MISSION ══ -->
<section class="mission-banner" aria-label="Our Mission">
    <div class="mission-banner-inner">
        <h2>Our Mission</h2>
        <p>To provide a secure, confidential and survivor-centred platform for reporting, preventing and responding to Technology-Facilitated Gender-Based Violence — ensuring all individuals can enjoy the benefits of technology without fear, and with their digital rights protected.</p>
    </div>
</section>

<!-- ══ JOIN US ══ -->
<section class="join-section" aria-label="Join Us">
    <div class="join-orb join-orb-1"></div>
    <div class="join-orb join-orb-2"></div>
    <div class="join-orb join-orb-3"></div>
    <div class="join-grain"></div>
    <div class="join-content">
        <span class="join-eyebrow">🛡 Collective Action</span>
        <h1 class="join-title">Join Us in Making<br>a <span>Difference</span></h1>
        <p class="join-body">At the State Department for Gender and Affirmative Action, we believe in the power of collective action. Together, we create safer digital spaces for everyone. Get involved today to help fight TFGBV.</p>
        <a href="#" class="join-btn">
            Get Involved
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/>
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

<!-- ══ FAQ ══ -->
<section class="faq-section" aria-labelledby="faq-title">
    <div class="faq-inner">
        <div class="faq-heading">
            <h2 id="faq-title">Frequently Asked Questions</h2>
            <p>Everything you need to know about our work and how to get help.</p>
        </div>
        <div class="faq-list" role="list">

            <div class="faq-item" role="listitem">
                <button class="faq-question" aria-expanded="false">
                    <span class="faq-q-text">What is Technology-Facilitated Gender-Based Violence (TFGBV)?</span>
                    <span class="faq-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg></span>
                </button>
                <div class="faq-answer"><div class="faq-answer-inner">TFGBV refers to an act of violence committed through digital technologies e.g. mobile phones, social media etc.</div></div>
            </div>

            <div class="faq-item" role="listitem">
                <button class="faq-question" aria-expanded="false">
                    <span class="faq-q-text">What are common examples of TFGBV?</span>
                    <span class="faq-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg></span>
                </button>
                <div class="faq-answer"><div class="faq-answer-inner">Online harassment, cyber bullying, non-consensual sharing of intimate images.</div></div>
            </div>

            <div class="faq-item" role="listitem">
                <button class="faq-question" aria-expanded="false">
                    <span class="faq-q-text">Who is most at risk?</span>
                    <span class="faq-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg></span>
                </button>
                <div class="faq-answer"><div class="faq-answer-inner">Women and girls, female politicians, young people and public figures.</div></div>
            </div>

            <div class="faq-item" role="listitem">
                <button class="faq-question" aria-expanded="false">
                    <span class="faq-q-text">How can someone report TFGBV?</span>
                    <span class="faq-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg></span>
                </button>
                <div class="faq-answer"><div class="faq-answer-inner">A survivor can: report to the national TFGBV reporting system, report to the nearest police station, or report directly to the online platform where the abuse occurred.</div></div>
            </div>

            <div class="faq-item" role="listitem">
                <button class="faq-question" aria-expanded="false">
                    <span class="faq-q-text">Is reporting confidential?</span>
                    <span class="faq-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg></span>
                </button>
                <div class="faq-answer"><div class="faq-answer-inner">Yes. Reporting mechanisms protect survivor identity, follow data protection law, and ensure secure storage of digital evidence.</div></div>
            </div>

            <div class="faq-item" role="listitem">
                <button class="faq-question" aria-expanded="false">
                    <span class="faq-q-text">What happens when a user reports?</span>
                    <span class="faq-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg></span>
                </button>
                <div class="faq-answer"><div class="faq-answer-inner">You will receive a follow-up call for psychosocial support, counselling and referral for other services.</div></div>
            </div>

            <div class="faq-item" role="listitem">
                <button class="faq-question" aria-expanded="false">
                    <span class="faq-q-text">What is the typical response time?</span>
                    <span class="faq-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg></span>
                </button>
                <div class="faq-answer"><div class="faq-answer-inner">48 hours.</div></div>
            </div>

            <div class="faq-item" role="listitem">
                <button class="faq-question" aria-expanded="false">
                    <span class="faq-q-text">What laws address TFGBV in Kenya?</span>
                    <span class="faq-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg></span>
                </button>
                <div class="faq-answer"><div class="faq-answer-inner">TFGBV falls under existing laws including the Computer Misuse Act, Data Protection Act, Sexual Offences Act, PADV Act, Children's Act, Penal Code, and National Policy on Protection against GBV.</div></div>
            </div>

            <div class="faq-item" role="listitem">
                <button class="faq-question" aria-expanded="false">
                    <span class="faq-q-text">What support services are available to survivors?</span>
                    <span class="faq-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg></span>
                </button>
                <div class="faq-answer"><div class="faq-answer-inner">Survivors may access: psychosocial counselling, legal assistance, medical services, digital safety guidance, and shelter services.</div></div>
            </div>

            <div class="faq-item" role="listitem">
                <button class="faq-question" aria-expanded="false">
                    <span class="faq-q-text">What should a survivor do immediately after experiencing TFGBV?</span>
                    <span class="faq-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg></span>
                </button>
                <div class="faq-answer">
                    <div class="faq-answer-inner">
                        <ul>
                            <li>Do not delete evidence.</li>
                            <li>Take screenshots (include date and URL).</li>
                            <li>Secure accounts — change passwords.</li>
                            <li>Enable two-factor authentication (2FA).</li>
                            <li>Report to the platform.</li>
                            <li>Report to the authorities.</li>
                            <li>Seek support services.</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="faq-item" role="listitem">
                <button class="faq-question" aria-expanded="false">
                    <span class="faq-q-text">Can TFGBV incidents be prosecuted?</span>
                    <span class="faq-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg></span>
                </button>
                <div class="faq-answer"><div class="faq-answer-inner">Yes, if sufficient evidence exists. Perpetrators may face fines, imprisonment, civil damages, and platform bans.</div></div>
            </div>

            <div class="faq-item" role="listitem">
                <button class="faq-question" aria-expanded="false">
                    <span class="faq-q-text">What role do online communities play in preventing TFGBV?</span>
                    <span class="faq-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg></span>
                </button>
                <div class="faq-answer">
                    <div class="faq-answer-inner">
                        <ul>
                            <li>Developing clear community guidelines.</li>
                            <li>Restricting further sharing of harmful content.</li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ══ FOOTER ══ -->
<footer class="sm-footer" role="contentinfo">
    <div class="sm-footer-inner">
        <div class="sm-footer-top">
            <div>
                <a class="sm-brand-logo" href="#">
                    <div class="sm-brand-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                        </svg>
                    </div>
                    <div class="sm-brand-name">
                        The State Department for Gender and Affirmative Action
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
                <p class="sm-col-title">Organisation</p>
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
            <p class="sm-footer-copy">
                &copy; <script>document.write(new Date().getFullYear())</script>
                The State Department for Gender and Affirmative Action. All rights reserved.
            </p>
            <div class="sm-footer-legal">
                <a href="#">Privacy Policy</a>
                <a href="#">Terms of Service</a>
                <a href="#">Data Usage</a>
            </div>
            <div class="sm-social-links">
                <a href="tel:1195" class="sm-emergency-badge">
                    <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81 19.79 19.79 0 01.12 1.18 2 2 0 012.11 0h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/>
                    </svg>
                    Emergency: 911
                </a>
                <a href="#" class="sm-social-btn" aria-label="Twitter">
                    <svg viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                </a>
                <a href="#" class="sm-social-btn" aria-label="Instagram">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1" fill="currentColor" stroke="none"/></svg>
                </a>
                <a href="#" class="sm-social-btn" aria-label="LinkedIn">
                    <svg viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                </a>
            </div>
        </div>
    </div>
</footer>



</body>
</html>
