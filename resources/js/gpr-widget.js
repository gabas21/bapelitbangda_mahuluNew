/**
 * GPR Widget Customizer
 * Forces white background and custom styling on the GPR Komdigi widget
 */
(function () {
    var WHITE = '#ffffff';
    var TEXT = '#334155';

    function forceWhite(el) {
        if (!el) return;
        el.style.setProperty('background-color', WHITE, 'important');
        el.style.setProperty('background', WHITE, 'important');
        el.style.setProperty('color', TEXT, 'important');
        el.style.removeProperty('border-radius');
        el.style.setProperty('border', 'none', 'important');
        el.style.setProperty('box-shadow', 'none', 'important');
        el.style.setProperty('outline', 'none', 'important');
    }

    function cleanWidget() {
        var ids = ['gpr-kominfo-widget-container',
            'gpr-kominfo-widget-header',
            'gpr-kominfo-widget-body',
            'gpr-kominfo-widget-footer'];
        ids.forEach(function (id) { forceWhite(document.getElementById(id)); });

        var body = document.getElementById('gpr-kominfo-widget-body');
        if (body) {
            body.style.setProperty('flex', '1 1 auto', 'important');
            body.style.setProperty('height', '100%', 'important');
            body.style.setProperty('max-height', 'none', 'important');
            body.style.setProperty('overflow-y', 'auto', 'important');
            body.style.setProperty('display', 'flex', 'important');
            body.style.setProperty('flex-direction', 'column', 'important');

            var ul = body.querySelector('ul');
            if (ul) {
                ul.style.setProperty('flex', '1 1 auto', 'important');
                ul.style.setProperty('max-height', 'none', 'important');
                ul.style.setProperty('height', '100%', 'important');
                ul.style.setProperty('margin', '0', 'important');
                ul.style.setProperty('padding-bottom', '10px', 'important');
            }
        }

        var wHeader = document.getElementById('gpr-kominfo-widget-header');
        if (wHeader) {
            wHeader.style.setProperty('display', 'none', 'important');
            wHeader.style.setProperty('height', '0', 'important');
        }

        var gprImages = document.querySelectorAll('#gpr-kominfo-widget-body ul li img');
        var defaultImgUrl = 'https://images.unsplash.com/photo-1577962917302-cd874462e648?q=80&w=400&auto=format&fit=crop';
        gprImages.forEach(function (img) {
            if (img.src !== defaultImgUrl) {
                img.src = defaultImgUrl;
            }
            img.style.setProperty('width', '64px', 'important');
            img.style.setProperty('height', '64px', 'important');
            img.style.setProperty('object-fit', 'cover', 'important');
            img.style.setProperty('border-radius', '12px', 'important');
            img.style.setProperty('padding', '0', 'important');
            img.style.setProperty('margin-right', '12px', 'important');

            var parent = img.parentElement;
            if (parent && parent.tagName.toLowerCase() === 'a' || parent.tagName.toLowerCase() === 'div') {
                parent.style.setProperty('background', 'transparent', 'important');
                parent.style.setProperty('padding', '0', 'important');
                parent.style.setProperty('border-radius', '0', 'important');
            }
        });

        var container = document.getElementById('gpr-kominfo-widget-container');
        if (container) {
            container.querySelectorAll('*').forEach(function (el) {
                if (el.tagName.toLowerCase() === 'img') return;
                var bg = el.style.backgroundColor || window.getComputedStyle(el).backgroundColor;
                if (!bg) return;
                var m = bg.match(/rgb\((\d+),\s*(\d+),\s*(\d+)\)/);
                if (m) {
                    var r = +m[1], g = +m[2], b = +m[3], total = r + g + b;
                    if (total < 350 && b >= r && b >= g) forceWhite(el);
                }
            });
        }
    }

    // Run immediately and repeatedly
    cleanWidget();
    [100, 500, 1000, 2000, 3500, 5000, 8000].forEach(function (ms) {
        setTimeout(cleanWidget, ms);
    });

    // MutationObserver
    var container = document.getElementById('gpr-kominfo-widget-container');
    if (container) {
        new MutationObserver(cleanWidget).observe(container, {
            attributes: true,
            attributeFilter: ['style'],
            childList: true,
            subtree: true
        });
    }
})();
