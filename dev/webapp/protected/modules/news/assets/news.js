$(function (){
	// event click button "Add to Cart"
	$('.h-button-add_tab-cart').live('click',function() {
		$('.img_temp').remove();
		var img = $('.h-module-products-detail span img');
		var num = $('.h-module-products-detail input[type="text"]');
		animateToCart(img, num.val());
	});
	
	// let the product items be draggable
	$('.h-module-products-detail span img, .h-module-products-entries ul li img').draggable({
		cancel: "a.ui-icon", // clicking an icon won't initiate dragging
		revert: "invalid", // when not dropped, the item will revert back to its initial position
		containment: "document", // stick to demo-frame if present
		helper: "clone",
		cursor: "move",
		opacity: 0.3
	});
	
	// let the cart be droppable, accepting the product items
	$('.h-module-products-cart img').droppable({
		accept: ".h-module-products-detail span img, .h-module-products-entries ul li img",
		activeClass: "ui-state-hover",
		hoverClass: "ui-state-active",
		drop: function( event, ui ) {
			animateToCart(ui.draggable);
		}
	});
	
	// show list item in cart
	function displayCart()
	{
		$('.h-module-products-cart .h-module-products-cart-items').html(htmlCarts());
	}
	displayCart();
	
	// event click clear cart
	$('.h-module-products-cart .h-module-products-cart-clear').click(function(){
		if (!confirm('Are you sure you remove all products in cart?')) return false;
		clearCarts();
		$('.h-module-products-cart .h-module-products-cart-items').html("");
		return false;
	});
	
	// event click manage cart
	$('.h-module-products-cart-manage').click(function(){
		var $manageDialog = $('.h-module-products-cart-manage-dialog');
		htmlManageCarts();
		$manageDialog.dialog({
			position: 'center',
	        modal: true,
	        width:'auto',
	        height:'auto',
	        buttons: {
	        	'Update': function() {
	        		$success = true;
	        		$manageDialog.find('table tr td input').each(function(index, obj){
	        			if (!editProductInCarts(index, $(obj).val())) $success = false;
	        		});
	        		if ($success)
	        			alert('Cart has been updated successfully.');
        			else
        				alert('Warning: Incorrect data.');
	        	},
	        	'Close': function() { $(this).dialog('close'); }
	        }
		});
		
		return false;
	});
	
	// event click pay cart
	$('.h-module-products-cart-pay').click(function(){
		alert('Sorry, this is demo Shop page.\nContact nick Yahoo:o0www0o to used full version.');
	});
	
	function htmlManageCarts()
	{
		$arrCarts = getCarts();
		var $html = "<table>\
						<thead>\
							<tr>\
								<th width='20px'></th>\
								<th width='200px'>Product</th>\
								<th>Number</th>\
								<th width='100px'>Price</th>\
								<th></th>\
							</tr>\
						</thead>\
						<tbody>";
		if ($arrCarts!=null) {
			var $total = 0;
			var $tnum = 0;
			for ($i=0; $i<$arrCarts.length; $i++) {
				$html+= "<tr>" + 
							"<td>" + 
								($i+1) +
							"</td>" +
							"<td>" + 
								$arrCarts[$i][1] +
							"</td>" +
							"<td>" + 
								"<input type='text' value='" + $arrCarts[$i][2] + "' size='5' />" +
							"</td>" +
							"<td>" + 
								"x " + $arrCarts[$i][3] +
							"</td>" +
							"<td>" + 
								"<a style='color:#00f' class='h-module-products-cart-del' href='#' rel='" + $i + "'>Remove</a>" +
							"</td>" +
						"</tr>";
				$total = parseInt($total) + parseInt($arrCarts[$i][2]) * parseInt($arrCarts[$i][3]);
				$tnum = parseInt($tnum) + parseInt($arrCarts[$i][2]);
			}
		} else {
			$html+= "<tr>" + 
						"<td></td><td>Cart is empty</td>" + 
					"</tr>";
		}
		$html += "</tbody>\
					<tfoot>\
						<tr>\
							<td></td>\
							<td width='200px'>Total</td>\
							<td>" + $tnum + "</td>\
							<td width='50px'>" + $total + "</td>\
							<td></td>\
						</tr>\
					</tfoot>\
				</table>";
		
		// event click delete product in manage cart
		var $manageDialog = $('.h-module-products-cart-manage-dialog');
		$manageDialog.html($html);		
		$manageDialog.find('table tr td a.h-module-products-cart-del').click(function(){
			editProductInCarts(parseInt($(this).attr('rel')), 0);
		});
	}
	
	function getCarts()
	{
		if ($.cookie('array_carts') == null) return null;
		$arrCarts = $.cookie('array_carts').split('|||');
		for ($i=0; $i<$arrCarts.length; $i++)
			$arrCarts[$i] = $arrCarts[$i].split(',,,');
		return $arrCarts;
	}
	
	function clearCarts()
	{
		$.cookie('array_carts', null, {path:'/'});
		displayCart();
	}
	
	function editProductInCarts($index, $num)
	{
		$arrCarts = getCarts();
		if ($arrCarts==null) return false;
		if (isNaN($num)) return false;
		if ($num<=0) {
			if (confirm('Are you sure you remove this product?')) {
				$arrCarts.splice($index, 1);
				if ($arrCarts.length==0) {
					clearCarts();
					displayCart();
					htmlManageCarts();
					return true;
				}
			}
		} else
			$arrCarts[$index][2]=parseInt($num);
		for ($i=0; $i<$arrCarts.length; $i++)
			$arrCarts[$i] = $arrCarts[$i].join(',,,');
		$.cookie('array_carts', $arrCarts.join('|||'), {path:'/'});
		displayCart();
		htmlManageCarts();
		return true;
	}
	
	function addProductToCarts($id, $name, $num, $price, $link)
	{
		$arrCarts = getCarts();
		if ($arrCarts==null) $arrCarts = new Array();
		var $exist = false;
		for ($i=0; $i<$arrCarts.length; $i++)
			if ($arrCarts[$i][0]==$id) {
				if ($num==undefined)
					$arrCarts[$i][2]++;
				else
					$arrCarts[$i][2]=parseInt($arrCarts[$i][2]) + parseInt($num);
				$exist = true;
				break;
			}
		if (!$exist) $arrCarts.push([$id, $name, ($num==undefined?1:$num), $price, $link]);
		for ($i=0; $i<$arrCarts.length; $i++)
			$arrCarts[$i] = $arrCarts[$i].join(',,,');
		$.cookie('array_carts', $arrCarts.join('|||'), {path:'/'});
		
		displayCart();
	}
	
	function htmlCarts()
	{
		$arrCarts = getCarts();
		if ($arrCarts==null)
			$('.h-module-products-cart div.h-module-product-cart-panel').hide();
		else
			$('.h-module-products-cart div.h-module-product-cart-panel').show();
		if ($arrCarts==null) return "";
		var $html = "<ul>";
		var $total = 0;
		for ($i=0; $i<$arrCarts.length; $i++) {
			$html += "<li>" + $arrCarts[$i][2] + " x <a href='" + $arrCarts[$i][4] + "'>" + $arrCarts[$i][1] + "</a></li>";
			$total = parseInt($total) + parseInt($arrCarts[$i][2]) * parseInt($arrCarts[$i][3]);
		}
		$html += "</ul>";
		$html += "<p>Total: "+$total+"</p>";
		
		return $html;
	}
	
	function animateToCart(img, num)
	{
		var image = img.offset();
		var cart = $('.h-module-products-cart img');
		var cartoffset = cart.offset();
		var product = img.attr('rel').split('|||');
		var link = img.parent('a');
		img.before('<img src="'+img.attr('src')+'" class="img_temp" style="position: absolute; top: '+image.top+'px; left: '+image.left+'px; width: '+img.attr('width')+'px; height: '+img.attr('height')+'px;" />');
		params = {top:cartoffset.top+'px',left:cartoffset.left+'px',opacity:0.0,width:cart.width(),height:cart.height()};
		$('.img_temp').animate(params,'slow',false,function() {
			addProductToCarts(product[0], img.attr('title'), num, product[1], link.attr('href'));
			$('.img_temp').remove();
		});
	}
});