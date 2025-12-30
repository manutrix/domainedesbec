<?php

if (!defined('ABSPATH')) {
    exit;
}

// Prevent Revolution Slider from loading in wp-admin to avoid fatal errors
// that block access to the dashboard. Front-end remains unaffected.
if (!defined('WP_ADMIN') || WP_ADMIN !== true) {
    return;
}

$revslider_main = 'revslider/revslider.php';

add_filter('option_active_plugins', static function ($plugins) use ($revslider_main) {
    if (!is_array($plugins)) {
        return $plugins;
    }

    $plugins = array_values(array_filter($plugins, static function ($plugin) use ($revslider_main) {
        return $plugin !== $revslider_main;
    }));

    return $plugins;
});

// Multisite network-activated plugins
add_filter('site_option_active_sitewide_plugins', static function ($plugins) use ($revslider_main) {
    if (!is_array($plugins)) {
        return $plugins;
    }

    if (isset($plugins[$revslider_main])) {
        unset($plugins[$revslider_main]);
    }

    return $plugins;
});
