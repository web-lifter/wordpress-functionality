<!DOCTYPE html>
<html <?php if (!is_noindex()) echo 'lang="en"'; ?>>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php
    global $wp;
    $current_url = home_url(add_query_arg(array(), $wp->request));

    // Function to check for a noindex meta tag in the page's head section
    function is_noindex() {
        ob_start();
        wp_head(); // Capture head output
        $head_content = ob_get_clean();

        return (strpos($head_content, '<meta name="robots" content="noindex"') !== false);
    }

    if (!is_noindex()) {
        $translations = array(
            'en-au' => 'https://example.com/',  // English (Australia)
            'fr'    => 'https://example.com/fr/', // French
            'de'    => 'https://example.com/de/', // German
            'es'    => 'https://example.com/es/'  // Spanish
        );

        foreach ($translations as $lang => $url) {
            echo '<link rel="alternate" hreflang="' . esc_attr($lang) . '" href="' . esc_url($url) . '">' . "\n";
        }

        echo '<link rel="alternate" hreflang="x-default" href="' . esc_url($translations['en-au']) . '">' . "\n";
    }
    ?>

    <?php wp_head(); ?>
</head>
</html>
