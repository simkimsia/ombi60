<h1 class="center">Orders</h1>
<div class="rule"></div>
<div id="action-links">
	<ul>
	    <li id="email"><a href="https://donnelly-lockman2285.myshopify.com/admin/orders/54131562/contact" title="Contact Customer">Contact customer</a></li>
		<li id="note"><a href="#" onclick="$(&quot;order-note&quot;).hide();$(&quot;note-form&quot;).show();$(&quot;order_note&quot;).focus(); return false;">Attach note</a></li>
		<li class="csv"><a href="https://donnelly-lockman2285.myshopify.com/admin/orders/54131562.csv">Export</a></li>
		<li id="print"><a href="#" onclick="window.print();; return false;">Print</a></li>
		<li id="lock"><a href="https://donnelly-lockman2285.myshopify.com/admin/orders/54131562/close" data-method="post" rel="nofollow">Close this order</a></li>


	</ul>

</div>

<div class="columns clear">
	<div class="col1-3">
		<div class="online-user">
			<div class="mark clear">
				<div class="avatar">

				<?php
				$email = $order['User']['email'];
				$email = trim(strtolower($email));
				$gravatar_id = md5($email);
				$defaultPic = Router::url('/img/admin/icons/customer.gif', true); 
				$gravatarLink = 'https://secure.gravatar.com/avatar.php?gravatar_id=' . $gravatar_id;
				$gravatarLink .= '&size=50&default='. $defaultPic;

				echo $this->Html->image($gravatarLink, array('id' => 'gravatar'));
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

