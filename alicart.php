<?php
/*
Plugin Name: WP 支付宝购物车
Version: 1.1.5
Plugin URI: http://1tui8.com/blog/category/wp-alicart/
Author: 吉林壹推
Author URI: http://1tui8.com
Description: WP 支付宝购物车，设置简单，易于使用，是电子商务及网络营销的最佳选择。
*/
if(!isset($_SESSION)) 
{
@session_start();
}
$siteurl = get_option('siteurl');
define('ALICART_FOLDER', dirname(plugin_basename(__FILE__)));
define('ALICART_URL', get_option('siteurl').'/wp-content/plugins/' . ALICART_FOLDER);
add_option('alicart_title', '我的购物车');
add_option('alicart_empty', '购物车为空');
add_option('alipay_return_url', get_bloginfo('wpurl'));
include_once 'alicart_shortcodes.php';
include_once 'alicart_tags.php';
include_once 'alicart_reset_cart.php';
include_once 'alicart_print_cart.php';
include_once 'alicart_button.php';
include_once 'alicart_javascripts.php';
include_once 'alicart_options.php';
include_once 'alicart_widgets.php';
include_once 'alicart_styles.php';
?>