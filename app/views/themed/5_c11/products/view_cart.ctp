	<div id="cataloguetop"></div>	
	<div id="cataloguebody">
		
		<div id="checkouttop">
			<div id="cartupdate">
				
				<?php

					$count = count($products);
					
					if ($count > 0) {
						echo $this->Form->create('Product', array('action' => 'edit_quantities_in_cart' ));	
						echo $this->Form->submit('Refresh Cart', array('name'=>'btnRefresh',
											       'id'=>'cartbutton'));
						
				?>
			</div>
		</div>
		<table cellpadding="0" cellspacing="0">
			<tr id="headerbar">
				<td colspan="2" class="cartitemname"><?php __('Item');?></td>
				<td class="cartquantity"><?php __('Quantity');?></td>
				<td class="cartprice"><?php __('Price');?></td>
				<td class="cartremove">X</td>
			</tr>
			<?php
				$i = 0;
				
				foreach ($products as $product):
					$class = null;
					if ($i++ % 2 == 0) {
						$class = ' class="evenCartLine"';
					} else {
						$class = ' class="oddCartLine"';
					}
			?>
			<tr <?php echo $class; ?>>
				<td class="cartitemimg">
					<?php echo $this->Html->image(UP_ONE_DIR_LEVEL . PRODUCT_IMAGES_THUMB_SMALL_URL . $product['ProductImage']['filename'],
								      array('alt'=>$product['Product']['title'],
									    'height'=>100,
									    'width'=>120)); ?>
				</td>
				
				<td class="cartitemname">
					<div class="itemtitle"><a href="catalogueitem.html"><?php echo $product['Product']['title']; ?></a></div>
					<div class="itemstock">Item is in stock.</div>
					<div class="itemdesc">Proin mauris tortor, ultricies interdum posuere eu, placerat vitae orci.</div>
				</td>
				<td class="cartquantity">
					
					<?php
						echo $this->Form->text('Product.' . $product['Product']['id'] . '.quantity',
									     array('value'=>$product['Product']['quantity'],
										   'maxlength'=>3,
										   'class'=>'textbox') );
					?>
				</td>
				<td class="cartprice"><?php echo $product['Product']['price']; ?></td>
				<td class="cartremove"><a href="#"><span class="removeitem">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></a></td>
			</tr>
			<?php endforeach; ?>
			
			<tr id="amounttotal">
				<td class="cartitemimg">
				&nbsp;</td>
				<td class="cartitemname">
					&nbsp;</td>
				<td class="cartquantity">
				&nbsp;</td>
				<td class="cartprice"><?php echo $paymentAmount; ?></td>
				<td class="cartremove">&nbsp;</td>
			</tr>
		</table>
		
		
		
		<div id="checkout">
			<div id="cartupdate">
			<?php
					echo $this->Form->submit('Refresh Cart', array('name'=>'btnRefresh',
											'id'=>'cartbutton'));
					echo $this->Form->end();
					
				} // end if NOT empty $products
			?>
			</div>
			<?php
				if ($count > 0) {
					echo $this->Form->create('Product', array('action' => 'checkout' ));
					echo '<div id="cartcheckout">';
					echo $this->Form->submit('Checkout', array('name'=>'checkoutBtn', 'value'=>'proceed', 'id'=>'cartbutton'));
					echo '</div>';
					echo $this->Form->hidden('products_count', array('value'=>$count));
	
					if ($paypalExpressOn) {
		
						echo '<div id="cartpaypal">';
						
						echo '<input type="image" src="https://www.paypal.com/en_US/i/btn/btn_xpressCheckout.gif" name="checkout" value="paypalExpressCheckout" />';
						
						echo '</div>'	;
				
					}
					echo $this->Form->end();
				}
			?>
			

		</div>
	</div>
	<div id="cataloguebottom"></div>