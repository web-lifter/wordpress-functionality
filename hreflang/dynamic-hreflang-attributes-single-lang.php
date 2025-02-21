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
    ?>

    <link rel="canonical" href="<?php echo esc_url($current_url); ?>">

    <?php if (!is_noindex()) : ?>
        <link rel="alternate" hreflang="en-au" href="<?php echo esc_url($current_url); ?>">
        <link rel="alternate" hreflang="x-default" href="<?php echo esc_url($current_url); ?>">
    <?php endif; ?>

    <?php wp_head(); ?>
</head>
</html>
