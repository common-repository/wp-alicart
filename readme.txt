=== WP 支付宝购物车 ===
Contributors: 1tui8
Donate link: http://1tui8.com/blog/category/wp-alicart/
Tags: alipay, 支付宝, 支付宝插件, 支付宝购物车, 电子商务, 商城, 网上商城
Requires at least: 2.6
Tested up to: 3.3.0
Stable tag:1.1.4

WP 支付宝购物车，设置简单，易于使用，是电子商务及网络营销的最佳选择。

== Description ==

WP 支付宝购物车是一款开源 WordPress 电子商务插件，WordPress 用户可以通过这款插件实现支付宝即时到账收款。WP 支付宝购物车可以用于虚拟商品交易、网上商城及在线营销等各类需要在线支付的 WordPress 网站。

= 插件特色 =

* 支持支付宝即时到账收款功能。
* 支持运费设置。
* 支持简码。
* 自带购物车小工具。
* 简单易用的后台配置选项。
* 与 WordPress 主题高度融合。

= 官方网站 =

* [吉林壹推](http://1tui8.com "吉林壹推")
* [插件页面](http://1tui8.com/blog/category/wp-alicart/ "WP 支付宝购物车")

== 使用方法 ==

1. 要添加“添至购物车”按钮，仅需在文章或页面的文本编辑器中添加触发器简码  [alicart:商品名称:price:商品价格:end]。然后将“商品名称”和“商品价格”替换为实际的名称和价格即可。
1. 要将“添至购物车”按钮添加到其他模板文件，仅需调用此函数即可：<?php echo alicart_print_button_for_product('商品名称', 商品价格); ?>。然后将“商品名称”和“商品价格”替换为实际的名称和价格即可。
1. 添加边栏购物车小工具仅需在小工具页面找到 WP 支付宝购物车小工具，并拖动到相应边栏中即可。
1. 创建我的购物车页面仅需新建文章或页面，并将简码 [alicart_show_mycart] 添加至编辑器即可。
1. 创建结账页面仅需新建文章或页面，并将简码 [alicart_show_checkout] 添加至编辑器即可。

= 如何使用运费 =

1. 要使用运费功能，请使用下面的触发器简码

[alicart:商品名称:price:商品价格:shipping:运费:end]

= 如何使用变量 =

* 要使用变量控制，请使用下面的简码：[alicart:商品名称:price:商品价格:var1[变量名称|变量1|变量2|变量3]:end]

例如：[alicart:iPad2:price:3688:var1[容量|16|32|64]:end]

* 要同时使用变量控制和运费功能，请使用下面的简码：[alicart:商品名称:price:商品价格:shipping:运费:var1[变量名称|变量1|变量2|变量3]:end]

例如：[alicart:iPad2:price:3688:shipping:50:var1[容量|16|32|64]:end]

* 要使用多个变量选项，请使用下面的简码：[alicart:商品名称:price:商品价格:var1[变量名称|变量1|变量2|变量3]:var2[变量名称|变量1|变量2|变量3]:end]

例如：[alicart:iPad2:price:3688:shipping:50:var1[容量|16|32|64]:var2[颜色|黑色|白色]:end]

== Installation ==

1. 解压并将“wp-alicart”文件夹上传到“/wp-content/plugins/”目录
1. 在 WordPress 的“插件”菜单中启动插件
1. 设置和配置选项。例如：支付宝账号、购物车标题、跳转地址等
1. 在希望显示插件的文章或页面添加简码

== Frequently Asked Questions ==

= 1. 这款插件是否可以用于接受支付宝付款的商品或服务？ =

是的。

= 2. 这款插件是否带有购物车？ =

是的。

= 3. 是否可以将购物车添加到结算页面？ =

可以。

= 4. “添至购物车”按钮是否可以自定义？ =

可以。

= 5. 支付完成后是否可以返回到指定的页面？ =

可以。

== Screenshots ==

相关截图，请访问[吉林壹推](http://1tui8.com/blog/category/wp-alicart/ "吉林壹推")

== Changelog ==

= 1.0 =
* 第一个稳定版。

= 1.0.1 =
* 修复了 alicart.php 的编码问题。

= 1.1 =
* 修正了确认商品信息时自动跳转到支付宝的问题。
* 增加了收货信息表单，访客现在可以提交收货人、收货地址、邮政编码、电话号码及手机号码等。
* 增加了收货信息确认列表。
* 美化了确认结算页面的支付按钮。

= 1.1.1 =
* 一次小更新，将所有均按钮改为CSS3样式，增强 WP 支付宝购物车的灵活性。

= 1.1.2 =
* 一次小更新，解决一些主题在应用 WP 支付宝购物车插件时，“添至购物车”按钮无效的问题。

= 1.1.3 =
* 为 WP 支付宝购物车插件添加跳转页面。

= 1.1.4 =
* 修改 WP 支付宝购物车插件收货信息表单样式，增加表单验证。

= 1.1.5 =
* 修正了 WP 支付宝购物车插件空购物车图片不显示的问题，删除了满购物车文字或图片文本框。

== Upgrade Notice ==

升级公告，请访问吉林壹推