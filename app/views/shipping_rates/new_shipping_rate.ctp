<?php


	$displayCountryTitle = ($shippingRate['ShippedToCountry']['country_id'] == 0) ? 'Rest of World' : $shippingRate['Country']['printable_name'];
	if ($shippingRate['ShippingRate']['id'] != null) {
			
	
		
?>
	
	<tr>
		
		<td>
		<?php
		$based = 'price-based-shipping';
		if ($shippingRate['WeightBasedRate']['id'] > 0) {
			$based = 'weight-based-shipping';
		}
			echo $this->Html->link($shippingRate['ShippingRate']['name'], array('action' => 'edit', 'based'=>$based, $shippingRate['ShippingRate']['id'])); ?>
		&nbsp;</td>
		<td><?php echo $this->element('display_shipping_range', array('shippingRate'=>$shippingRate)); ?>&nbsp;</td>
		<td><?php echo $this->Number->currency($shippingRate['ShippingRate']['price']) . "SGD";?>&nbsp;</td>
		
		
		<td class="actions">
			
			
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $shippingRate['ShippingRate']['id']), null, sprintf(__('Are you sure you want to delete %s for %s?', true), $shippingRate['ShippingRate']['name'], $displayCountryTitle)); ?>
		</td>
	</tr>
	
<?php
	}
?>
	
