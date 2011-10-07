<?php
	echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js');
?>
<?php 
	echo $this->element('checkout_information', array('currentOrder' => $currentOrder, 'step' => 2));
	$shop_id 			= $currentOrder['Order']['shop_id'];
	$order_uuid 		= $currentOrder['Order']['id'];
	$displayShipment 	= $currentOrder['Order']['shipping_required'];
	
?>

<!-- Gray table for shipping method -->
<?php 
	echo $this->Form->create('Order', array(
		'url' => array(
			'controller' => 'orders',
			'action' => 'complete_payment',
			'shop_id' => $shop_id,
			'order_uuid' => $order_uuid
	)));
?>
<div class="gray_background">
    <h2 class="border_bottom">Shipping method</h2>
    <div style="margin: 5px;">Please select how we deliver your products</div>
    <div class="show_shipment_option"><?php
    if ($displayShipment) {
	
		echo $this->Form->input('Shipment.shipping_rate_id', array(
		    'options' => $shipmentOptions,
			'label' => FALSE,
			'type'	=> 'radio'
		));
		
		echo $this->Form->input('Shipment.order_id', array('type'=>'hidden', 'value' => $currentOrder['Order']['id']));
	}
    ?></div>
    <div class="clear"></div>
</div>
<div class="clear">&nbsp;</div>
<div class="gray_background">
    <h2 class="border_bottom">Payment method</h2>
    <div style="margin: 5px;">All transactions are secured and encrypted. We never store credit card information. View our <?php
    echo $this->Html->link('privacy policy', 'javascript: void(0);', array('title' => 'privacy policy'));
    ?> to learn more.</div>
    <div class="show_shipment_option">
<?php

	echo $this->Form->input('Payment.shops_payment_module_id', array(
	    'options' => $paymentOptions,
		'label' => FALSE,
		'type'	=> 'radio'
	));
		
	echo $this->Form->input('Payment.order_id', array('type'=>'hidden', 'value' => $currentOrder['Order']['id']));
	            
?>
	</div>
    <div class="clear">&nbsp;</div>
</div>
<?php echo $this->Form->submit('Complete my purchase', array('div' => FALSE));?>&nbsp;or&nbsp;
<?php echo $this->Html->link('return to store', array('controller' => 'products'));?>
<?php echo $this->Form->end();?>

<script type="text/javascript">

 var orderId 	= '<?php echo $currentOrder['Order']['id']; ?>';
 var cartId		= '<?php echo $currentOrder['Order']['cart_id']; ?>';
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
