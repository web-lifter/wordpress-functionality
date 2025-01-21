<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php
    // Get the current page URL
    $current_url = home_url(add_query_arg(null, null));

    // Ensure home_url does not add a trailing slash
    $root_url = rtrim(home_url(), '/');

    // Define the hreflang tags
    $hreflangs = [
        'x-default' => $root_url, // x-default points to your homepage
        'en-au' => $current_url, // English (Australia)
        'en' => $current_url // Generic English
    ];

    // Output the hreflang tags
    foreach ($hreflangs as $lang => $url) {
        echo '<link rel="alternate" hreflang="' . esc_attr($lang) . '" href="' . esc_url($url) . '" />' . "\n";
    }
    ?>

    <?php wp_head(); ?>
</head>
</html>
