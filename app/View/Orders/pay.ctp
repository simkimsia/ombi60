<?php
	echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js');
?>
<?php 
	echo $this->element('checkout_information', array('currentOrder' => $currentOrder, 'step' => 2));
	$shop_id 			= $currentOrder['Order']['shop_id'];
	$order_uuid 		= $currentOrder['Order']['id'];
	$displayShipment 	= $currentOrder['Order']['shipping_required'] && !empty($shipmentOptions);
	
?>

<!-- Gray table for shipping method -->
<?php 

	$urlArray = array(
		'controller' => 'orders',
		'action' => 'complete_purchase',
		'shop_id' => $shop_id,
		'order_uuid' => $order_uuid
	);
	
	$completePaymentUrl = $urlArray;
	
	echo $this->Form->create('Order', array(
		'url' => $completePaymentUrl
	));
?>
<div class="gray_background">
    <h2 class="border_bottom">Shipping method</h2>
    <div style="margin: 5px;">Please select how we deliver your products</div>
    <div class="show_shipment_option"><?php
    if ($displayShipment) {
		
		$checked = 'checked="checked"';
		foreach($shipmentOptions as $id=>$text) {
			echo '<input id="ShipmentShippingRateId'.$id.'" type="radio" ' . $checked . ' value="'.$id.'" name="data[Shipment][shipping_rate_id]">';
			echo '<div class="radio_text">' . $text . '</div>';
			$checked = '';
		}
		
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


	$checked = 'checked="checked"';
	foreach($paymentOptions as $id=>$text) {
		echo '<input id="PaymentShopsPaymentModuleId'.$id.'" type="radio" ' . $checked . ' value="'.$id.'" name="data[Payment][shops_payment_module_id]">';
		echo '<div class="radio_text">' . $text . '</div>';
		$checked = '';
	}
		
	echo $this->Form->input('Payment.order_id', array('type'=>'hidden', 'value' => $currentOrder['Order']['id']));
	            
?>
	</div>
    <div class="clear">&nbsp;</div>
</div>
<?php echo $this->Form->submit('Complete my purchase', array('div' => FALSE));?>&nbsp;or&nbsp;
<?php
echo $this->element('return_to_store', array('toAction' => 'products'));
?>
<?php echo $this->Form->end();?>

<script type="text/javascript">

 var cartId		= '<?php echo $currentOrder['Order']['cart_id']; ?>';
 var shipRateId = '';

    $(document).ready(function(){
        
        $('input:radio[name=data\\[Shipment\\]\\[shipping_rate_id\\]]').click(function() {
		shipRateId = this.value;

		<?php 
		$updatePricesUrl = $urlArray;
		$updatePricesUrl['action'] = 'update_prices';
		?>
		
		$.ajax({
			type: 'POST',
			url: '<?php echo Router::url($updatePricesUrl); ?>',
			data: { cart_id: cartId, shipping_rate_id: shipRateId},
			success: function(data) {
				var json_object = $.parseJSON(data);
		
				if (json_object.success) {
					var contents = $.parseJSON(json_object.contents);
					$('#totalAmountWithShipping').html(contents.totalAmountWithShipping);
					$('#shippingFee').html(contents.shippingFee);
				} else {
					var contents = $.parseJSON(json_object.contents);
					alert(contents.reason);
				}
			
			
			}
		});
		
	});
    
    });
</script>
