<?php 
echo $html->script('jquery.styledButton.js', array('inline' => FALSE));
echo $html->script('jquery.action_button.js', array('inline' => FALSE));  

echo $html->css('styledButton');
?>
<div class="orders">
    <div class="text_center">
      <h2>
        <?php __('Overview of order #'.$order['Order']['order_no']); ?>
      </h2>
      <?php 
        echo $this->Html->link(__('Contact Customer', true), 'javascript:void(0)');
        echo ' | '. $this->Html->link(__('Attach note', true), 'javascript: void(0)');
        echo ' | '. $this->Html->link(__('Export', true), 'javascript: void(0)');
        echo ' | '. $this->Html->link(__('Print', true), 'javascript: void(0)');
        echo ' | '. $this->Html->link(__('Close this order', true), 'javascript: void(0)');
      ?>
    </div>
    
    <div>
        <div id="order_left">
            <div class="customer_information">
                <div class="image_div">
                    <?php echo $html->image('anonymousPerson.jpg', array('alt' => 'Any User', 'style' => "height: 100px; width: 100px;"));?>
                </div>
                <div>
                    <ul class="order_customer_info">
                        <li>
                            <strong><?php echo $order['User']['full_name']; ?></strong>    
                        </li>
                        <li>
                            <?php echo $order['User']['email']; ?>        
                        </li>
                        <li>
                            <?php __('Did not agree to marketing');?>    
                        </li>
                    </ul>                  
                    <div style="clear: both;">&nbsp;</div>
                </div>
            </div>
            <div style="clear: both;">&nbsp;</div>
            <div>
                <div style="padding: 0px 10px;">
                    <h1><strong><?php  __('Delivery Address');?></strong></h1>
                    <ul class="order_customer_info">
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
                            <?php echo $order['DeliveryAddress']['country']; ?>
                        </li>
                    </ul>
                </div>

                <div style="padding: 0px 10px;">
                    <h1><strong><?php  __('Billing Address');?></strong></h1>
                    <ul class="order_customer_info">
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
                            <?php echo $order['BillingAddress']['country']; ?>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
        <div id="order_right">
            <div id="payment_shipping">
                <div style="border-bottom: 1px solid;">
                    <div style="float:left;">
                        Payment Mode
                        <br />
                        <?php
                        foreach ($order['Payment'] as $payment):
                        ?>
                        <div>
	                        <?php echo $payment['name']; ?>
                        </div>
                        <?php
	                    endforeach;
                        ?>
                    </div>
                    <div style="float: right;">
                        You have not received payment for this order.
                        <br />
                        <div style="float: right; margin-top: 5px;"><span class="markPaymentReceived">Mark as payment received</span></div>
                        <?php //echo $html->link('Mark as payment received', 'javascript: void(0);');?>
                    </div>
                    <div style="clear: both;">&nbsp;</div>
                </div>
                <div style="padding: 5px;">
                    <div style="float:left;">
                       Shipping Mode
                       <br />
                       <?php
	                   foreach ($order['Shipment'] as $shipment):
                       ?>
                        <div>
	                        <?php echo $shipment['name']; ?>
                        </div>
                        <?php
	                    endforeach;
                        ?>
                    </div>
                    <div style="float: right;">
                        You need to fullfill <strong>1 line item</strong>.
                        <br />
                        <div style="float: right; margin-top: 5px;" class=""><span class="fullfillItem">Fullfill line items</span></div>
                        <?php //echo $html->link('Fullfill line items', 'javascript: void(0);');?>
                    </div>
                    <div style="clear: both;">&nbsp;</div>
                </div>
                <div style="clear: both;">&nbsp;</div>
            </div>
            <div style="clear: both;">&nbsp;</div>
            <div>
                <table cellpadding="0" cellspacing="0" class="products-table" style="width: 100%;">
                    <tr>
	                    <th><?php echo 'Product'; ?></th>
	                    <th><?php echo 'Price'; ?></th>
	                    <th><?php echo 'Quantity'; ?></th>
	                    <th><?php echo 'Total'; ?></th>
	
                    </tr>
                    <?php
                    $i = 0;

                    foreach ($order['OrderLineItem'] as $lineItem):
	                    $class = null;
	                    if ($i++ % 2 == 0) {
		                    $class = ' class="altrow"';
	                    }

                    ?>
	                    <tr<?php echo $class;?>>
		                    <td>
			                    <?php echo $this->Html->link(__($lineItem['product_title'], true),
						                         array('admin'=>true,
							                       'controller' => 'products',
							                       'action' => 'view',
							                       $lineItem['product_id'])); ?>
			
		                    </td>
		                    <td>
			                    <?php echo $number->currency($lineItem['product_price'], 'SGD'); ?>
		                    </td>
		                    <td>
			                    <?php echo $lineItem['product_quantity']; ?>
		                    </td>
		
		                    <td>
			                    <?php echo $number->currency($lineItem['product_quantity'] * $lineItem['product_price'], 'SGD'); ?>
		                    </td>
	                    </tr>
                    <?php endforeach; ?>
                    </table>
                    Total amount: <?php echo $number->currency($order['Order']['amount'], 'SGD'); ?>
            </div>
            <div style="clear: both;">&nbsp;</div>	
        </div>
    </div>
    <div style="clear: both;">&nbsp;</div>	
</div>
