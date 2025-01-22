<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php
    // Define hreflang mappings for all page versions
    $hreflang_mappings = [
        'en' => '', // English (to be dynamically set for each page)
        'x-default' => 'https://weblifter.com.au' // Default homepage
    ];

    // Get the current page's URL without trailing slash
    $current_url = rtrim(get_permalink(), '/');

    // Build the hreflang mappings dynamically for the current page
    foreach ($hreflang_mappings as $lang => &$url) {
        if ($lang === 'en') {
            $url = $current_url; // Dynamically set current page for English
        }
    }

    // Output hreflang annotations for all page versions
    foreach ($hreflang_mappings as $lang => $url) {
        echo '<link rel="alternate" hreflang="' . esc_attr($lang) . '" href="' . esc_url($url) . '" />' . "\n";
    }
    ?>

    <?php wp_head(); ?>
</head>
</html>
