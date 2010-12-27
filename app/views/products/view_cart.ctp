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
				$paymentAmount = 0;
				
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
					<?php echo $this->element('display_product_image', array('product'=>$product, 'productTitle'=>$product['product_title'],
												 'height' => 100, 'width' => 120)); ?>
				</td>
				
				<td class="cartitemname">
					<div class="itemtitle">
						<?php echo $this->Html->link( $product['product_title'], array('controller'=>'products',
													     'action'=>'view',
													     $product['product_id']));
						?>
						
					</div>
					<div class="itemstock">Item is in stock.</div>
					<div class="itemdesc">Proin mauris tortor, ultricies interdum posuere eu, placerat vitae orci.</div>
				</td>
				<td class="cartquantity">
					
					<?php
						echo $this->Form->text('CartItem.' . $product['id'] . '.product_quantity',
									     array('value'=>$product['product_quantity'],
										   'maxlength'=>3,
										   'class'=>'textbox',
										   ) );
						
						echo $this->Form->input('CartItem.' . $product['id'] . '.id',
									     array('value'=>$product['id'],
										   'type'=>'hidden',
										   ) );
						
						// calculate subtotal
						$paymentAmount += $product['product_price'] * number_format($product['product_quantity'],1);
					?>
				</td>
				<td class="cartprice"><?php echo $product['product_price']; ?></td>
				<td class="cartremove"><a href="#"><span class="removeitem">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></a></td>
			</tr>
			
			<?php endforeach; ?>
			<?php $paymentAmount = number_format($paymentAmount, 2); ?>
			
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