<?php
require_once("class/alipay_notify.php");

/* test start */
	$partner = get_option('alipay_partner_id');
	$key = get_option('alipay_key');
	$seller_email = get_option('alipay_email');
	$notify_url = ALICART_URL."/notify_url.php";
	/*$return_url = ALICART_URL."/return_url.php";*/
	$return_url = get_option('alipay_return_url');
	$show_url = get_option('alicart_products_page_url');
	$mainname = get_option('alipay_name');

	$sign_type = "MD5";
	$_input_charset	= "utf-8";
	$transport = "http";
/* test end */

/*require_once("alipay_config.php");*/

$alipay = new alipay_notify($partner,$key,$sign_type,$_input_charset,$transport);
$verify_result = $alipay->notify_verify();

if($verify_result) {
    $dingdan           = $_POST['out_trade_no'];
    $total             = $_POST['total_fee'];

    if($_POST['trade_status'] == 'TRADE_FINISHED' ||$_POST['trade_status'] == 'TRADE_SUCCESS') {
		echo "success";
    }
    else {
        echo "success";	
    }
}
else {
    echo "fail";
}
?>