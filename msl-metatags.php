<?php
/*
Plugin Name: MetaTagsFromContent
Plugin URI: http://onlineservicetools.com/metatagsfromcontent-wordpress-plugin
Description: Allows to generate meta tags &#9664;title&#9654; and &#9664;description&#9654; right from the post content. Compatible with Yoast Seo and Multilanguage by BestWebSoft plugins.
Version: 1.0
Author: Maxim Liubarets
Author URI: http://hitmax.com.ua
License: GPLv2 GPLv2 or later
*/
include("functions.php");
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

add_filter('pre_get_document_title', 'msl_metatags_title', 100, 1);
add_filter((msl_metatags_is_yoast_active() ? 'wpseo_metadesc' : 'wp_head'),'msl_metatags_description',100,1);
add_action('admin_menu', 'msl_metatags_create_menu');
?>