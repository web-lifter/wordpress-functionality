<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php
    global $wp;
    $current_url = home_url(add_query_arg(array(), $wp->request));

    $translations = array(
        'en-au' => 'https://example.com/',  // English (Australia)
        'fr'    => 'https://example.com/fr/', // French
        'de'    => 'https://example.com/de/', // German
        'es'    => 'https://example.com/es/'  // Spanish
    );

    foreach ($translations as $lang => $url) {
        echo '<link rel="alternate" hreflang="' . esc_attr($lang) . '" href="' . esc_url($url) . '">' . "\n";
    }
    ?>

    <link rel="alternate" hreflang="x-default" href="<?php echo esc_url($translations['en-au']); ?>">


    <?php wp_head(); ?>
</head>
</html>
