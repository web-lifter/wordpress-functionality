<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php
    // Define supported languages and their URL prefixes
    $hreflang_languages = [
        'en' => '',        // English (root domain)
        'fr' => '/fr',     // French
        'de' => '/de',     // German
        'x-default' => ''  // Default homepage (root domain, fallback)
    ];

    // Function to dynamically build language-specific URLs
    function get_language_url($lang_code, $prefix) {
        // Get the current page slug
        $current_slug = trim(parse_url(get_permalink(), PHP_URL_PATH), '/');
        
        // If the prefix is empty (e.g., 'en' or 'x-default'), return the root domain + slug
        if (empty($prefix)) {
            return home_url('/' . $current_slug);
        }
        
        // Otherwise, return the language-specific URL
        return home_url($prefix . '/' . $current_slug);
    }

    // Build hreflang mappings dynamically
    $hreflang_mappings = [];
    foreach ($hreflang_languages as $lang => $prefix) {
        $hreflang_mappings[$lang] = get_language_url($lang, $prefix);
    }

    // Output hreflang annotations
    foreach ($hreflang_mappings as $lang => $url) {
        echo '<link rel="alternate" hreflang="' . esc_attr($lang) . '" href="' . esc_url($url) . '" />' . "\n";
    }
    ?>

    <?php wp_head(); ?>
</head>
</html>
