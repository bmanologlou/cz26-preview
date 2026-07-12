/**
 * Carbon Zapp — Global Components Loader
 * Injects nav, footer-cta, footer from shared HTML files.
 * Sets active nav state based on current page.
 * Initialises nav scroll behaviour, mega menu hover, and newsletter drawer.
 */

(function() {

  function basePath() {
    return window.location.pathname.includes('/news/') ? '../' : '';
  }

  // ── Helper: fetch and inject HTML into a placeholder ──
  function inject(selector, url, callback) {
    const el = document.querySelector(selector);
    if (!el) return;
    fetch(url)
      .then(r => r.text())
      .then(html => {
        el.outerHTML = html;
        if (callback) callback();
      })
      .catch(err => console.warn('Component load failed:', url, err));
  }

  // ── Active nav link ──
  function setActiveNav() {
    const page = window.location.pathname.split('/').pop() || 'index.html';
    document.querySelectorAll('nav a').forEach(a => {
      const href = a.getAttribute('href') || '';
      const exactMatch = href === page || (page === '' && href === 'index.html') || (page === 'index.html' && href === 'index.html');
      const solutionsMatch = href === 'solutions.html' && page.startsWith('solutions');
      const homeMatch = href === 'index.html' && (page === '' || page === 'index.html');
      if (exactMatch || solutionsMatch || homeMatch) {
        a.classList.add('active');
      }
    });
  }

  // ── Nav scroll behaviour ──
  function initNavScroll() {
    const nav = document.querySelector('nav');
    if (!nav) return;
    function onScroll() {
      nav.classList.toggle('scrolled', window.scrollY > 80);
    }
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
  }

  // ── Login dropdown ──
  function initLoginDropdown() {
    const btn = document.querySelector('.login-btn');
    const dropdown = document.querySelector('.login-dropdown');
    if (!btn || !dropdown) return;
    btn.addEventListener('click', e => {
      e.stopPropagation();
      dropdown.classList.toggle('open');
    });
    document.addEventListener('click', () => dropdown.classList.remove('open'));
  }

  // ── Newsletter drawer ──
  function initNewsletterDrawer() {
    if (window.__czNewsletterInit) return;
    window.__czNewsletterInit = true;

    function openNewsletterDrawer() {
      document.body.classList.add('nl-drawer-open');
      document.documentElement.classList.add('nl-drawer-open');
      document.documentElement.style.overflow = 'hidden';
    }

    function closeNewsletterDrawer() {
      document.body.classList.remove('nl-drawer-open');
      document.documentElement.classList.remove('nl-drawer-open');
      document.documentElement.style.overflow = '';
    }

    var newsletterBtn = document.getElementById('nl-btn-mobile');
    if (newsletterBtn) {
      newsletterBtn.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        openNewsletterDrawer();
      });
    }

    var drawerClose = document.getElementById('nl-drawer-close');
    if (drawerClose) {
      drawerClose.addEventListener('click', closeNewsletterDrawer);
    }

    var drawerOverlay = document.getElementById('nl-drawer-overlay');
    if (drawerOverlay) {
      drawerOverlay.addEventListener('click', closeNewsletterDrawer);
    }

    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape') {
        closeNewsletterDrawer();
      }
    });
  }

  function ensureNewsletterDrawer(done) {
    if (document.getElementById('nl-drawer-panel')) {
      initNewsletterDrawer();
      if (done) done();
      return;
    }
    fetch(basePath() + '_newsletter-drawer.html')
      .then(r => r.text())
      .then(html => {
        document.body.insertAdjacentHTML('beforeend', html);
        initNewsletterDrawer();
        if (done) done();
      })
      .catch(err => console.warn('Newsletter drawer load failed:', err));
  }

  function finishInit() {
    setActiveNav();
    initNavScroll();
    initLoginDropdown();
    ensureNewsletterDrawer();
  }

  // ── Load order: nav first, then footer-cta + footer ──
  function loadComponents() {
    const navPlaceholder = document.querySelector('#nav-placeholder');
    const footerCtaPlaceholder = document.querySelector('#footer-cta-placeholder');
    const footerPlaceholder = document.querySelector('#footer-placeholder');

    let pending = 0;
    function done() {
      pending--;
      if (pending === 0) {
        finishInit();
      }
    }

    const prefix = basePath();

    if (navPlaceholder) {
      pending++;
      fetch(prefix + '_nav.html')
        .then(r => r.text())
        .then(html => {
          navPlaceholder.outerHTML = html;
          done();
        });
    }

    if (footerCtaPlaceholder) {
      pending++;
      fetch(prefix + '_footer-cta.html')
        .then(r => r.text())
        .then(html => { footerCtaPlaceholder.outerHTML = html; done(); });
    }

    if (footerPlaceholder) {
      pending++;
      fetch(prefix + '_footer.html')
        .then(r => r.text())
        .then(html => { footerPlaceholder.outerHTML = html; done(); });
    }

    if (pending === 0) {
      finishInit();
    }
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', loadComponents);
  } else {
    loadComponents();
  }

})();
