/**
 * Carbon Zapp — Global Components Loader
 * Injects nav, footer-cta, footer from shared HTML files.
 * Sets active nav state based on current page.
 * Initialises nav scroll behaviour and mega menu hover.
 */

(function() {

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
      const exactMatch = href === page || (page === '' && href === 'index.html');
      // Match all solutions-*.html pages to the solutions.html nav link
      const solutionsMatch = href === 'solutions.html' && page.startsWith('solutions');
      if (exactMatch || solutionsMatch) {
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

  // ── Mega menu hover (CSS-driven, no JS needed) ──
  // Login dropdown
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

  // ── Load order: nav first, then footer-cta + footer ──
  function loadComponents() {
    const navPlaceholder = document.querySelector('#nav-placeholder');
    const footerCtaPlaceholder = document.querySelector('#footer-cta-placeholder');
    const footerPlaceholder = document.querySelector('#footer-placeholder');

    let pending = 0;
    function done() {
      pending--;
      if (pending === 0) {
        setActiveNav();
        initNavScroll();
        initLoginDropdown();
      }
    }

    if (navPlaceholder) {
      pending++;
      fetch('_nav.html')
        .then(r => r.text())
        .then(html => {
          navPlaceholder.outerHTML = html;
          done();
        });
    }

    if (footerCtaPlaceholder) {
      pending++;
      fetch('_footer-cta.html')
        .then(r => r.text())
        .then(html => { footerCtaPlaceholder.outerHTML = html; done(); });
    }

    if (footerPlaceholder) {
      pending++;
      fetch('_footer.html')
        .then(r => r.text())
        .then(html => { footerPlaceholder.outerHTML = html; done(); });
    }

    if (pending === 0) {
      setActiveNav();
      initNavScroll();
      initLoginDropdown();
    }
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', loadComponents);
  } else {
    loadComponents();
  }

})();
