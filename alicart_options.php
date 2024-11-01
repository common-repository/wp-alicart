<?php
function alicart_header()
{
     echo '<div class="wrap"><h2>WP 支付宝购物车</h2><div id="poststuff"><div id="post-body">';
     alicart_show_options();
     echo '</div></div></div>';
}

function alicart_show_options () {	
    if (isset($_POST['info_update']))
    {
		update_option('alipay_name', (string)$_POST["alipay_name"]);
		update_option('alipay_email', (string)$_POST["alipay_email"]);
        update_option('alipay_return_url', (string)$_POST["alipay_return_url"]);
		
		update_option('alipay_partner_id', (string)$_POST["alipay_partner_id"]);
		update_option('alipay_key', (string)$_POST["alipay_key"]);
		
		update_option('alicart_title', (string)$_POST["alicart_title"]);
		update_option('alicart_empty', (string)$_POST["alicart_empty"]);
		/*update_option('alicart_not_empty', (string)$_POST["alicart_not_empty"]);*/
        update_option('alicart_base_shipping_cost', (string)$_POST["alicart_base_shipping_cost"]);
        update_option('alicart_free_shipping_threshold', (string)$_POST["alicart_free_shipping_threshold"]);
        update_option('alicart_add_button_name', (string)$_POST["alicart_add_button_name"]);
		update_option('alicart_my_cart', (string)$_POST["alicart_my_cart"]);
		update_option('alicart_check_out', (string)$_POST["alicart_check_out"]);
		update_option('alicart_products_page_url', (string)$_POST["alicart_products_page_url"]);
        update_option('alicart_image_hide', ($_POST['alicart_image_hide']!='') ? 'checked="checked"':'' );
		
        echo '<div id="message" class="updated fade"><p><strong>选项已保存！</strong></p></div>';
    }
	
	$alipayName = get_option('alipay_name');
	
    $alipayEmail = get_option('alipay_email');
    if (empty($alipayEmail)) $alipayEmail = get_bloginfo('admin_email');
	
    $alipayReturnURL =  get_option('alipay_return_url');
	
	$alipayPartnerID =  get_option('alipay_partner_id');
	
	$alipayKey =  get_option('alipay_key');
	
	$alicartTitle = get_option('alicart_title');
	
	$alicartEmpty = get_option('alicart_empty');
	
	/*$alicartNotEmpty = get_option('alicart_not_empty');*/

    $alicartBaseShippingCost = get_option('alicart_base_shipping_cost');
    if (empty($alicartBaseShippingCost)) $alicartBaseShippingCost = 0;

    $alicartFreeShippingThreshold = get_option('alicart_free_shipping_threshold');
		
	$alicartAddButtonName = get_option('alicart_add_button_name');
    if (empty($alicartAddButtonName)) $alicartAddButtonName = '添至购物车';      
		
	$alicartProductsPageURL = get_option('alicart_products_page_url');
	
	$alicartMyCart = get_option('alicart_my_cart');
	
	$alicartCheckOut = get_option('alicart_check_out');

	$alicartImageHide = (get_option('alicart_image_hide'))?'checked="checked"':'';
?>

    <p>相关信息，更新和详细文档，请访问：<br />
    <a href="http://1tui8.com/wp-alicart/">http://1tui8.com/wp-alicart/</a></p>
    <fieldset class="options">
        <legend>使用方法：</legend>
        <p>1. 添加"添至购物车"按钮，仅需将触发器简码 [alicart:<span style="font-weight: bolder;	color: #09F;">你的商品名称</span>:price:<span style="font-weight: bolder; color: #09F;">你的商品价格</span>:end] 添加至文章或商品页面即可。用实际的商品名称替换<span style="font-weight: bolder; color: #09F;">你的商品名称</span>，用实际的商品价格替换<span style="font-weight: bolder; color: #09F;">你的商品价格</span>。例如：[alicart:测试商品:price:15.00:end]</p>
        <p>2. 添加边栏购物车小工具仅需在小工具页面找到 WP 支付宝购物车小工具，并拖动到相应边栏中即可。</p>
        <p>3. 创建我的购物车页面仅需新建文章或页面，并将简码 <strong>[alicart_show_mycart]</strong> 添加至编辑器即可。</p>
        <p>4. 创建结账页面仅需新建文章或页面，并将简码 <strong>[alicart_show_checkout]</strong> 添加至编辑器即可。</p>
    </fieldset>
    <form method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>">
    <input type="hidden" name="info_update" id="info_update" value="true" />
<?php
echo '
	<div class="postbox">
	<h3><label for="title">关于支付宝即时到账收款（阶梯费率）</label></h3>
	<div class="inside">';

echo '
	<table class="form-table">
	<tr valign="top">
	<td>支付宝(http://www.alipay.com)是中国领先的在线支付平台，由全球最佳 B2B 公司阿里巴巴创建，为广大电子商务用户提供 B2C、C2C 交易平台。</td>
	</tr>
	<tr valign="top">
	<td>支付宝即时到账收款（阶梯费率）是支付宝提供给商家的收单接口。当买家下单支付时，可即刻将交易资金打到商家支付宝账户上。支付宝即时到账收款（阶梯费率）同时附带3个月内可退款、即时到账分润等功能。
	</td>
	</tr>
	<tr valign="top">
	<td style="font-weight: bolder;	color: #F00;">你需要先<a href="https://b.alipay.com/order/signLogin.htm?action=newsign&productId=2011060800327555">申请支付宝即时到账收款（阶梯费率）</a>。签约后您会获得合作者身份(partnerID)及交易安全校验码(key)。</td>
	</tr>
	<tr valign="top">
	<td>支付宝即时到账收款（阶梯费率）是收费服务，请仔细阅读<a href="https://b.alipay.com/order/productDetail.htm?productId=2011060800327555">相关说明</a>，明确费率及价格。相关政策或流程的变更及调整，请关注支付宝的最新通知。</td>
	</tr>
	<tr valign="top">
	<td>支付宝业务咨询 Email 为 <a target="_blank" href="mailto:6688@taobao.com">6688@taobao.com</a>，支付宝客户服务电话为 +86-0571-88156688。</td>
	</tr>
	</table>
	</div></div>';

echo '
	<div class="postbox">
	<h3><label for="title">免责声明</label></h3>
	<div class="inside">';

echo '
	<table class="form-table">
	<tr valign="top">
	<td>使用WP支付宝购物车完全建立在自愿基础上，插件作者不对其性能及安全做任何担保及承诺，也不对使用此插件所造成的任何损失承担责任。</td>
	</tr>
	</table>
	</div></div>';

echo '
	<div class="postbox">
	<h3><label for="title">支付宝设置</label></h3>
	<div class="inside">';

echo '
	<table class="form-table">
	<tr valign="top">
	<th scope="row">收款人姓名：</th>
	<td><input type="text" name="alipay_name" value="'.$alipayName.'" size="40" /><br />请填写真实有效的收款人姓名。</td>
	</tr>
	<tr valign="top">
	<th scope="row">收款支付宝账号：</th>
	<td><input type="text" name="alipay_email" value="'.$alipayEmail.'" size="40" /><br />请填写真实有效的支付宝账号，用于收取客户支付的商品款项。若账号无效，将导致交易失败。<br />没有支付宝帐号？<a target="_blank" href="http://www.alipay.com/redir.do?id=307&site=allbbs&target=https://www.alipay.com%2Fuser%2Fuser_register.htm">点击此处注册</a>。</td>
	</tr>';

echo '
<tr valign="top">
<th scope="row">跳转地址：</th>
<td><input type="text" name="alipay_return_url" value="'.$alipayReturnURL.'" size="40" /><br />付款成功后将跳转至该URL地址。</td>
</tr>
</table>
</div></div>';
 
echo '
	<div class="postbox">
	<h3><label for="title">支付宝签约用户设置</label></h3>
	<div class="inside">';

echo '
<table class="form-table">
<tr valign="top">
<th scope="row">合作者身份(partnerID)：</th>
<td><input type="text" name="alipay_partner_id" value="'.$alipayPartnerID.'" size="40" /><br />请在此处填写支付宝分配的合作者身份编号，手续费按照签约用户与支付宝的协议为准。若未签约，<a target="_blank" href="https://www.alipay.com/himalayas/practicality_customer.htm?customer_external_id=C4335344590036426018&market_type=from_agent_contract&pro_codes=21790F5A8C48B687F7F62F29651356BB">请点击这里签约</a>。若签约时出现合同模板冲突，请咨询0571-88158090。</td>
</tr>
<tr valign="top">
<th scope="row">交易安全校验码(key)：</th>
<td><input type="text" name="alipay_key" value="'.$alipayKey.'" size="40" /><br />支付宝签约用户请在此处填写支付宝分配的交易安全校验码，此校验码可以在支付宝的商家服务功能处查看。</td>
</tr>
</table>
</div></div>
 ';
 
echo '
	<div class="postbox">
	<h3><label for="title">购物车设置</label></h3>
	<div class="inside">';

echo '
<table class="form-table">
<tr valign="top">
<th scope="row">购物车标题</th>
<td><input type="text" name="alicart_title" value="'.$alicartTitle.'" size="40" /></td>
</tr>

<tr valign="top">
<th scope="row">空购物车文本或图片</th>
<td><input type="text" name="alicart_empty" value="'.$alicartEmpty.'" size="40" /><br />若希望购物车为空时显示图片提示，请填入图片的完整 URL 路径，含“http://”。</td>
</tr>

<!--<tr valign="top">
<th scope="row">满购物车文本或图片</th>
<td><input type="text" name="alicart_not_empty" value="'.$alicartNotEmpty.'" size="40" /></td>
</tr>-->

<tr valign="top">
<th scope="row">基础运费</th>
<td><input type="text" name="alicart_base_shipping_cost" value="'.$alicartBaseShippingCost.'" size="5" /> <br />此处的基础运费将被添至商品的总运费中。如果不想收取运费或不想收取基础运费请输入0。</td>
</tr>

<tr valign="top">
<th scope="row">免运费订单数</th>
<td><input type="text" name="alicart_free_shipping_threshold" value="'.$alicartFreeShippingThreshold.'" size="5" /> <br />若客户的订单超过该数量将得到免费送货。若不想使用请留空。</td>
</tr>
		
<tr valign="top">
<th scope="row">购物车按钮文本或图片</th>
<td><input type="text" name="alicart_add_button_name" value="'.$alicartAddButtonName.'" size="40" /><br />若要使用自定义图像做按钮，只需输入图片文件的途径。</td>
</tr>
		
<tr valign="top">
<th scope="row">商品页面地址</th>
<td><input type="text" name="alicart_products_page_url" value="'.$alicartProductsPageURL.'" size="40" /><br />此处填写商品页面地址。若使用，则在购物车为空时购物车小工具会显示链至商品页面的链接。</td>
</tr>

<tr valign="top">
<th scope="row">购物车页面地址</th>
<td><input type="text" name="alicart_my_cart" value="'.$alicartMyCart.'" size="40" /><br />此处填写购物车页面地址，点击“去购物车结算”按钮会跳转至此页面。</td>
</tr>

<tr valign="top">
<th scope="row">结算页面地址</th>
<td><input type="text" name="alicart_check_out" value="'.$alicartCheckOut.'" size="40" /><br />此处填写结算页面地址，点击"结算"按钮会跳转至此页面。</td>
</tr>

<tr valign="top">
<th scope="row">隐藏购物车图片</th>
<td><input type="checkbox" name="alicart_image_hide" value="1" '.$alicartImageHide.' /><br />若勾选，则购物车图片不显示。</td>
</tr>
</table>
</div></div>
    <div class="submit">
        <input type="submit" name="info_update" value="保存选项 &raquo;" />
    </div>						
 </form>
 ';

    echo '喜欢 WP 支付宝购物车？<a href="http://1tui8.com/wp-alicart" target="_blank">赞助我们！</a>'; 
}

function alicart_options_menu () 
{
     add_options_page('WP 支付宝购物车', 'WP 支付宝购物车', 'manage_options', 'alicart', 'alicart_header');  
}

add_action('admin_menu','alicart_options_menu');
?>
