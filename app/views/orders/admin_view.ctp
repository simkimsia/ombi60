<?php 
echo $html->script('jquery.styledButton.js', array('inline' => FALSE));
echo $html->script('jquery.action_button.js', array('inline' => FALSE));  

echo $html->css('styledButton');

/*echo "<pre>";
print_r($order);
echo "</pre>";*/
?>
<div>
    <div class="text_center">
      <h2>
        <?php echo __('Overview of order #'.$order['Order']['order_no']); ?>
      </h2>
      <?php 
        echo $this->Html->link(__('Contact Customer'), 'javascript:void(0)');
        echo ' | '. $this->Html->link(__('Attach note'), 'javascript: void(0)');
        echo ' | '. $this->Html->link(__('Export'), 'javascript: void(0)');
        echo ' | '. $this->Html->link(__('Print'), 'javascript: void(0)');
        echo ' | '. $this->Html->link(__('Close this order'), 'javascript: void(0)');
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
                            <?php echo __('Did not agree to marketing');?>    
                        </li>
                    </ul>                  
                    <div style="clear: both;">&nbsp;</div>
                </div>
            </div>
            <div style="clear: both;">&nbsp;</div>
            <div>
                <div class="order_info_div">
                    <h1><strong><?php echo __('Delivery Address');?></strong></h1>
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

                <div class="order_info_div">
                    <h1><strong><?php echo __('Billing Address');?></strong></h1>
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
                <div style="border-bottom: 1px solid;padding: 5px">
                    <div style="float:left;">
                        <label>Payment Mode</label>
                        <br />
                        <?php
                        echo $module_name;
                        ?>
                    </div>
                    <div style="float: right;">
                        <?php
                        $status = $order['Order']['payment_status'];
                        if ($status == 2) {
                            echo  "You have received payment for this order.";
                        } else {
                            echo "You have NOT received payment for this order.";
                            ?>
                            <br />
                            <div style="float: right; margin-top: 5px;"><span class="markPaymentReceived">Mark as payment received</span></div>
                            <?php
                        }
                        ?>
                        
                        <?php //echo $html->link('Mark as payment received', 'javascript: void(0);');?>
                    </div>
                    <div style="clear: both;"></div>
                </div>
                <div style="padding: 5px;">
                    <div style="float:left;">
                       <label>Shipping Mode</label>
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
                        <?php
                        $fullfill_status = $order['Order']['fulfillment_status'];
                        if ($fullfill_status == 0) {
                            echo "You have fullfilled all line items";
                        } else {
                        ?>
                            You need to fullfill <strong><?php echo $order['Order']['order_line_item_count'];?> line item</strong>.
                            <br />
                            <div style="float: right; margin-top: 5px;" class=""><span class="fullfillItem">Fullfill line items</span></div>
                        <?php
                        }
                        ?>
                        
                    </div>
                    <div style="clear: both;"></div>
                </div>
                <div style="clear: both;"></div>
            </div>
            <div style="clear: both;"></div>
            <div>
                <table cellpadding="0" cellspacing="0" class="products-table" style="width: 100%;">
                    <tr>
	                    <th width="25%"><?php echo 'Product'; ?></th>
	                    <th width="25%" class="text_center"><?php echo 'Price'; ?></th>
	                    <th width="25%" class="text_center"><?php echo 'Quantity'; ?></th>
	                    <th width="25%" class="text_right"><?php echo 'Total'; ?></th>
	
                    </tr>
                    <?php
                    $i = 0;
                    $temp = 0;
                    foreach ($order['OrderLineItem'] as $lineItem):
                        $temp = $temp + $lineItem['product_quantity'] * $lineItem['product_price'];
	                    $class = null;
	                    if ($i++ % 2 == 0) {
		                    $class = ' class="altrow"';
	                    }

                    ?>
	                    <tr<?php echo $class;?>>
		                    <td>
			                    <?php echo $this->Html->link(__($lineItem['product_title']),
						                         array('admin'=>true,
							                       'controller' => 'products',
							                       'action' => 'view',
							                       $lineItem['product_id'])); ?>
			
		                    </td>
		                    <td class="text_center">
			                    <?php echo $number->currency($lineItem['product_price'], '$'); ?>
		                    </td>
		                    <td class="text_center">
			                    <?php echo $lineItem['product_quantity']; ?>
		                    </td>
		
		                    <td class="text_right">
		                        <?php
                             	$options = array(
                             		'before' => '$', 'after' => 'c', 'zero' => "Free", 'places' => 2, 'thousands' => ',', 'decimals' => '.');?>
                                <?php $number->addFormat($order['Order']['currency'], array('before' => '$'));?>
                                <?php echo $number->currency(($lineItem['product_quantity'] * $lineItem['product_price']), $order['Order']['currency'], $options).$order['Order']['currency'];?> 
		                    </td>
	                    </tr>
                    <?php endforeach; ?>
                        <tr><td colspan="4">&nbsp;</td></tr>
                        <tr>
                            <td style="background: none;">&nbsp;</td>
                            <td colspan="2" class="text_right" style="background: none;">Subtotal</td>
                            <td class="text_right" style="background: none;">                            
                             <?php
                             	$options = array(
                             		'before' => '$', 'after' => 'c', 'zero' => "Free", 'places' => 2, 'thousands' => ',', 'decimals' => '.');?>
                            <?php $number->addFormat($order['Order']['currency'], array('before' => '$'));?>
                            <?php echo $number->currency($temp, $order['Order']['currency'], $options).$order['Order']['currency'];?> 
                            </td>
                        </tr>
                        <tr>
                            <td style="background: none;">&nbsp;</td>
                            <td colspan="2" class="text_right" style="background: none;">Shipping fee (
                            <?php
                            $shipment_price  = 0;
                            if (!empty($order['Shipment'])) {
                                foreach ($order['Shipment'] as $shipment):
                                ?>
                                    
                                    <?php echo $shipment['name']; ?>
                                    <?php $shipment_price = $shipment['price'];?>
                                <?php
                                endforeach;
                            }
                           
                            ?>
                            )</td>
                            <td class="text_right" style="background: none;">
                                <?php
                             	$options = array(
                             		'before' => '$', 'after' => 'c', 'zero' => "Free", 'places' => 2, 'thousands' => ',', 'decimals' => '.');?>
                                <?php $number->addFormat($order['Order']['currency'], array('before' => '$'));?>
                                <?php
                                if ($shipment_price != 0) {
                                    echo $number->currency($shipment_price, $order['Order']['currency'], $options).$order['Order']['currency'];
                                } else {
                                    echo $number->currency($shipment_price, $order['Order']['currency'], $options);
                                }
                                ?>
                                
                            </td>
                        </tr>
                        <tr><td colspan="4" class="background_none" style="background: none;"><hr /></td></tr>
                        <tr>
                            <td style="background: none;">&nbsp;</td>
                            <td colspan=2 class="text_right" style="background: none;"><?php echo __('Total');?></td>
                            <td class="text_right" style="background: none;">
                                <?php
                             	$options = array(
                             		'before' => '$', 'after' => 'c', 'zero' => "Free", 'places' => 2, 'thousands' => ',', 'decimals' => '.');?>
                                <?php $number->addFormat($order['Order']['currency'], array('before' => '$'));?>
                                <?php
                                if (($temp + $shipment_price) != 0) {
                                    echo $number->currency(($temp + $shipment_price), $order['Order']['currency'], $options).$order['Order']['currency'];
                                } else {
                                    echo $number->currency(($temp + $shipment_price), $order['Order']['currency'], $options);
                                }
                                ?>
                                
                            </td>
                        </tr>
                    </table>
            </div>
            <div style="clear: both;">&nbsp;</div>	
        </div>
    </div>
    <div style="clear: both;">&nbsp;</div>	
</div>
