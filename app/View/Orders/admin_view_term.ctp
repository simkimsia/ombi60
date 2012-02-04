<h1 class="center">Orders</h1>
<div class="rule"></div>
<div id="action-links">
	<ul>
	    <li id="email"><?php echo $this->Html->link(__('Contact Customer'), array('action'=>'contact', 'id' => $order['Order']['id']), array('id'=>'contact', 'class'=>'fancybox.ajax')); ?></li>
		<li id="note"><a href="#" onclick="$(&quot;#order_note&quot;).hide();$(&quot;#note_form&quot;).show();$(&quot;#OrderNote&quot;).focus(); return false;">Attach note</a></li>
		<li class="csv"><?php echo $this->Html->link(__('Export'), array('action'=>'export', 'id' => $order['Order']['id'])); ?></li>
		<li id="print"><a href="#" onclick="window.print();; return false;">Print</a></li>
		<?php if ($order['Order']['status'] == ORDER_OPENED) : ?> 
		<li id="lock"><?php echo $this->Html->link(__('Close this Order'), array('action'=>'close', 'id' => $order['Order']['id'], '[method]' => 'PUT')); ?></li>
		<?php endif; ?>
		<?php if ($order['Order']['status'] == ORDER_CLOSED) : ?> 
		<li id="locko"><?php echo $this->Html->link(__('Re-Open this Order'), array('action'=>'open', 'id' => $order['Order']['id'])); ?></li>
		<?php endif; ?>
		<?php if ($order['Order']['payment_status'] == PAYMENT_PAID || $order['Order']['payment_status'] == PAYMENT_AUTHORIZED) : ?> 
		<li id="locko"><?php echo $this->Html->link(__('Cancel this Order'), array('action'=>'open', 'id' => $order['Order']['id'])); ?></li>
		<?php endif; ?>


	</ul>

</div>

<div class="columns clear">
	<div class="col1-3">
		<div class="online-user">
			<div class="mark clear">
				<div class="avatar">

				<?php
				$email = $order['User']['email'];

				$defaultPic = Router::url('/img/admin/icons/customer.gif', true); 

				
				echo $this->Gravatar->image($email, array(
					'size' => 50,
					'default' => $defaultPic,
					'ssl' => true,
					), array(
						'alt' => 'Gravatar'));
				
				?>
					<p class="status admin">admin</p>
				</div>
				<div class="desc">
					<!-- <ul class="links">
						<li><a href="#" class="graph" title="view stats">stats </a></li>
						<li><a href="#" class="cart" title="view shopping cart">shopping cart</a></li>
						<li><a href="#" class="hist" title="view user history">history</a></li>
						<li><a href="#" class="mesg" title="send message">send message</a></li>
						<li><span class="male" title="male">male</span></li>
					</ul> -->
					<h4><strong><?php echo $order['User']['full_name']; ?></strong></h4>
					<h5><?php echo $email; ?></h5>
					<p><small>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed in porta lectus.</small></p>
					<p class="info"><small>registered: 01/05/2009</small></p>
				</div>
			</div>
		</div> <!-- end of customer profile -->

		<h2>Shipping Address</h2>
		<div class="desc bt-space40">
			<ul>
				<li>
		            <?php echo $order['DeliveryAddress']['full_name']; ?>
		        </li>
		        <li>
		            <?php echo $order['DeliveryAddress']['address']; ?>
		        </li>
		        <li>
		            <?php echo $order['DeliveryAddress']['region']; ?>
		        </li>
		        <li>
		            <?php echo $order['DeliveryAddress']['city'] . ' ' . $order['DeliveryAddress']['zip_code']; ?>
		        </li>
		        <li>
		            <?php echo $order['DeliveryAddress']['Country']['printable_name']; ?>
		        </li>
			</ul>
		</div><!-- end of Shipping Address -->

		<h2>Billing Address</h2>
		<div class="desc bt-space40">
			<ul>
				<li>
		            <?php echo $order['BillingAddress']['full_name']; ?>
		        </li>
		        <li>
		            <?php echo $order['BillingAddress']['address']; ?>
		        </li>
		        <li>
		            <?php echo $order['BillingAddress']['region']; ?>
		        </li>
		        <li>
		            <?php echo $order['BillingAddress']['city'] . ' ' . $order['BillingAddress']['zip_code']; ?>
		        </li>
		        <li>
		            <?php echo $order['BillingAddress']['Country']['printable_name']; ?>
		        </li>
			</ul>
		</div><!-- end of Billing Address -->

	</div><!-- end of left column -->

	<div class="col2-3 lastcol">
		<div class="content-box bt-space40">
			<div class="box-body">
				<div class="box-wrap clear">
					<div class="columns clear bt-space10"><!-- start of Payment Mode -->
						<div class="col1-3"><strong>Payment Mode</strong></div>
						<div class="lastcol right"><!-- start of Payment Status  -->
							<?php
		                    $status = $order['Order']['payment_status'];
		                    if ($status == 2) {
		                        echo  "You have received payment for this order.";
		                    } else {
		                        echo "You have NOT received payment for this order.";
								
							}
		                    ?>
							
						</div><!-- end of Payment Status -->
					</div><!-- end of Payment Mode -->

					<?php
						if ($status !=2) {					
							echo '<div class="columns clear bt-space10">';

							// the mark as payment button
							echo '<a href="#" class="button fr">Mark as payment received</a>';
							
							echo '</div><!-- end of Mark as Payment button -->';
						}
					?>
					
					
					<div class="rule"></div>

					<div class="columns clear bt-space10"><!-- start of Shipping Mode -->
						<div class="col1-3"><strong>Shipping Mode</strong></div>
						<div class="lastcol right"><!-- start of Shipping Status  -->
							<?php
	                        $fullfill_status = $order['Order']['fulfillment_status'];
	                        if ($fullfill_status == 0) {
	                            echo "You have fullfilled all line items";
	                        } else {
	                        ?>
                            You need to fullfill <strong><?php echo $order['Order']['order_line_item_count'];?> line item</strong>.
                        	<?php
	                        }
	                        ?>
						</div><!-- end of Shipping Status -->
					</div><!-- end of Shipping Mode -->

					<div class="columns clear bt-space10"><!-- start of Shipping Mode value -->
						<?php if (!empty($order['Shipment'])) { ?>
							<?php
							 
							$shipmentName = '';
							
							foreach($order['Shipment'] as $shipment) {
								$shipmentName = $shipment['name'];
							}
							?>
						<div class="col1-3"><?php echo $shipmentName; ?></div><!-- end of Shipping Mode named -->
						<?php } ?>
						
						<?php if ($fullfill_status != 0) { ?>
						<div class="lastcol"><?php echo '<a href="#" class="button fr">Fulfill line items</a>'; ?></div><!-- end of Fulfill Line Item button -->
						<?php } ?>
					</div><!--  end of Shipping Mode value -->

				</div> <!-- end of box-wrap -->
			</div> <!-- end of box-body -->
		</div> <!-- end of content-box -->
		
		
		<?php
		$newlines = array("\r\n", "\n", "\r");
		$content = str_replace($newlines, "", $order['Order']['note']);
		
		 if (!empty($content)) : 
		?>
		<div id="order_note" class="mark_blue">
			<h2>Order Note</h2>
			<div id="note_body"><?php echo nl2br($order['Order']['note']); ?></div>
		</div>
		<?php endif; ?>	
		<div id="note_form" class="mark" style="display:none">
			<?php

				echo $this->Form->create('Order', array(
					'class' => 'validate-form form bt-space15', 
					'inputDefaults' => array(
						'label' => array(
							'class' => 'form-label size-120 fl-space2'
						),
						'div'	=> array(
							'class' => 'form-field clear'
						),
						'error' => array(
							'attributes' => array(
								'wrap' => 'label', 
								'class' => 'error', 
								'for' => true
							)
						)
					),
					'url' => array(
						'controller' => 'orders',
						'action'	=> 'edit',
						'admin'	=> true,
						'id'	=> $order['Order']['id']
					)
				));
			?>
			<div class="columns clear bt-space15">
				<?php
					echo $this->Form->input('Order.note', array(
						'class' => 'textarea',
						'type'	=> 'textarea',
						'value' => $order['Order']['note'],
					));

				?>		
			</div>
			
			<div class="rule2"></div>
			<div class="form-field clear">
				<input type="submit" class="button" value="Save Note" />&nbsp;or&nbsp;
				<a href="#" onclick="$(&quot;#order_note&quot;).show();$(&quot;#note_form&quot;).hide(); return false;">Cancel</a>
			</div>

			<?php echo $this->Form->end(); ?>
		
		</div>
	
		
		<!-- Items -->
		
		<table class="style1">
			<thead>
				<tr>
					<th>Product</td>
					<th class="center">Price</th>
					<th class="center">Quantity</th>
					<th class="right">Total</th>
				</tr>
			</thead>
			<tbody>
		<?php
		
        $temp = 0;
        foreach ($order['OrderLineItem'] as $lineItem):
            $temp = $temp + $lineItem['product_quantity'] * $lineItem['product_price'];

        ?>
        
				<tr>
				
	                <td><?php echo $this->Html->link(__($lineItem['product_title']),
				                         array('admin'=>true,
					                       'controller' => 'products',
					                       'action' => 'view',
					                       $lineItem['product_id'])); ?>
	                </td>
	                <td class="center"><?php echo $this->Number->currency($lineItem['product_price'], '$'); ?></td>
	                <td class="center"><?php echo $lineItem['product_quantity']; ?></td>

	                <td class="right">
	                    <?php
	                 	$options = array(
	                 		'before' => '$', 'after' => 'c', 'zero' => "Free", 'places' => 2, 'thousands' => ',', 'decimals' => '.');?>
	                    <?php $this->Number->addFormat($order['Order']['currency'], array('before' => '$'));?>
	                    <?php echo $this->Number->currency(($lineItem['product_quantity'] * $lineItem['product_price']), $order['Order']['currency'], $options).$order['Order']['currency'];?> 
	                </td>
				
				
				</tr>
		
		<?php
		endforeach;
		?>
		
		
			</tbody>
		</table>
		
		
	</div><!-- end of col2-3 -->
	
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$("a#contact").fancybox();
	});

	
</script>