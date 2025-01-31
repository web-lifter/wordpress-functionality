<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php
    global $wp;
    $current_url = home_url(add_query_arg(array(), $wp->request));
    ?>

    <link rel="canonical" href="<?php echo esc_url($current_url); ?>">
    <link rel="alternate" hreflang="en-au" href="<?php echo esc_url($current_url); ?>">
    <link rel="alternate" hreflang="x-default" href="<?php echo esc_url($current_url); ?>">

    <?php wp_head(); ?>
</head>
</html>
