// Constants
const CACHE_EXPIRATION_TIME = 24 * 60 * 60 * 1000; // 24 hours in milliseconds

// Prefetch whitelist (currently empty, can be populated dynamically or manually)
const PREFETCH_WHITELIST = [];

// Debounce function to limit the frequency of function execution
function debounce(func, delay) {
    let timeout;
    return function (...args) {
        clearTimeout(timeout);
        timeout = setTimeout(() => func.apply(this, args), delay);
    };
}

// Utility function to preload assets (CSS or JS)
function preloadAsset(href, type) {
    if (!href || !type) return;

    const link = document.createElement('link');
    link.rel = 'preload';
    link.as = type; // 'script' for JS, 'style' for CSS
    link.href = href;

    // Add type attribute for CSS files (for compatibility)
    if (type === 'style') {
        link.type = 'text/css';
    }

    document.head.appendChild(link);
}

// Prefetch assets on hover for whitelisted links
document.addEventListener(
    'mouseover',
    debounce(async function (event) {
        // Ensure feature detection for fetch and DOMParser
        if (!('fetch' in window) || !('DOMParser' in window)) {
            console.warn('Browser does not support fetch or DOMParser.');
            return;
        }

        const link = event.target.closest('a');
        if (link && link.href && link.origin === window.location.origin) {
            const path = new URL(link.href).pathname;

            // Prefetch only if the link is in the whitelist and not already cached
            if (PREFETCH_WHITELIST.includes(path) && !sessionStorage.getItem(link.href)) {
                try {
                    const response = await fetch(link.href);
                    const html = await response.text();

                    // Parse the HTML to find CSS and JS files
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');

                    // Preload CSS
                    doc.querySelectorAll('link[rel="stylesheet"]').forEach(stylesheet => {
                        preloadAsset(stylesheet.href, 'style');
                    });

                    // Preload JS
                    doc.querySelectorAll('script[src]').forEach(script => {
                        preloadAsset(script.src, 'script');
                    });

                    // Log analytics for successful prefetch
                    console.log(`Preloaded: ${link.href}`);
                } catch (error) {
                    console.error('Error preloading page:', error);
                }
            }
        }
    }, 300)
);

// Cache the HTML content on click
document.addEventListener('click', function (event) {
    const link = event.target.closest('a');
    if (link && link.href && link.origin === window.location.origin) {
        window.addEventListener('load', () => {
            fetch(link.href)
                .then(response => response.text())
                .then(html => {
                    const cacheData = {
                        html: html,
                        timestamp: Date.now() // Store current time
                    };
                    sessionStorage.setItem(link.href, JSON.stringify(cacheData));

                    // Log analytics for cached page
                    console.log(`Stored in cache: ${link.href}`);
                })
                .catch(error => console.error('Error storing page:', error));
        });
    }
});

// Clean old cache periodically
function cleanOldCache() {
    const now = Date.now();
    for (let key in sessionStorage) {
        try {
            const cacheData = JSON.parse(sessionStorage.getItem(key));
            if (cacheData && cacheData.timestamp && now - cacheData.timestamp > CACHE_EXPIRATION_TIME) {
                sessionStorage.removeItem(key);

                // Log analytics for removed cache
                console.log(`Removed expired cache: ${key}`);
            }
        } catch (e) {
            // Skip non-JSON items
        }
    }
}

// Run cache cleanup every hour
setInterval(cleanOldCache, 60 * 60 * 1000); // 1 hour interval

// Customizable logic: Dynamically add links to the whitelist
function addToWhitelist(paths) {
    if (Array.isArray(paths)) {
        paths.forEach(path => {
            if (!PREFETCH_WHITELIST.includes(path)) {
                PREFETCH_WHITELIST.push(path);
                console.log(`Added to whitelist: ${path}`);
            }
        });
    }
}

// Example usage of dynamic whitelist addition
addToWhitelist(['/example-page', '/another-page']);

// Progressive enhancement: Notify if the browser lacks required features
if (!('fetch' in window) || !('DOMParser' in window)) {
    console.warn('Your browser does not support all required features for optimal performance.');
}
