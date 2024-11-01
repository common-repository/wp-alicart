<?php
function alicart_jquery_javascript()
{
	echo '<script type="text/javascript" src="'.ALICART_URL.'/js/alicart.jquery.js?ver=1.7.1"></script>';	
}
function alicart_read_form_javascript()
{
	echo '
	<script type="text/javascript">
	<!--//
	function ReadForm (obj1, tst) 
	{ 
	    var i,j,pos;
	    val_total="";val_combo="";		
	
	    for (i=0; i<obj1.length; i++) 
	    {     
	        obj = obj1.elements[i];
	
	        if (obj.type == "select-one") 
	        {   
	            if (obj.name == "quantity" ||
	                obj.name == "amount") continue;
		        pos = obj.selectedIndex;
		        val = obj.options[pos].value;
		        val_combo = val_combo + "(" + val + ")";
	        }
	    }
		val_total = obj1.product_tmp.value + val_combo;
		obj1.product.value = val_total;
	}
	//-->
	</script>';	
}

function alicart_form_validation_javascript()
{
	echo '
	<script type="text/javascript">
	<!--//
	jQuery.noConflict();

	jQuery().ready(function() {
		jQuery("form .inputtext:input").blur(function() {
			var $parent = jQuery(this).parent();
			$parent.find(".prompt").remove();
	
			if(jQuery(this).is("#consignee")) {
				if(this.value=="") {
					var errorMsg = "请填写收货人姓名";
					$parent.append("<span class=\'prompt onError\'>"+errorMsg+"</span>");
				}
			}
			
			if(jQuery(this).is("#address")) {
				if(this.value=="") {
					var errorMsg = "请详细填写省/市/区/街道";
					$parent.append("<span class=\'prompt onError\'>"+errorMsg+"</span>");
				}
			}
			
			if(jQuery(this).is("#zip_code")) {
				if(this.value=="") {
					var errorMsg = "请填写邮政编码";
					$parent.append("<span class=\'prompt onError\'>"+errorMsg+"</span>");
				} else if(isNaN(this.value) || this.value.length != 6) {
					var errorMsg = "请填写正确的邮政编码";
					$parent.append("<span class=\'prompt onError\'>"+errorMsg+"</span>");
				}
			}
			
			if(jQuery(this).is(".phone")) {
				if(jQuery("#phone_section").val()!="" || jQuery("#phone_code").val()!="" || jQuery("#phone_ext").val()!="") {
					if(isNaN(jQuery("#phone_section").val()) || jQuery("#phone_section").val().length < 3 || jQuery("#phone_section").val().length > 4 || isNaN(jQuery("#phone_code").val()) || jQuery("#phone_code").val().length < 6 || jQuery("#phone_code").val().length > 9 || isNaN(jQuery("#phone_ext").val())) {
						var errorMsg = "请填写正确的电话号码";
						$parent.append("<span class=\'prompt onError\'>"+errorMsg+"</span>");
					}
				}
			}
			
			if(jQuery(this).is("#mobile_phone")) {
				if(this.value != "") {
					if(isNaN(this.value) || this.value.length != 11) {
						var errorMsg = "请填写正确的手机号码";
						$parent.append("<span class=\'prompt onError\'>"+errorMsg+"</span>");
					}
				}
			}
	
		}).keyup(function() {
			jQuery(this).triggerHandler("blur");
		}).focus(function() {
			jQuery(this).triggerHandler("blur");
		});
	
		jQuery(".alicart_go_my_cart").click(function() {
			jQuery("form .inputtext:input").trigger("blur");
			var errorNum = jQuery("form .onError").length;
			if(errorNum) {
				return false;
			}
		});
	});
	//-->
	</script>';	
}

add_action('wp_head', 'alicart_jquery_javascript');
add_action('wp_head', 'alicart_read_form_javascript');
add_action('wp_head', 'alicart_form_validation_javascript');
?>