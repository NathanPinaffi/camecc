(() => {
    'use strict';

    const doc = document;
    const root = doc.documentElement;
    const $ = (s, c = doc) => c.querySelector(s);
    const $$ = (s, c = doc) => Array.from(c.querySelectorAll(s));
    const clamp = (v, a, b) => Math.min(b, Math.max(a, v));
    const reduced = matchMedia('(prefers-reduced-motion: reduce)').matches;
    const finePointer = matchMedia('(hover: hover) and (pointer: fine)').matches;

    /* ------------------------------------------------------------------
       Preloader → libera a página e dispara as animações de entrada
       ------------------------------------------------------------------ */
    const preloader = $('.preloader');
    const MIN_SHOW = reduced ? 0 : 1300;
    const startedAt = performance.now();
    let revealStarted = false;

    const setLoad = (v) => preloader && preloader.style.setProperty('--load', v);
    setLoad(0.15);
    const fake = setInterval(() => setLoad(Math.min(0.85, parseFloat(getComputedStyle(preloader || root).getPropertyValue('--load') || 0.15) + 0.08)), 180);

    function startReveals() {
        if (revealStarted) return;
        revealStarted = true;
        initReveal();
        initCounters();
    }

    let finished = false;
    function finishLoading() {
        if (finished) return;
        finished = true;
        clearInterval(fake);
        setLoad(1);
        const wait = Math.max(0, MIN_SHOW - (performance.now() - startedAt));
        setTimeout(() => {
            root.classList.add('is-ready');
            const hashTarget = location.hash.length > 1 ? $(location.hash) : null;
            if (hashTarget) hashTarget.scrollIntoView({ behavior: 'auto' });
            if (preloader) {
                preloader.classList.add('is-done');
                setTimeout(() => preloader.remove(), 1400);
            }
            setTimeout(startReveals, reduced ? 0 : 420);
        }, wait + 200);
    }

    if (doc.readyState === 'complete') finishLoading();
    else addEventListener('load', finishLoading, { once: true });
    setTimeout(finishLoading, 6000);

    /* ------------------------------------------------------------------
       Reveal ao rolar
       ------------------------------------------------------------------ */
    function initReveal() {
        const items = $$('[data-reveal]');
        if (reduced || !('IntersectionObserver' in window)) {
            items.forEach((el) => el.classList.add('is-in'));
            return;
        }
        // Elementos com clip-path têm área visível zero antes de revelar, então observamos o pai.
        const targets = new Map();
        const io = new IntersectionObserver((entries) => {
            entries.forEach((en) => {
                if (!en.isIntersecting) return;
                targets.get(en.target).classList.add('is-in');
                io.unobserve(en.target);
            });
        }, { threshold: 0.18, rootMargin: '0px 0px -6% 0px' });
        items.forEach((el) => {
            const watch = el.dataset.reveal === 'clip' ? el.parentElement : el;
            targets.set(watch, el);
            io.observe(watch);
        });
    }

    function initCounters() {
        const els = $$('[data-count]');
        const run = (el) => {
            const target = parseInt(el.dataset.count, 10) || 0;
            if (reduced || target === 0) { el.textContent = target; return; }
            const dur = 1400;
            const t0 = performance.now();
            const tick = (t) => {
                const p = clamp((t - t0) / dur, 0, 1);
                const eased = 1 - Math.pow(1 - p, 4);
                el.textContent = Math.round(target * eased);
                if (p < 1) requestAnimationFrame(tick);
            };
            requestAnimationFrame(tick);
        };
        if (!('IntersectionObserver' in window)) { els.forEach(run); return; }
        const io = new IntersectionObserver((entries) => {
            entries.forEach((en) => {
                if (!en.isIntersecting) return;
                run(en.target);
                io.unobserve(en.target);
            });
        }, { threshold: 0.6 });
        els.forEach((el) => io.observe(el));
    }

    /* ------------------------------------------------------------------
       Manchas SVG: pausa quando saem da tela (economiza CPU)
       ------------------------------------------------------------------ */
    const blobs = $$('svg.blob');
    if (reduced) {
        blobs.forEach((s) => s.pauseAnimations && s.pauseAnimations());
    } else if ('IntersectionObserver' in window) {
        const io = new IntersectionObserver((entries) => {
            entries.forEach((en) => {
                const s = en.target;
                if (!s.pauseAnimations) return;
                en.isIntersecting ? s.unpauseAnimations() : s.pauseAnimations();
            });
        }, { rootMargin: '120px' });
        blobs.forEach((s) => io.observe(s));
    }

    /* ------------------------------------------------------------------
       Navegação: estado, esconder ao descer, menu móvel, scrollspy
       ------------------------------------------------------------------ */
    const nav = $('[data-nav]');
    const burger = $('.burger');
    const menu = $('#menu');

    function setMenu(open) {
        if (!burger || !menu) return;
        burger.setAttribute('aria-expanded', String(open));
        burger.setAttribute('aria-label', open ? 'Fechar menu' : 'Abrir menu');
        menu.classList.toggle('is-open', open);
        root.style.overflow = open ? 'hidden' : '';
        if (open) nav && nav.classList.remove('is-hidden');
    }
    burger && burger.addEventListener('click', () => setMenu(burger.getAttribute('aria-expanded') !== 'true'));
    menu && $$('a', menu).forEach((a) => a.addEventListener('click', () => setMenu(false)));
    addEventListener('keydown', (e) => { if (e.key === 'Escape') setMenu(false); });
    matchMedia('(min-width: 901px)').addEventListener('change', (e) => e.matches && setMenu(false));

    const spyLinks = $$('[data-spy]');
    const sections = spyLinks.map((a) => $(a.getAttribute('href'))).filter(Boolean);
    if (sections.length && 'IntersectionObserver' in window) {
        const spy = new IntersectionObserver((entries) => {
            entries.forEach((en) => {
                if (!en.isIntersecting) return;
                spyLinks.forEach((a) => a.classList.toggle('is-active', a.getAttribute('href') === '#' + en.target.id));
            });
        }, { rootMargin: '-45% 0px -50% 0px' });
        sections.forEach((s) => spy.observe(s));
    }

    /* ------------------------------------------------------------------
       Loop de rolagem: progresso, direção da nav, parallax, cachorro
       ------------------------------------------------------------------ */
    const progress = $('.progress');
    const campus = $('[data-run]');
    const runner = campus && $('.campus__runner', campus);
    const runnerTrack = campus && $('.campus__track', campus);

    const parallaxDefs = [
        ['.hero__blob--red', 0.12], ['.hero__blob--ink', -0.1], ['.hero__blob--ink2', 0.2],
        ['.spot--a', 0.25], ['.spot--b', -0.18], ['.spot--c', 0.3], ['.spot--d', -0.22],
        ['.about__blob', 0.1], ['.mspot--a', 0.14], ['.mspot--b', -0.12], ['.mspot--c', 0.1],
        ['.tblob--a', 0.08], ['.tblob--b', -0.08], ['.hero__stage', -0.05],
    ];
    const parallax = reduced ? [] : parallaxDefs.flatMap(([sel, speed]) => $$(sel).map((el) => ({ el, speed, y: 0 })));

    let lastY = scrollY;
    let runX = 0;
    let runTarget = 0;
    let running = false;

    function onScroll() {
        const y = scrollY;
        const max = doc.documentElement.scrollHeight - innerHeight;

        if (progress) progress.style.setProperty('--p', max > 0 ? (y / max).toFixed(4) : 0);

        if (nav) {
            nav.classList.toggle('is-stuck', y > 24);
            const goingDown = y > lastY && y > 240;
            const menuOpen = menu && menu.classList.contains('is-open');
            nav.classList.toggle('is-hidden', goingDown && !menuOpen);
        }
        lastY = y;

        if (campus && runner && runnerTrack) {
            const r = campus.getBoundingClientRect();
            const p = clamp((innerHeight - r.top) / (innerHeight + r.height * 0.35), 0, 1);
            runTarget = p * (runnerTrack.clientWidth - runner.clientWidth);
        }
        kick();
    }

    function frame() {
        let moving = false;

        for (const p of parallax) {
            const r = p.el.getBoundingClientRect();
            if (r.bottom < -200 || r.top > innerHeight + 200) continue;
            const center = r.top + r.height / 2 - innerHeight / 2;
            const target = center * p.speed * -1;
            p.y += (target - p.y) * 0.1;
            if (Math.abs(target - p.y) > 0.1) moving = true;
            p.el.style.translate = `0 ${p.y.toFixed(1)}px`;
        }

        if (runner) {
            const diff = runTarget - runX;
            if (Math.abs(diff) > 0.3) {
                runX += diff * 0.09;
                runner.style.setProperty('--rx', `${runX.toFixed(1)}px`);
                runner.classList.toggle('is-back', diff < -0.6);
                moving = true;
            }
        }

        if (moving) requestAnimationFrame(frame);
        else running = false;
    }

    function kick() {
        if (running) return;
        running = true;
        requestAnimationFrame(frame);
    }

    addEventListener('scroll', onScroll, { passive: true });
    addEventListener('resize', onScroll, { passive: true });
    onScroll();

    /* ------------------------------------------------------------------
       Interações de ponteiro (só mouse/caneta)
       ------------------------------------------------------------------ */
    if (finePointer && !reduced) {
        // Parallax do mascote seguindo o mouse
        const hero = $('[data-hero]');
        const mouseEls = $$('[data-mouse]');
        if (hero && mouseEls.length) {
            hero.addEventListener('pointermove', (e) => {
                const r = hero.getBoundingClientRect();
                const nx = (e.clientX - r.left) / r.width - 0.5;
                const ny = (e.clientY - r.top) / r.height - 0.5;
                mouseEls.forEach((el) => {
                    const amp = parseFloat(el.dataset.mouse) || 12;
                    el.style.setProperty('--mx', `${(nx * amp * 2).toFixed(1)}px`);
                    el.style.setProperty('--my', `${(ny * amp * 2).toFixed(1)}px`);
                });
            });
            hero.addEventListener('pointerleave', () => mouseEls.forEach((el) => { el.style.setProperty('--mx', '0px'); el.style.setProperty('--my', '0px'); }));
        }

        // Tilt 3D nos cards
        $$('[data-tilt]').forEach((el) => {
            const target = $('.member__card', el) || el;
            const max = target.classList.contains('member__card') ? 9 : 6;
            el.addEventListener('pointermove', (e) => {
                if (e.pointerType === 'touch') return;
                const r = target.getBoundingClientRect();
                const px = (e.clientX - r.left) / r.width;
                const py = (e.clientY - r.top) / r.height;
                target.style.transform = `perspective(900px) rotateX(${((0.5 - py) * max).toFixed(2)}deg) rotateY(${((px - 0.5) * max * 1.4).toFixed(2)}deg) translateZ(0)`;
            });
            el.addEventListener('pointerleave', () => { target.style.transform = ''; });
        });
    }
})();
