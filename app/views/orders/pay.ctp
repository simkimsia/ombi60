<?php
	echo $this->Html->script('http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js');
?>

<div>
	<div id="totalAmountWithShipping">
	<?php echo $this->Number->currency($totalAmountWithShipping, 'SGD'); ?>
	</div>
	
	
	<?php
	if ($totalAmount != $totalAmountWithShipping) {
		echo '<div id="totalAmount">';
		echo __('Including shipping for ',true) . $this->Number->currency($totalAmount, 'SGD');
		echo '</div>';
	}
	?>
	
</div>

<div class="orders form">
<?php echo $this->Form->create('Order', array('url' => array('controller' => 'orders',
							     'action' => 'pay',
							     'hash' => $hash,
							     'shop_id' => $shop_id)));?>
	<fieldset>
 		<legend><?php __('Pay Order');?></legend>
	<?php
	
		if ($displayShipment) {
			echo $this->Form->input('Shipment.shipping_rate_id', array('type'=>'radio', 'value'=>$defaultShipment));
			echo $this->Form->input('Shipment.order_id', array('type'=>'hidden',
									  'value' => $order['Order']['id']));
		}
	
		if ($displayPaymentMode){
			
			echo $this->Form->input('Payment.shops_payment_module_id', array('type'=>'radio',
											 'value' => $defaultPayment));
		} else {
			
			echo $this->Form->input('Payment.shops_payment_module_id', array('type'=>'hidden',
								  'value' => $payPalShopsPaymentModuleId));
		}
		echo $this->Form->input('Payment.order_id', array('type'=>'hidden',
								  'value' => $order['Order']['id']));
		
		// need to set the cart id for the past_checkout_point to work
		echo $this->Form->input('Cart.id', array('type'=>'hidden',
								  'value' => $order['Order']['cart_id']));
	
                
		
		
	?>
	</fieldset>
<?php echo $this->Form->end('Submit');?>
</div>

<script type="text/javascript">

 var orderId = '<?php echo $order['Order']['id']; ?>';
 var cartId = '<?php echo $order['Order']['cart_id']; ?>';
 var shipRateId = '';

    $(document).ready(function(){
        
        $('input:radio[name=data\\[Shipment\\]\\[shipping_rate_id\\]]').click(function() {
		shipRateId = this.value;

		$.ajax({
			type: 'POST',
			url: '<?php echo Router::url('updatePrices', true); ?>',
			data: { order_id: orderId, cart_id: cartId, shipping_rate_id: shipRateId},
			success: function(data) {
				var json_object = $.parseJSON(data);
		
				if (json_object.success) {
					var contents = $.parseJSON(json_object.contents);
					$('#totalAmountWithShipping').html(contents.totalAmountWithShipping);
				} else {
					var contents = $.parseJSON(json_object.contents);
					alert(contents.reason);
				}
			
			
			}
		});
		
	});
    
    });
</script>
