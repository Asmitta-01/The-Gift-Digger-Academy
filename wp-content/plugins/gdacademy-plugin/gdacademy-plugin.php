<?php

/**
 * Plugin Name: Gift Digger Academy Plugin
 * Description: A piece of code to generate data for the video calls
 * Author: Brayan Tiwa
 * Author URI: https://asmitta-01.github.io
 * Version: 0.1.0
 */


function createJWTToken()
{
    if (!is_user_logged_in())
        return;

    $user = wp_get_current_user();
    require_once __DIR__ . '/jaas-jwt.php';
    echo generate_jwt_token($user);
}
add_action('create-jwt-token', 'createJWTToken');
