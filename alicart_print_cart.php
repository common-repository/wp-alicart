<?php
function alicart_print_payment_currency($price, $symbol, $decimal)
{
    return $symbol.number_format($price, 2, $decimal, ',');
}

function alicart_not_empty()
{
	$count = 0;
	if (isset($_SESSION['wpAlicart']) && is_array($_SESSION['wpAlicart']))
	{
		foreach ($_SESSION['wpAlicart'] as $item)
			$count++;
		return $count;
	}
	else
		return 0;
}

function alicart_sidebar_widget()
{
	if (!alicart_not_empty())
	{
		$alicart_print_empty_text = get_option('alicart_empty');
		if (!empty($alicart_print_empty_text)) 
		{
			if (preg_match("/http/", $alicart_print_empty_text))
			{
				$output .= '<img src="'.$alicart_print_empty_text.'" />';
			}
			else
			{
				$output .= $alicart_print_empty_text;
			}
		}
		$alicartProductsPageURL = get_option('alicart_products_page_url');
		if (!empty($alicartProductsPageURL))
		{
			$output .= '<br />马上去 <a rel="nofollow" href="'.$alicartProductsPageURL.'">挑选商品</a>';
		}		
		return $output;
	}
     
    $decimal = '.';  
	
	$alicartTitle = get_option('alicart_title');
    
    global $plugin_dir_name;
    $output .= '<div class="wp_alipay_shopping_cart">';
    if (!get_option('alicart_image_hide'))    
    {
    	$output .= "<img src='".ALICART_URL."/images/alipay_cart_icon.png' value='Cart' title='购物车' />";
    }
    
    $count = 1;
    $total_items = 0;
    $total = 0;
    $form = '';
    if ($_SESSION['wpAlicart'] && is_array($_SESSION['wpAlicart']))
    {  
		$alipay_cart_print_not_empty_text = get_option('alicart_not_empty');
	    if (!empty($alipay_cart_print_not_empty_text)) {
			$output .= $alipay_cart_print_not_empty_text;
		}
	    $output .= '<table style="width: 100%;">';
    
	    foreach ($_SESSION['wpAlicart'] as $item)
	    {
	        $total += $item['price'] * $item['quantity'];
	        $item_total_shipping += $item['shipping'] * $item['quantity'];
	        $total_items +=  $item['quantity'];
			$count++;
	    }
    }
		
		$count--;
		
		if ($count)
		{
			$output .= "
			<tr>
			<td>购物车共有<span style='font-weight: bold;'>".$count."</span>种商品<br />合计&nbsp;<span class='total-text-2 text-shadow'>".alicart_print_payment_currency($total, '&#165;', $decimal)."</span>&nbsp;元</td>
<!--			<td>".alicart_print_payment_currency($total, '&#165;', $decimal)."&nbsp;元</td>
			<td><form method=\"post\"  action=\"\">
			<input type='hidden' name='clecart' value='1' />
			<input type='image' src='".ALICART_URL."/images/alipay_cart_delete.png' value='Remove' title='清空购物车' /></form></td>-->
			</tr>
			<tr>
			<td>";
				$output .= "<form action=\"".get_option('alicart_my_cart')."\" method=\"post\">$form";
				if ($count)
					$output .= '<input type="submit" class="alicart_button alicart_go_my_cart" value="去购物车结算" />';
				$output .= '</form>';
		}
       	$output .= "       
       	</td></tr>
    	</table></div>
    	";
		
    return $output;
}

function alicart_print_mycart()
{     
    $decimal = '.';  
	$urls = '';
        
    $return = get_option('alipay_return_url');
            
    if (!empty($return))
        $urls .= '<input type="hidden" name="return" value="'.$return.'" />';
	
	if ($use_affiliate_platform)  
	{
		if (function_exists('wp_aff_platform_install'))
		{
			$notify = ALICART_URL.'/alipay.php';
			$urls .= '<input type="hidden" name="notify_url" value="'.$notify.'" />';
		}
	}
	$alicartTitle = get_option('alicart_title');
    
    global $plugin_dir_name;
    $output .= '<div class="wp_alipay_shopping_cart" style=" padding: 5px;">';
    if (!get_option('alicart_image_hide'))    
    {
    	$output .= "<img src='".ALICART_URL."/images/alipay_cart_icon.png' value='Cart' title='购物车' />";
    }
	if(!empty($alicartTitle))
	{
		$output .= '<h2>';
		$output .= $alicartTitle;  
		$output .= '</h2>';
	}
        
    $output .= '<br /><span id="pinfo" style="display: none; font-weight: bold; color: red;">按下回车键添加商品</span>';
	$output .= '<table style="width: 100%;">';    
    
    $count = 1;
    $total_items = 0;
    $total = 0;
    $form = '';
    if ($_SESSION['wpAlicart'] && is_array($_SESSION['wpAlicart']))
    {   
        $output .= '
        <tr>
        <th style="text-align: left">商品名称</th><th>数量</th><th>单价</th><th>小计</th><th style="text-align: right;"></th>
        </tr>';
    
	    foreach ($_SESSION['wpAlicart'] as $item)
	    {
	        $total += $item['price'] * $item['quantity'];
	        $item_total_shipping += $item['shipping'] * $item['quantity'];
	        $total_items +=  $item['quantity'];
	    }
	    $alicartBaseShippingCost = get_option('alicart_base_shipping_cost');
	    $postage_cost = $item_total_shipping + $alicartBaseShippingCost;
	    $alicartFreeShippingThreshold = get_option('alicart_free_shipping_threshold');
	    if (!empty($alicartFreeShippingThreshold) && $total > $alicartFreeShippingThreshold)
	    {
	    	$postage_cost = 0;
	    }

	    foreach ($_SESSION['wpAlicart'] as $item)
	    {
	        $output .= "
	        <tr><td style='overflow: hidden;'><a class='cart-link-1' href='".$item['alicart_cartlink']."'>".$item['name']."</a></td>
	        <td><form method=\"post\"  action=\"\" name='pcquantity' style='display: inline'>
                <input type=\"hidden\" name=\"product\" value=\"".$item['name']."\" />

	        <input type='hidden' name='cquantity' value='1' /><input type='text' name='quantity' value='".$item['quantity']."' size='1' onchange='document.pcquantity.submit();' onkeypress='document.getElementById(\"pinfo\").style.display = \"\";' /></form></td>
	        <td>".alicart_print_payment_currency($item['price'], '&#165;', $decimal)."&nbsp;元</td>
			<td>".alicart_print_payment_currency(($item['price'] * $item['quantity']), '&#165;', $decimal)."&nbsp;元</td>
	        <td style='text-align: right;'><form method=\"post\"  action=\"\">
	        <input type=\"hidden\" name=\"product\" value=\"".$item['name']."\" />
	        <input type='hidden' name='delcart' value='1' />
	        <input type='image' src='".ALICART_URL."/images/alipay_cart_delete.png' value='Remove' title='删除' /></form></td></tr>
	        ";
	        
	        $form .= "
	            <input type=\"hidden\" name=\"item_name_$count\" value=\"".$item['name']."\" />
	            <input type=\"hidden\" name=\"amount_$count\" value='".$item['price']."' />
	            <input type=\"hidden\" name=\"quantity_$count\" value=\"".$item['quantity']."\" />
	            <input type='hidden' name='item_number' value='".$item['item_number']."' />
	        ";
			
			$body_content .= $item['name'].",";
			     
	        $count++;
	    }
	    if (!get_option('alipay_cart_use_profile_shipping'))
	    {
	    	$form .= "<input type=\"hidden\" name=\"shipping_1\" value='".$postage_cost."' />";  
	    }
	    if (get_option('alipay_cart_collect_address'))
	    {
	    	$form .= "<input type=\"hidden\" name=\"no_shipping\" value=\"2\" />";  
	    }	    	    
    }
    
       	$count--;
       	
       	if ($count)
       	{
            if ($postage_cost != 0)
            {
                $output .= "
                <tr><td colspan='4' style='font-weight: bold;'></td><td>小计：".alicart_print_payment_currency($total, '&#165;', $decimal)."&nbsp;元</td></tr>
                <tr><td colspan='4' style='font-weight: bold;'></td><td>运费：".alicart_print_payment_currency($postage_cost, '&#165;', $decimal)."&nbsp;元</td></tr>";
            }

            $output .= "
       		<tr><td colspan='5' style='text-align: right;'>商品总价：<span class='total-text-1 text-shadow'>".alicart_print_payment_currency(($total+$postage_cost), '&#165;', $decimal)."</span>&nbsp;元</td></tr>
       		</table>";
       
            $output .= "<form action=\"".get_option('alicart_check_out')."\" method=\"post\">$form";
				
			$output .= "<div id=\"rec-info\">
  <h2 class=\"rec-info-title\"><span class=\"entity\">收货信息</span></h2>
  <h3><span class=\"entity-h3\">收货地址</span>电话号码、手机号选填一项,其余均为必填项</h3>
  <ul class=\"rec-info-form\">
    <li>
      <label class=\"label-like\" for=\"consignee\">收货人姓名:</label>
      <p>
        <input type=\"text\" name=\"consignee\" id=\"consignee\" class=\"inputtext\" value=\"\">
        <span class=\"spark-indeed\">*</span>
	  </p>
    </li>
    <li>
      <label class=\"label-like\" for=\"address\">收货地址:</label>
      <p>
        <input type=\"text\" name=\"address\" id=\"address\" value=\"\" class=\"inputtext\">
        <span class=\"spark-indeed\">*</span>
      </p>
    </li>
    <li>
      <label class=\"label-like\" for=\"zip_code\">邮政编码:</label>
      <p>
        <input type=\"text\" name=\"zip_code\" id=\"zip_code\" value=\"\" class=\"inputtext\">
      <span class=\"spark-indeed\">*</span>
      </p>
	</li>
    <li>
      <label class=\"label-like\">电话号码:</label>
      <p>
        <input type=\"text\" name=\"phone_section\" title=\"区号\" value=\"\" id=\"phone_section\" class=\"phone inputtext\">
        -
        <input type=\"text\" name=\"phone_code\" title=\"电话号\" value=\"\" id=\"phone_code\" class=\"phone inputtext\">
        -
        <input type=\"text\" name=\"phone_ext\" title=\"分机号\" value=\"\" id=\"phone_ext\" class=\"phone inputtext\">
        <span class=\"ex-gray\">区号-电话号-分机号</span>
      </p>
    </li>
    <li>
      <label class=\"label-like\" for=\"mobile_phone\">手机号码:</label>
      <p>
        <input type=\"text\" name=\"mobile_phone\" value=\"\" id=\"mobile_phone\" class=\"inputtext\">
      </p>
    </li>
  </ul>
</div>";
				
    			if ($count)
            		$output .= '<input type="submit" class="alicart_button alicart_go_my_cart" value="结　算" />';
       
    			$output .= $urls.'
				<input type="hidden" name="products_body_content" value="'.$body_content.'" />
				<input type="hidden" name="products_count" value="'.$count.'" />
				<input type="hidden" name="total_amount" value="'.number_format(($total+$postage_cost), 2, ".", "").'" />
			    <input type="hidden" name="cmd" value="_cart" />
			    <input type="hidden" name="upload" value="1" />
			    <input type="hidden" name="rm" value="2" />
			    <input type="hidden" name="mrb" value="3FWGC6LFTMTUG" />';
			    $output .= '</form>';          
       	}       
       	$output .= "</div>";
    
    return $output;
}

function alicart_checkout()
{		
    require_once("class/alipay_service.php");
	
	$partner = get_option('alipay_partner_id');
	$key = get_option('alipay_key');
	$seller_email = get_option('alipay_email');
	$notify_url = ALICART_URL."/notify_url.php";
	$return_url = get_option('alipay_return_url');
	$show_url = get_option('alicart_products_page_url');
	$mainname = get_option('alipay_name');

	$sign_type = "MD5";
	$_input_charset	= "utf-8";
	$transport = "http";

	$out_trade_no = date(Ymdhms);
	$count = $_POST['products_count'];
	
	if ($count > 1) {
		$subject = "来自".get_option('blogname')."的商品"; 
		/*$body = substr($_POST['products_body_content'], 0, -1); */
		$order_body = $_POST['products_body_content'];
	} else {
	    $subject = $_POST['item_name_1'];		  
		$order_body = "商品价格:".$_POST['amount_1'].",商品数量:".$_POST['quantity_1'];		
	}
	
	if ($_POST['consignee']=="" || $_POST['address']=="" || $_POST['zip_code']=="" || !is_numeric($_POST['zip_code'])) {
		echo  "<script>history.back();</script>";
		die();
	}
	
	if ($_POST['phone_section']=="" || $_POST['phone_code']=="") {
		$phone = "";
	} else if ($_POST['phone_ext']!="") {
		if (!is_numeric($_POST['phone_section']) || !is_numeric($_POST['phone_code']) || !is_numeric($_POST['phone_ext'])) {
			echo  "<script>history.back();</script>";
			die();
		} else {
			$phone = $_POST['phone_section']."-".$_POST['phone_code']."-".$_POST['phone_ext'];
		}
	} else {
		if (!is_numeric($_POST['phone_section']) || !is_numeric($_POST['phone_code'])) {
			echo  "<script>history.back();</script>";
			die();
		} else {
			$phone = $_POST['phone_section']."-".$_POST['phone_code'];
		}
	}
	
	if ($_POST['mobile_phone']!="") {
		if (!is_numeric($_POST['mobile_phone'])) {
			echo  "<script>history.back();</script>";
			die();
		}
	}
	
	if ($phone == "" && $_POST['mobile_phone']=="") {
		echo  "<script>history.back();</script>";
		die();
	}
	
	$body = $order_body.",收货人:".$_POST['consignee'].",收货地址:".$_POST['address'].",邮政编码:".$_POST['zip_code'].",电话号码:".$phone.",手机号码:".$_POST['mobile_phone'];
	
	$total_fee    = $_POST['total_amount'];	

	$paymethod    = "directPay";
	
	if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
	{
	$list = explode(',',$_SERVER['HTTP_X_FORWARDED_FOR']);
	$_SERVER['REMOTE_ADDR'] = $list[0];
	}
	$anti_phishing_key  = query_timestamp($partner);
	$exter_invoke_ip = $_SERVER['REMOTE_ADDR'];
	$extra_common_param = '';
	$buyer_email = '';

	$royalty_type = "";
	$royalty_parameters= "";

	$parameter = array(
			"service"			=> "create_direct_pay_by_user",	
			"payment_type"		=> "1",
			"partner"			=> $partner,
			"seller_email"		=> $seller_email,
			"return_url"		=> $return_url,
			"notify_url"		=> $notify_url,
			"_input_charset"	=> $_input_charset,
			"show_url"			=> $show_url,
			"out_trade_no"		=> $out_trade_no,
			"subject"			=> $subject,
			"body"				=> $body,
			"total_fee"			=> $total_fee,
			"paymethod"			=> $paymethod,
			"defaultbank"		=> $defaultbank,
			"anti_phishing_key"	=> $anti_phishing_key,
			"exter_invoke_ip"	=> $exter_invoke_ip,
			"buyer_email"		=> $buyer_email,
			"extra_common_param"=> $extra_common_param,
			"royalty_type"		=> $royalty_type,
			"royalty_parameters"=> $royalty_parameters
	);
	
	$alipay = new alipay_service($parameter,$key,$sign_type);
	$sHtmlText = $alipay->build_form();
	
	$output .= '
	<table align="center" width="100%" cellpadding="5" cellspacing="0">
	<tr>
		<td align="center" class="font_title" colspan="2"><strong>确认订单</strong></td>
	</tr>
	<tr>
		<td class="font_content" align="right" width="80">订单号：</td>
		<td class="font_content" align="left">'.$out_trade_no.'</td>
	</tr>
	<tr>
		<td class="font_content" align="right">订单名称：</td>
		<td class="font_content" align="left">'.$subject.'</td>
	</tr>
	<tr>
		<td class="font_content" align="right">订单描述：</td>
		<td class="font_content" align="left">'.$order_body.'</td>
	</tr>
	<tr>
		<td class="font_content" align="right">付款总金额：</td>
		<td class="font_content" align="left">'.$total_fee.'&nbsp;元</td>
	</tr>
	<tr>
		<td align="center" class="font_title" colspan="2"><strong>确认收货信息</strong></td>
	</tr>
	<tr>
		<td class="font_content" align="right">收货人：</td>
		<td class="font_content" align="left">'.$_POST['consignee'].'</td>
	</tr>
	<tr>
		<td class="font_content" align="right">收货地址：</td>
		<td class="font_content" align="left">'.$_POST['address'].'</td>
	</tr>
	<tr>
		<td class="font_content" align="right">邮政编码：</td>
		<td class="font_content" align="left">'.$_POST['zip_code'].'</td>
	</tr>
	<tr>
		<td class="font_content" align="right">电话号码：</td>
		<td class="font_content" align="left">'.$phone.'</td>
	</tr>
	<tr>
		<td class="font_content" align="right">手机号码：</td>
		<td class="font_content" align="left">'.$_POST['mobile_phone'].'</td>
	</tr>
	<tr>
		<td align="center" colspan="2" class="order_submit">'.$sHtmlText.'<input type="submit" class="alicart_button alicart_go_my_cart" value="结　算" /></form></td>
	</tr>
    </table>
	';
	
	return $output;
}
?>