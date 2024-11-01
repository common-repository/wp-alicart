<?php
function alicart_always_show_mycart_handler($atts) 
{
	return alicart_print_mycart();
}

function alicart_show_mycart_handler()
{
    if (alicart_not_empty())
    {
       	$output = alicart_print_mycart();
    } else {
		$output = '您的购物车还是空的，赶紧行动吧！您可以：<br />马上去 <a rel="nofollow" href="'.get_option('alicart_products_page_url').'">挑选商品</a>';
	}
    return $output;	
}

function alicart_checkout_handler()
{
    if (alicart_not_empty())
    {
       	$output = alicart_checkout();
    } else {
		$output = '<script>history.back();</script>';
	}
    return $output;	
}

add_shortcode('alicart_show_mycart', 'alicart_show_mycart_handler');
add_shortcode('alicart_show_checkout', 'alicart_checkout_handler');
add_shortcode('alicart_always_show_mycart', 'alicart_always_show_mycart_handler');
?>