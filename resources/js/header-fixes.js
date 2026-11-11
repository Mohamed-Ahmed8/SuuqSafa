// Header JS fixes: stores dropdown toggle + robust cart navigation
// Capture unhandled promise rejections so errors like "Uncaught (in promise)" are visible
window.addEventListener('unhandledrejection', function(ev){
    try {
        console.error('Unhandled promise rejection:', ev.reason);
        var msg = ev.reason && ev.reason.message ? ev.reason.message : String(ev.reason);
        // show a small temporary overlay with the error
        var existing = document.getElementById('dev-debug-overlay');
        if (!existing) {
            var overlay = document.createElement('div');
            overlay.id = 'dev-debug-overlay';
            overlay.style.position = 'fixed';
            overlay.style.right = '10px';
            overlay.style.top = '10px';
            overlay.style.background = 'rgba(255,0,0,0.9)';
            overlay.style.color = 'white';
            overlay.style.padding = '8px 12px';
            overlay.style.zIndex = 99999;
            overlay.style.fontSize = '12px';
            overlay.style.borderRadius = '4px';
            overlay.textContent = 'Unhandled rejection: ' + msg;
            document.body.appendChild(overlay);
            setTimeout(function(){ try{ overlay.remove(); }catch(e){} }, 8000);
        } else {
            existing.textContent = 'Unhandled rejection: ' + msg;
            setTimeout(function(){ try{ existing.remove(); }catch(e){} }, 8000);
        }
    } catch (err) {
        // noop
    }
});

(function(){
    // Stores dropdown toggle: click to open/close and close when clicking outside
    document.addEventListener('click', function(e){
        try {
            var btn = document.getElementById('stores-toggle-btn');
            var dropdown = document.getElementById('stores-dropdown');
            if (!btn || !dropdown) return;

            if (btn.contains(e.target)) {
                var isHidden = dropdown.classList.contains('hidden');
                if (isHidden) {
                    dropdown.classList.remove('hidden');
                    btn.setAttribute('aria-expanded', 'true');
                } else {
                    dropdown.classList.add('hidden');
                    btn.setAttribute('aria-expanded', 'false');
                }
                return;
            }

            if (!dropdown.contains(e.target)) {
                dropdown.classList.add('hidden');
                if (btn) btn.setAttribute('aria-expanded', 'false');
            }
        } catch (err) {
            // noop
        }
    });

    // Ensure cart link navigation supersedes other click handlers
    (function(){
        try {
            var cartLink = document.getElementById('cart-link');
            if (!cartLink) return;
            cartLink.addEventListener('click', function(e){
                e.stopImmediatePropagation();
                // Dev: fetch session cart JSON for network debugging, then navigate
                try {
                    fetch('/dev/cart-debug', { credentials: 'same-origin' })
                        .then(function(res){ return res.json(); })
                        .then(function(json){
                            // Log product ids for quick visibility in console/network
                            var ids = Object.keys(json || {}).map(function(k){ return json[k].id; });
                            console.log('[dev/cart-debug] cart product ids:', ids, json);
                        })
                        .catch(function(err){
                            console.error('cart-debug fetch failed', err);
                            try { alert('dev/cart-debug fetch failed: ' + (err && err.message ? err.message : err)); } catch(e) {}
                            // show overlay as well
                            try {
                                var ex = document.getElementById('dev-debug-overlay');
                                if (!ex) {
                                    var o = document.createElement('div');
                                    o.id = 'dev-debug-overlay';
                                    o.style.position = 'fixed'; o.style.right = '10px'; o.style.top = '10px';
                                    o.style.background = 'rgba(255,0,0,0.9)'; o.style.color = 'white'; o.style.padding = '8px 12px';
                                    o.style.zIndex = 99999; o.style.fontSize = '12px'; o.style.borderRadius = '4px';
                                    o.textContent = 'cart-debug fetch failed: ' + (err && err.message ? err.message : String(err));
                                    document.body.appendChild(o);
                                    setTimeout(function(){ try{ o.remove(); }catch(e){} }, 8000);
                                } else {
                                    ex.textContent = 'cart-debug fetch failed: ' + (err && err.message ? err.message : String(err));
                                }
                            } catch(e) {}
                        })
                        .finally(function(){ window.location.href = e.currentTarget.href; });
                } catch (err) {
                    window.location.href = this.href;
                }
            }, {capture: true});

            cartLink.addEventListener('keydown', function(e){
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    e.stopImmediatePropagation();
                    window.location.href = this.href;
                }
            });
        } catch (err) {
            // noop
        }
    })();
    // Mobile search toggle: show small-panel and wire submit
    try {
        var msBtn = document.getElementById('mobile-search-btn');
        var msPanel = document.getElementById('mobile-search-panel');
        var msInput = document.getElementById('mobile-search-input');
        var msSubmit = document.getElementById('mobile-search-submit');

        if (msBtn && msPanel) {
            msBtn.addEventListener('click', function(e){
                var hidden = msPanel.classList.contains('hidden');
                if (hidden) {
                    msPanel.classList.remove('hidden');
                    msBtn.setAttribute('aria-expanded','true');
                    setTimeout(function(){ try{ if (msInput) msInput.focus(); }catch(e){} }, 50);
                } else {
                    msPanel.classList.add('hidden');
                    msBtn.setAttribute('aria-expanded','false');
                }
            });
        }

        if (msSubmit && msInput) {
            msSubmit.addEventListener('click', function(){
                var q = msInput.value || '';
                    window.location.href = '/search?q=' + encodeURIComponent(q);
            });
            msInput.addEventListener('keydown', function(e){
                if (e.key === 'Enter') {
                    e.preventDefault();
                    msSubmit.click();
                }
            });
        }
        // Desktop search wiring (same behavior as mobile)
        try {
            var dsInput = document.getElementById('desktop-search-input');
            var dsSubmit = document.getElementById('desktop-search-submit');
            if (dsSubmit && dsInput) {
                dsSubmit.addEventListener('click', function(){
                    var q = dsInput.value || '';
                        window.location.href = '/search?q=' + encodeURIComponent(q);
                });
                dsInput.addEventListener('keydown', function(e){
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        dsSubmit.click();
                    }
                });
            }
        } catch (err) {
            // noop
        }
    } catch (err) {
        // noop
    }
    // Refresh header/button: reload page when clicked
    try {
        var refreshBtn = document.getElementById('header-refresh-btn');
        if (refreshBtn) {
            refreshBtn.addEventListener('click', function(){
                try { window.location.reload(); } catch(e) { window.location.href = window.location.href; }
            });
        }
    } catch (err) {}
})();
