<?php
function alicart_print_button($content)
{
        $alicartAddButtonName = get_option('alicart_add_button_name');    
        if (!$alicartAddButtonName || ($alicartAddButtonName == '') )
            $alicartAddButtonName = '添至购物车';
            	
        $shortCodePattern = '#\[alicart:.+:price:.+:end]#';
        preg_match_all ($shortCodePattern, $content, $matches);

        foreach ($matches[0] as $match)
        {   
        	$var_output = '';
            $pos = strpos($match,":var1");
			if ($pos)
			{				
				$match_tmp = $match;
				$pos2 = strpos($match,":var2");
				if ($pos2)
				{
					$pattern = '#var2\[.*]:#';
				    preg_match_all ($shortCodePattern, $match_tmp, $matches3);
				    $match3 = $matches3[0][0];
				    $match_tmp = str_replace ($match3, '', $match_tmp);
				    
				    $shortCodePattern = 'var2[';
				    $m3 = str_replace ($shortCodePattern, '', $match3);
				    $shortCodePattern = ']:';
				    $m3 = str_replace ($shortCodePattern, '', $m3);  
				    $pieces3 = explode('|',$m3);
			
				    $variation2_name = $pieces3[0];
				    $var_output .= $variation2_name." : ";
				    $var_output .= '<select name="variation2" onchange="ReadForm (this.form, false);">';
				    for ($i=1;$i<sizeof($pieces3); $i++)
				    {
				    	$var_output .= '<option value="'.$pieces3[$i].'">'.$pieces3[$i].'</option>';
				    }
				    $var_output .= '</select><br />';				    
				}				
			    
			    $shortCodePattern = '#var1\[.*]:#';
			    preg_match_all ($shortCodePattern, $match_tmp, $matches2);
			    $match2 = $matches2[0][0];

			    $match_tmp = str_replace ($match2, '', $match_tmp);

				    $shortCodePattern = 'var1[';
				    $m2 = str_replace ($shortCodePattern, '', $match2);
				    $shortCodePattern = ']:';
				    $m2 = str_replace ($shortCodePattern, '', $m2);  
				    $pieces2 = explode('|',$m2);
			
				    $variation_name = $pieces2[0];
				    $var_output .= $variation_name." : ";
				    $var_output .= '<select name="variation1" onchange="ReadForm (this.form, false);">';
				    for ($i=1;$i<sizeof($pieces2); $i++)
				    {
				    	$var_output .= '<option value="'.$pieces2[$i].'">'.$pieces2[$i].'</option>';
				    }
				    $var_output .= '</select><br />';				

			}

            $shortCodePattern = '[alicart:';
            $m = str_replace ($shortCodePattern, '', $match);
            
            $shortCodePattern = 'price:';
            $m = str_replace ($shortCodePattern, '', $m);
            $shortCodePattern = 'shipping:';
            $m = str_replace ($shortCodePattern, '', $m);
            $shortCodePattern = ':end]';
            $m = str_replace ($shortCodePattern, '', $m);

            $pieces = explode(':',$m);
    
                $replacement = '<object><form method="post"  action="" style="display:inline" onsubmit="return ReadForm(this, true);">';             
                if (!empty($var_output))
                {
                	$replacement .= $var_output;
                }
				                
				if (preg_match("/http/", $alicartAddButtonName))
				{
				    $replacement .= '<input type="image" src="'.$alicartAddButtonName.'" class="wp_cart_button" alt="添至购物车"/>';
				} 
				else 
				{
				    $replacement .= '<input type="submit" class="alicart_button alicart_add_to_cart" value="'.$alicartAddButtonName.'" />';
				} 

                $replacement .= '<input type="hidden" name="product" value="'.$pieces['0'].'" /><input type="hidden" name="price" value="'.$pieces['1'].'" />';
                $replacement .= '<input type="hidden" name="product_tmp" value="'.$pieces['0'].'" />';
                if (sizeof($pieces) >2 )
                {
                	$replacement .= '<input type="hidden" name="shipping" value="'.$pieces['2'].'" />';
                }
                $replacement .= '<input type="hidden" name="alicart_cartlink" value="'.alicart_current_page_url().'" />';
                $replacement .= '<input type="hidden" name="alicart_addtocart" value="1" /></form></object>';
                $content = str_replace ($match, $replacement, $content);                
        }
        return $content;	
}
add_filter('the_content', 'alicart_print_button',11);

function alicart_print_button_for_product($name, $price, $shipping=0)
{
        $alicartAddButtonName = get_option('alicart_add_button_name');
    
        if (!$alicartAddButtonName || ($alicartAddButtonName == '') )
            $alicartAddButtonName = '添至购物车';

        $replacement = '<object><form method="post"  action="" style="display:inline">';
		
		//若设置按钮名称
		if (preg_match("/http:/", $alicartAddButtonName))
		{
			$replacement .= '<input type="submit" class="alicart_button" value="'.$alicartAddButtonName.'" />';
		} 
		else 
		{
		    $replacement .= '<input type="submit" class="alicart_button alicart_add_to_cart" value="'.$alicartAddButtonName.'" />';
		}             	      

        $replacement .= '<input type="hidden" name="product" value="'.$name.'" /><input type="hidden" name="price" value="'.$price.'" /><input type="hidden" name="shipping" value="'.$shipping.'" /><input type="hidden" name="alicart_addtocart" value="1" /><input type="hidden" name="alicart_cartlink" value="'.alicart_current_page_url().'" /></form></object>';
                
        return $replacement;
}

function alicart_current_page_url() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}
?>