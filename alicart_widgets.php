<?php
class wp_alipay_sidebar_widget_cart extends WP_Widget
{
	function wp_alipay_sidebar_widget_cart() {
		$widget_ops = array('classname' => 'alipay_sidebar_widget_cart', 'description' => '在边栏显示WP支付宝小工具' );
		parent::WP_Widget(false, 'WP支付宝小工具', $widget_ops);
	}
	
	function widget($args, $instance){
		extract($args);
		$alicartTitle = get_option('alicart_title');
		$alipayPrintCartTitle = apply_filters( 'widget_title', empty($alicartTitle) ? '购物车' : $alicartTitle);
		echo $before_widget;
		echo $before_title . $alipayPrintCartTitle . $after_title;
		echo alicart_sidebar_widget();
		echo $after_widget;
	}
	
	function form(){
		echo "在设置菜单中修改 WP 支付宝购物车选项";
	}
}

function wp_alipay_sidebar_widget_init(){
	register_widget('wp_alipay_sidebar_widget_cart');
}

add_action("widgets_init", "wp_alipay_sidebar_widget_init");
?>