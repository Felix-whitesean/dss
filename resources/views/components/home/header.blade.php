
<header class="topbar" role="banner">
    <div class="flag-strip" aria-hidden="true">
        <span></span><span></span><span></span><span></span><span></span>
    </div>
    <div class="topbar-inner">

        <a class="brand max-w-[80%]" href="{{route('home')}}" aria-label="Ministry of Gender, Culture and Children Services – Home">

            <img class="logo-img"
                 src="{{asset('/images/logo_full.png')}}"
                 alt="Ministry of Gender, Culture and Children Services" />
        </a>

        <!-- Desktop actions -->
        <div class="actions" role="navigation" aria-label="Quick actions">
            <a href="{{route('report').'?activePage=Personal+information'}}" class="btn-report" aria-label="Report Abuse">
                <svg class="report-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                    <line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/>
                </svg>
                Report Abuse
            </a>
            <div class="divider" aria-hidden="true"></div>
            <a class="wa-link" href="https://wa.me/254711223344" target="_blank" rel="noopener noreferrer" aria-label="Chat on WhatsApp: +254711223344">
                <span class="wa-label">Chat with us via WhatsApp</span>
                <span class="wa-number">+254711223344
                    <svg class="wa-icon" viewBox="0 0 32 32" fill="none" aria-hidden="true">
                        <circle cx="16" cy="16" r="16" fill="#25D366"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M16 6.4C10.698 6.4 6.4 10.698 6.4 16c0 1.717.456 3.33 1.25 4.726L6.4 25.6l5.02-1.225A9.553 9.553 0 0016 25.6c5.302 0 9.6-4.298 9.6-9.6S21.302 6.4 16 6.4zm5.6 13.44c-.238.67-1.386 1.282-1.904 1.36-.487.073-1.1.104-1.776-.112a16.41 16.41 0 01-1.608-.594c-2.83-1.222-4.678-4.08-4.818-4.27-.14-.19-1.12-1.49-1.12-2.842 0-1.352.71-2.016 1.008-2.296.238-.22.63-.322.952-.322.14 0 .266.007.378.013.378.016.568.038.818.63.28.672.952 2.31.952 2.394 0 0 .098.154-.014.308-.112.154-.168.252-.336.42-.168.168-.35.378-.5.504-.168.14-.35.294-.154.574.196.28.882 1.456 1.89 2.352 1.302 1.162 2.38 1.526 2.716 1.68.336.154.532.126.728-.07.196-.196.868-.994 1.092-1.33.224-.336.462-.28.784-.168.322.112 2.072.98 2.422 1.148.35.168.588.252.672.392.084.14.084.812-.154 1.482z" fill="white"/>
                    </svg>
                </span>
            </a>
            <div class="divider" aria-hidden="true"></div>
            <button class="btn-exit" id="exitBtn" aria-label="Quick Exit – leaves this site immediately">
                <svg class="exit-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/>
                    <polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/>
                </svg>
                Quick EXIT
            </button>
        </div>

        <!-- Mobile hamburger -->
        <button class="mob-toggle" id="mobToggle" aria-label="Toggle menu" aria-expanded="false" aria-controls="mobDrawer">
            <svg id="mobIcon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="3" y1="6" x2="21" y2="6"/>
                <line x1="3" y1="12" x2="21" y2="12"/>
                <line x1="3" y1="18" x2="21" y2="18"/>
            </svg>
        </button>
    </div>

    <!-- Mobile drawer -->
    <nav class="mob-drawer" id="mobDrawer" aria-label="Mobile quick actions">
        <a href="{{route('report')}}" class="btn-report" aria-label="Report Abuse">
            <svg class="report-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                <line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/>
            </svg>
            Report Abuse
        </a>
        <a class="wa-link" href="https://wa.me/254711223344" target="_blank" rel="noopener noreferrer">
            <span class="wa-label">Chat with us via WhatsApp</span>
            <span class="wa-number">+254711223344
                <svg class="wa-icon" viewBox="0 0 32 32" fill="none" aria-hidden="true">
                    <circle cx="16" cy="16" r="16" fill="#25D366"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16 6.4C10.698 6.4 6.4 10.698 6.4 16c0 1.717.456 3.33 1.25 4.726L6.4 25.6l5.02-1.225A9.553 9.553 0 0016 25.6c5.302 0 9.6-4.298 9.6-9.6S21.302 6.4 16 6.4zm5.6 13.44c-.238.67-1.386 1.282-1.904 1.36-.487.073-1.1.104-1.776-.112a16.41 16.41 0 01-1.608-.594c-2.83-1.222-4.678-4.08-4.818-4.27-.14-.19-1.12-1.49-1.12-2.842 0-1.352.71-2.016 1.008-2.296.238-.22.63-.322.952-.322.14 0 .266.007.378.013.378.016.568.038.818.63.28.672.952 2.31.952 2.394 0 0 .098.154-.014.308-.112.154-.168.252-.336.42-.168.168-.35.378-.5.504-.168.14-.35.294-.154.574.196.28.882 1.456 1.89 2.352 1.302 1.162 2.38 1.526 2.716 1.68.336.154.532.126.728-.07.196-.196.868-.994 1.092-1.33.224-.336.462-.28.784-.168.322.112 2.072.98 2.422 1.148.35.168.588.252.672.392.084.14.084.812-.154 1.482z" fill="white"/>
                </svg>
            </span>
        </a>
        <button id="exit" class="btn-exit" aria-label="Quick Exit">
            <svg class="exit-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/>
                <polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/>
            </svg>
            Quick EXIT
        </button>
    </nav>
</header>
<script>
    (function () {
        'use strict';

        /* ── FAQ accordion ── */
        document.querySelectorAll('.faq-question').forEach(function (btn) {
            btn.addEventListener('click', function () {
                var item = btn.closest('.faq-item');
                var isOpen = item.classList.contains('open');
                document.querySelectorAll('.faq-item').forEach(function (el) {
                    el.classList.remove('open');
                    el.querySelector('.faq-question').setAttribute('aria-expanded', 'false');
                });
                if (!isOpen) {
                    item.classList.add('open');
                    btn.setAttribute('aria-expanded', 'true');
                }
            });
        });

        /* ── Mobile drawer toggle ── */
        var toggle = document.getElementById('mobToggle');
        var drawer = document.getElementById('mobDrawer');
        var icon   = document.getElementById('mobIcon');
        var MENU  = '<line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/>';
        var CLOSE = '<line x1="4" y1="4" x2="20" y2="20"/><line x1="20" y1="4" x2="4" y2="20"/>';
        if (toggle && drawer) {
            toggle.addEventListener('click', function () {
                var open = drawer.classList.toggle('open');
                toggle.setAttribute('aria-expanded', String(open));
                icon.innerHTML = open ? CLOSE : MENU;
            });
            /* Close drawer when clicking outside */
            document.addEventListener('click', function (e) {
                if (!toggle.contains(e.target) && !drawer.contains(e.target)) {
                    drawer.classList.remove('open');
                    toggle.setAttribute('aria-expanded', 'false');
                    icon.innerHTML = MENU;
                }
            });
        }

        /* ── Quick Exit (button click) ── */
        document.querySelectorAll('.btn-exit').forEach(function (b) {
            b.addEventListener('click', function () {
                window.location.replace('https://www.google.com');
            });
        });

        /* ── Quick Exit (Esc × 3 within 1 s) ── */
        var escCount = 0, escTimer;
        document.addEventListener('keydown', function (e) {
            if (e.key !== 'Escape') return;
            escCount++;
            clearTimeout(escTimer);
            escTimer = setTimeout(function () { escCount = 0; }, 1000);
            if (escCount >= 3) window.location.replace('https://www.google.com');
        });

        /* ── Animated counters ── */
        function animateCount(el) {
            var target  = +el.dataset.target;
            var step    = target / (2000 / 16);
            var current = 0;
            var timer   = setInterval(function () {
                current += step;
                if (current >= target) { current = target; clearInterval(timer); }
                el.textContent = Math.floor(current).toLocaleString() + (target >= 100 ? '+' : '');
            }, 16);
        }
        if ('IntersectionObserver' in window) {
            var obs = new IntersectionObserver(function (entries) {
                entries.forEach(function (e) {
                    if (e.isIntersecting) { animateCount(e.target); obs.unobserve(e.target); }
                });
            }, { threshold: 0.5 });
            document.querySelectorAll('.join-stat-num[data-target]').forEach(function (c) { obs.observe(c); });
        }
    })();
</script>
