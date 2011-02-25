<?php
	echo $this->Html->script('http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js');
?>
<?php echo $this->element('checkout_information');?>

<div class="gray_background">
    <div><?php
    echo $this->Form->label('Contact Email');
    ?></div>
    <div class="clear"></div>
    <?php echo $this->Form->input('contact_email', array('label' => FALSE)); ?>
</div>
<div class="clear">&nbsp;</div>
<?php echo $this->Form->create('Order', array('url' => array('controller' => 'orders',
							     'action' => 'checkout',
							     'hash' => $hash,
							     'shop_id' => $shop_id)));?>
<div class="gray_background">

    <div style="float: left; width: 50%;">
        <h2 style="border-bottom: 1px solid #CCCCCC;">Billing Address</h2>
        <?php
	    if (!empty($shippingAddresses)) {
	    ?>
	        <?php foreach ($shippingAddresses as $address) { ?>
	        <span class="info"><?php echo $address['DeliveryAddress']['full_name']; ?></span>
	        <span class="info"><?php echo $address['DeliveryAddress']['address']; ?></span>
	        <span class="info"><?php echo $address['DeliveryAddress']['city']; ?></span>
	        <span class="info"><?php echo $address['DeliveryAddress']['region']; ?></span>
	        <span class="info"><?php echo $address['DeliveryAddress']['country']; ?></span>
	        <span class="info">
	        <?php
	        echo $this->Form->submit('Ship to this address', array('name'=>'submitAddress',
									    'value'=>$address['DeliveryAddress']['id'],
									    'id'=>$address['DeliveryAddress']['id'],
									    'class'=>'shipToThisAddressBtn')); ?>
	        </span>
	        <?php } ?>
		    <?php		    
	    }
	    echo $this->Form->input('Order.fixed_delivery', array('type'=>'hidden', 'value'=>0));
	    
        echo $this->Form->input('Cart.hash', array('type'=>'hidden', 'value'=>$hash));

        if (!$customer_id) {
            //echo $this->Form->input('User.email', array('div' => FALSE));
        } 
        
        echo $this->Form->input('Order.customer_id', array('type' => 'hidden', 'value'=>$customer_id));
        echo $this->Form->input('Customer.shop_id', array('type' => 'hidden', 'value'=>$shop_id));
        
        echo $this->Form->input('BillingAddress.0.full_name', array('div' => FALSE));
        echo "<div class='clear'></div>";
        echo $this->Form->input('BillingAddress.0.address', array('div' => FALSE));
        echo "<div class='clear'></div>";
        echo $this->Form->input('BillingAddress.0.city', array('div' => FALSE));
        echo "<div class='clear'></div>";
        echo $this->Form->input('BillingAddress.0.region', array('div' => FALSE));
        echo "<div class='clear'></div>";
        echo $this->Form->input('BillingAddress.0.zip_code', array('div' => FALSE));
        echo "<div class='clear'></div>";
        echo $this->Form->input('BillingAddress.0.country', array('type' => 'select', 'options' => $countries, 'div' => FALSE, 'style' => "width: 250px;"));
        echo "<div class='clear'></div>";
        echo $this->Form->input('BillingAddress.0.type', array('type' => 'hidden', 'value' => BILLING, 'div' => FALSE));
        echo "<div class='clear'></div>";
        echo $this->Form->checkbox('DeliveryAddress.same', array('checked'=>true));
        echo 'Ship to above billing address';
        ?>
    </div>
    <div style="float: left; width: 50%;">
        <h2 style="border-bottom: 1px solid #CCCCCC;">Shipping Address</h2>
        <div class="error_message" id="err_msg">Product(s) shipped to billing address</div>
        <div id="delivery_address">
        <?php
        echo $this->Form->input('DeliveryAddress.0.full_name', array('div' => FALSE));
        echo "<div class='clear'></div>";
        echo $this->Form->input('DeliveryAddress.0.address', array('div' => FALSE));
        echo "<div class='clear'></div>";
        echo $this->Form->input('DeliveryAddress.0.city', array('div' => FALSE));
        echo "<div class='clear'></div>";
        echo $this->Form->input('DeliveryAddress.0.region', array('div' => FALSE));
        echo "<div class='clear'></div>";
        echo $this->Form->input('DeliveryAddress.0.zip_code', array('div' => FALSE));
        echo "<div class='clear'></div>";
        echo $this->Form->input('DeliveryAddress.0.country', array('type' => 'select', 'options' => $countries, 'div' => FALSE, 'style' => "width: 250px;"));
        echo "<div class='clear'></div>";
        echo $this->Form->input('DeliveryAddress.0.type', array('type'=>'hidden', 'value'=>BILLING));
        ?>
        </div>
    </div>
    <div class="clear"></div>
    

</div>
<?php echo $this->Form->submit('Continue to next step', array('div' => FALSE));?>
&nbsp;or&nbsp;
<?php
echo $html->link('return to store', array('controller' => 'products'));
?>
<?php echo $this->Form->end();?>

<!--<div>
	<div id="totalAmountWithShipping">
	<?php echo $this->Number->currency($totalAmountWithShipping, 'SGD'); ?>
	</div>
</div>-->


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
            $("#err_msg").show();
        }
        else
        {      
            //otherwise, hide it 
            $("#delivery_address").show("fast");
            $("#err_msg").hide();
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
