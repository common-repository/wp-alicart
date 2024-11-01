<?php
function alicart_style()
{
    echo '<link type="text/css" rel="stylesheet" href="'.ALICART_URL.'/alicart_style.css" />'."\n";
	echo '<link type="text/css" rel="stylesheet" href="'.ALICART_URL.'/styles/alicart_style_orange.css" />'."\n";
}

add_action('wp_head', 'alicart_style');
?>