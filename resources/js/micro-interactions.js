/**
 * Mobile Micro-Interactions
 * - Ripple effect pada semua tombol & link interaktif
 * - Haptic feedback (vibration API) untuk konfirmasi touch
 * - Touch highlight & pressed states
 * - Double-tap prevention untuk form submit
 */

// ─── Ripple Effect ──────────────────────────────────────────────────────────

function createRipple(element, event) {
    // Hapus ripple lama jika ada
    const existingRipple = element.querySelector('.touch-ripple');
    if (existingRipple) existingRipple.remove();

    const rect = element.getBoundingClientRect();
    const touch = event.touches?.[0] || event;
    const x = (touch.clientX ?? touch.pageX) - rect.left;
    const y = (touch.clientY ?? touch.pageY) - rect.top;

    const size = Math.max(rect.width, rect.height) * 2.2;

    const ripple = document.createElement('span');
    ripple.classList.add('touch-ripple');
    ripple.style.cssText = `
        position: absolute;
        width: ${size}px;
        height: ${size}px;
        left: ${x - size / 2}px;
        top: ${y - size / 2}px;
        border-radius: 50%;
        pointer-events: none;
        z-index: 9999;
        transform: scale(0);
        opacity: 0.25;
        animation: touch-ripple-anim 0.5s cubic-bezier(0.4, 0, 0.2, 1) forwards;
    `;

    // Warna ripple berdasarkan context
    if (element.closest('.bg-indigo-600, [class*="bg-indigo"], [class*="bg-blue"]') ||
        element.classList.contains('bg-indigo-600') ||
        element.classList.contains('bg-blue-600')) {
        ripple.style.background = 'rgba(255,255,255,0.4)';
    } else if (element.closest('#mobile-bottom-nav') || element.closest('nav')) {
        ripple.style.background = 'rgba(59,130,246,0.3)';
    } else {
        ripple.style.background = 'rgba(0,0,0,0.08)';
    }

    // Pastikan element punya relative/overflow hidden
    const pos = window.getComputedStyle(element).position;
    if (pos === 'static') element.style.position = 'relative';
    element.style.overflow = 'hidden';

    element.appendChild(ripple);
    setTimeout(() => ripple.remove(), 600);
}

// ─── Haptic Feedback ────────────────────────────────────────────────────────

function haptic(type = 'light') {
    if (!navigator.vibrate) return;
    const patterns = {
        light:   [8],
        medium:  [15],
        heavy:   [25],
        success: [10, 50, 10],
        error:   [30, 40, 30],
        double:  [5, 30, 5],
    };
    navigator.vibrate(patterns[type] || patterns.light);
}

// ─── Selectors: elemen yang dapat micro-interaction ─────────────────────────

const INTERACTIVE_SELECTORS = [
    'button:not([data-no-ripple])',
    'a[href]:not([data-no-ripple]):not([href^="http"]):not([href^="//"])',
    '[role="button"]:not([data-no-ripple])',
    '.btn-primary',
    '.btn-secondary',
    'label[for]',
    '[data-ripple]',
].join(', ');

// ─── Apply interaction ke elemen baru (Livewire-safe) ───────────────────────

function applyMicroInteractions(root = document) {
    root.querySelectorAll(INTERACTIVE_SELECTORS).forEach(el => {
        if (el.dataset.microApplied) return;
        el.dataset.microApplied = '1';

        // Touch start → ripple + haptic
        el.addEventListener('touchstart', (e) => {
            createRipple(el, e);
            // Cek apakah link navigasi atau tombol submit
            if (el.tagName === 'A' || el.getAttribute('wire:navigate') !== null) {
                haptic('light');
            } else if (el.type === 'submit' || el.classList.contains('btn-primary')) {
                haptic('medium');
            } else {
                haptic('light');
            }
        }, { passive: true });

        // Klik dengan mouse juga dapat ripple
        el.addEventListener('mousedown', (e) => {
            if (e.pointerType === 'touch') return; // skip jika sudah dari touch
            createRipple(el, e);
        });
    });
}

// ─── Tombol Konfirmasi (form submit) — cegah double tap ─────────────────────

function applySubmitGuard(root = document) {
    root.querySelectorAll('button[type="submit"], input[type="submit"]').forEach(btn => {
        if (btn.dataset.submitGuard) return;
        btn.dataset.submitGuard = '1';

        btn.addEventListener('click', () => {
            haptic('medium');
            // Tampilkan efek loading sebentar
            const originalText = btn.innerHTML;
            btn.style.pointerEvents = 'none';
            btn.style.opacity = '0.7';
            setTimeout(() => {
                btn.style.pointerEvents = '';
                btn.style.opacity = '';
            }, 1500);
        });
    });
}

// ─── Accordion items ─────────────────────────────────────────────────────────

function applyAccordionFeedback(root = document) {
    root.querySelectorAll('[x-on\\:click], [\\@click]').forEach(el => {
        if (el.dataset.accordionMicro) return;
        if (!el.closest('.accordion, [x-data]')) return;
        el.dataset.accordionMicro = '1';
        el.addEventListener('touchend', () => haptic('double'), { passive: true });
    });
}

// ─── Init & Livewire re-init ─────────────────────────────────────────────────

function initAll() {
    applyMicroInteractions();
    applySubmitGuard();
}

document.addEventListener('DOMContentLoaded', initAll);

// Re-apply setelah Livewire navigate (SPA)
document.addEventListener('livewire:navigated', initAll);

// Re-apply setelah Livewire update component
document.addEventListener('livewire:update', initAll);

// MutationObserver untuk elemen yang ditambahkan secara dinamis (Alpine.js)
const observer = new MutationObserver((mutations) => {
    mutations.forEach(mutation => {
        mutation.addedNodes.forEach(node => {
            if (node.nodeType === 1) applyMicroInteractions(node);
        });
    });
});

observer.observe(document.body, { childList: true, subtree: true });

// ─── Export haptic untuk dipakai di Alpine.js ───────────────────────────────
window.haptic = haptic;
