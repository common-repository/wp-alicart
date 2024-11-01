<?php
function alicart_show_mycart_tags($content)
{
	if (strpos($content, "<!--show-ali-mycart-->") !== false)
    {
    	if (cart_not_empty())
    	{
        	$content = preg_replace('/<p>\s*<!--(.*)-->\s*<\/p>/i', "<!--$1-->", $content);
        	$matchingText = '<!--show-ali-mycart-->';
        	$replacementText = alicart_print_mycart();
        	$content = str_replace($matchingText, $replacementText, $content);
    	}
    }
    return $content;
}

add_filter('the_content', 'alicart_show_mycart_tags');
?>