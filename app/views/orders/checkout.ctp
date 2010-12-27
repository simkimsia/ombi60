<?php
	echo $this->Html->script('http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js');
?>

<div>
	<div id="totalAmountWithShipping">
	<?php echo $this->Number->currency($totalAmountWithShipping, 'SGD'); ?>
	</div>
</div>

<div class="orders form">
<?php echo $this->Form->create('Order', array('url' => array('controller' => 'orders',
							     'action' => 'checkout',
							     'hash' => $hash,
							     'shop_id' => $shop_id)));?>
							     
	<?php
	if (!empty($shippingAddresses)) {
	?>					     
	<fieldset>
		
		<?php foreach ($shippingAddresses as $address) { ?>
		<table>
		<tr><td>
			<?php echo $address['DeliveryAddress']['full_name']; ?>
		</td></tr>
		<tr><td>
			<?php echo $address['DeliveryAddress']['address']; ?>
		</td></tr>
		<tr><td>
			<?php echo $address['DeliveryAddress']['city']; ?>
		</td></tr>
		<tr><td>
			<?php echo $address['DeliveryAddress']['region']; ?>
		</td></tr>
		<tr><td>
			<?php echo $address['DeliveryAddress']['country']; ?>
		</td></tr>
		</table>
		<?php
		
		
		
		echo $this->Form->submit('Ship to this address', array('name'=>'submitAddress',
									'value'=>$address['DeliveryAddress']['id'],
									'id'=>$address['DeliveryAddress']['id'],
									'class'=>'shipToThisAddressBtn')); ?>
		<?php } ?>
		
	</fieldset>
	<?php
	}
	echo $this->Form->input('Order.fixed_delivery', array('type'=>'hidden',
							      'value'=>0));
	
	?>
	
							     
							     
	<fieldset>
 		<legend><?php __('Add Order');?></legend>
	<?php
		echo $this->Form->input('Cart.hash', array('type'=>'hidden',
                                                                     'value'=>$hash));
	
                if (!$customer_id) {
                        echo $this->Form->input('User.email');
                               
                } 
                
		
		echo $this->Form->input('Order.customer_id', array('type' => 'hidden', 'value'=>$customer_id));
                
                echo $this->Form->input('Customer.shop_id', array('type' => 'hidden', 'value'=>$shop_id));
		
		echo $this->Form->input('BillingAddress.0.full_name');
		echo $this->Form->input('BillingAddress.0.address');
		echo $this->Form->input('BillingAddress.0.city');
		echo $this->Form->input('BillingAddress.0.region');
		echo $this->Form->input('BillingAddress.0.zip_code');
		echo $this->Form->input('BillingAddress.0.country', array('type' => 'select',
									  'options' => $countries));
                echo $this->Form->input('BillingAddress.0.type', array('type'=>'hidden',
                                                                     'value'=>BILLING));
                
                echo $this->Form->checkbox('DeliveryAddress.same', array('checked'=>true));
                echo 'Ship to above billing address';
                
		echo '<div id="delivery_address">';
		echo $this->Form->input('DeliveryAddress.0.full_name');
                echo $this->Form->input('DeliveryAddress.0.address');
		echo $this->Form->input('DeliveryAddress.0.city');
		echo $this->Form->input('DeliveryAddress.0.region');
		echo $this->Form->input('DeliveryAddress.0.zip_code');
		echo $this->Form->input('DeliveryAddress.0.country', array('type' => 'select',
									  'options' => $countries));
                echo $this->Form->input('DeliveryAddress.0.type', array('type'=>'hidden',
                                                                     'value'=>BILLING));
		
		echo '</div>';
	?>
	</fieldset>
	
	<?php echo $this->Form->submit();?>
<?php echo $this->Form->end();?>
</div>


<script type="text/javascript">
    $(document).ready(function(){
        
        //Hide div w/id extra
       $("#delivery_address").css("display","none");
        // Add onclick handler to checkbox w/id checkme
       $("#DeliveryAddressSame").click(function(){
        
        // If checked
        if ($("#DeliveryAddressSame").is(":checked"))
        {
            //show the hidden div
            $("#delivery_address").hide("fast");
        }
        else
        {      
            //otherwise, hide it 
            $("#delivery_address").show("fast");
        }
      });
       
       $(":input.shipToThisAddressBtn").each(function() {
	
		$(this).click(function() {
	
			alert($(this).attr('id'));
			
			$("#OrderFixedDelivery").val($(this).attr('id'));
		
	
		});
       });
    
    });
</script>
