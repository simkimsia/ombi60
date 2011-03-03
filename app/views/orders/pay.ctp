<?php
	echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js');
?>
<?php echo $this->element('checkout_information', array('is_shipping_included' => TRUE, 'shipping_cost' => $this->Number->currency($totalAmount, '$'), 'step' => 2));?>

<!-- Gray table for shipping method -->
<?php echo $this->Form->create('Order', array('url' => array('controller' => 'orders',
							     'action' => 'pay',
							     'hash' => $hash,
							     'shop_id' => $shop_id)));?>
<div class="gray_background">
    <h2 class="border_bottom">Shipping method</h2>
    <div style="margin: 5px;">Please select how we deliver your products</div>
    <div class="show_shipment_option"><?php
    if ($displayShipment) {
		echo $this->Form->input('Shipment.shipping_rate_id', array('type'=>'radio', 'value'=>$defaultShipment, 'legend' => FALSE));
		echo $this->Form->input('Shipment.order_id', array('type'=>'hidden', 'value' => $orderData['Order']['id']));
	}
    ?></div>
    <div class="clear"></div>
    <?php //echo $this->Form->input('contact_email', array('label' => FALSE)); ?>
</div>
<div class="clear">&nbsp;</div>
<div class="gray_background">
    <h2 class="border_bottom">Payment method</h2>
    <div style="margin: 5px;">All transactions are secured and encrypted. We never store credit card information. View our <?php
    echo $html->link('privacy policy', 'javascript: void(0);', array('title' => 'privacy policy'));
    ?> to learn more.</div>
    <div class="show_shipment_option">
    <?php
    if ($displayPaymentMode){
			
		echo $this->Form->input('Payment.shops_payment_module_id', array('type'=>'radio', 'value' => $defaultPayment, 'legend' => FALSE));
	} else {
		
		echo $this->Form->input('Payment.shops_payment_module_id', array('type'=>'hidden', 'value' => $payPalShopsPaymentModuleId));
	}
	echo $this->Form->input('Payment.order_id', array('type'=>'hidden', 'value' => $orderData['Order']['id']));
	
	// need to set the cart id for the past_checkout_point to work
	echo $this->Form->input('Cart.id', array('type'=>'hidden', 'value' => $orderData['Order']['cart_id']));

            
	// set the hidden value of order_no so that it can be used to send invnum to paypal express checkout
	// in pay action isPost() code block
	echo $this->Form->input('Order.order_no', array('type'=>'hidden', 'value'=>$orderData['Order']['order_no']));
	
	
	// set the hidden value of contact_email so that it can be used to send email to paypal express checkout
	// in pay action isPost() code block
	echo $this->Form->input('Order.contact_email', array('type'=>'hidden', 'value'=>$orderData['Order']['contact_email']));
	
	
	if (!empty($paypal_payer_id) && is_numeric($paypal_payer_id) ) {
		echo $this->Form->input('PaypalPayersPayment.paypal_payer_id', array('type'=>'hidden', 'value'=>$paypal_payer_id));
	}
    ?></div>
    <div class="clear">&nbsp;</div>
</div>
<?php echo $this->Form->submit('Complete my purchase', array('div' => FALSE));?>&nbsp;or&nbsp;
<?php echo $html->link('return to store', array('controller' => 'products'));?>
<?php echo $this->Form->end();?>
<!--
<div>
	<div id="totalAmountWithShipping">
	<?php echo $this->Number->currency($totalAmountWithShipping, 'SGD'); ?>
	</div>
	
	
	<?php
	if ($totalAmount != $totalAmountWithShipping) {
		echo '<div id="totalAmount">';
		echo __('Including shipping for ',true) . $this->Number->currency($totalAmount, '$');
		echo '</div>';
	}
	?>
	
</div>-->

<script type="text/javascript">

 var orderId = '<?php echo $orderData['Order']['id']; ?>';
 var cartId = '<?php echo $orderData['Order']['cart_id']; ?>';
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
