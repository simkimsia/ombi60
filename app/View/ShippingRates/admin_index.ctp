<?php echo $this->Html->script('shipping/shipping_index', array('inline' => FALSE));?>
<style type="text/css">
table tr:nth-child(2n) td {
    background: none;
    padding: 10px 0px 10px 4px;
}

.shipping_td{
    background: none;
    padding: 10px 0px 10px 4px;
}

.other_td{
    background: none; 
    padding: 10px 0px 10px 4px;
}

.pricing_td{
    background: #F5F5F5; 
    padding: 10px 5px;
}

.empty_td{
    background: none; 
    padding: 5px 0px;
}
</style>
<div>
    <div class="text_center"><h2><?php echo __('Shipping');?></h2></div>	
    <table cellpadding="0" cellspacing="0" class="products-table">
        <?php
        $i = 0;
        $count = count($shippingRates);
        $displayCountryTitle = '';

        foreach ($shippingRates as $key => $shippingRate):
	        $class = null;
	        if ($i++ % 2 == 0) {
		        $class = ' class="altrow"';
	        }
	
	        $currentCountry = ($shippingRate['ShippedToCountry']['country_id'] == 0) ? 'Rest of World' : $shippingRate['Country']['printable_name'];
	
	        if ($displayCountryTitle !== $currentCountry) {
		        $displayCountryTitle = $currentCountry;
		        ?>
		        <tr><th colspan="4"><?php echo $displayCountryTitle;?></th></tr>
		        <?php
	        }
	
	        if ($shippingRate['ShippingRate']['id'] != null) {
            ?>
                <tr>
	                <td class="shipping_td">
	                <?php
	                $based = 'price-based-shipping';
	                if ($shippingRate['WeightBasedRate']['id'] > 0) {
		                $based = 'weight-based-shipping';
	                }
		                echo $this->Html->link($shippingRate['ShippingRate']['name'], array('action' => 'edit', 'based'=>$based, 'id'=>$shippingRate['ShippingRate']['id'])); ?>
	                &nbsp;</td>
	                <td class="other_td"><?php echo $this->element('display_shipping_range', array('shippingRate'=>$shippingRate, 'based' => $based)); ?>&nbsp;</td>
	                <td class="other_td">
	                <?php
	                echo $this->Number->format($shippingRate['ShippingRate']['price'], array('places' => 2, 'escape' => false, 'decimals' => '.',)) . " SGD";
	                ?></td>
	                <td class="actions other_td">		
		                <?php echo $this->Html->link(__('Delete'), array('action' => 'delete', $shippingRate['ShippingRate']['id']), null, sprintf(__('Are you sure you want to delete %s for %s?'), $shippingRate['ShippingRate']['name'], $displayCountryTitle)); ?>
	                </td>
                </tr>
            <?php
	        }

	        if ($count == ($key+1) || $shippingRate['ShippedToCountry']['country_id'] != $shippingRates[$key + 1]['ShippedToCountry']['country_id']) {
	        ?>
	            
	            <tr id="new-shipping-rate-<?php echo $shippingRate['ShippedToCountry']['id'];?>">
	                <td class="pricing_td" colspan="4" style="background: #F5F5F5; "><a href="javascript:void(0);" onclick="showPriceForm('<?php echo $shippingRate['ShippedToCountry']['id']; ?>');return false;">Add price based rate</a>&nbsp;|&nbsp;<a href="javascript:void(0);" onclick="showWeightForm('<?php echo $shippingRate['ShippedToCountry']['id']; ?>');return false;">Add weight based rate</a>
	                </td>
	            </tr>
	        <?php
		        echo $this->element('add_weight_based_shipping_rate_form', array(
		                                                                    'id'=>$shippingRate['ShippedToCountry']['id'],
			                                							    'country'=>$shippingRate['ShippedToCountry']['id'],
			                                							   ));
		        echo $this->element('add_price_based_shipping_rate_form', array(
		                                                                   'id'=>$shippingRate['ShippedToCountry']['id'],
                                                                           'country'=>$shippingRate['ShippedToCountry']['id'],
                                                                          ));
            ?>
                <tr><td class="empty_td">&nbsp;</td></tr>
            <?php
	        }
        ?>
        <?php endforeach; ?>        
    </table>
    <div>
    Can't find the country you are looking for?
    <br />
    <a href="javascript: void(0)">Add more countries</a> in the <a href="javascript: void(0)">Regions & Taxes</a> area
    </div>
</div>

