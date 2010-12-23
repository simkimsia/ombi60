
<div class="shippingRates index">
	<h2><?php __('Shipping');?></h2>
	
	<table cellpadding="0" cellspacing="0">
	<?php
	
	$i = 0;
	$count = count($shippingRates);
	$displayCountryTitle = '';
	
	foreach ($shippingRates as $key=>$shippingRate):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
		
		$currentCountry = ($shippingRate['ShippedToCountry']['country_id'] == 0) ? 'Rest of World' : $shippingRate['Country']['printable_name'];
		
		if ($displayCountryTitle !== $currentCountry) {
			$displayCountryTitle = $currentCountry;
			echo '<tr><td>'.$displayCountryTitle.'</td></tr>';
		}
		
		if ($shippingRate['ShippingRate']['id'] != null) {
			
	
		
	?>
	
	<tr<?php echo $class;?>>
		
		<td>
		<?php
		$based = 'price-based-shipping';
		if ($shippingRate['WeightBasedRate']['id'] > 0) {
			$based = 'weight-based-shipping';
		}
			echo $this->Html->link($shippingRate['ShippingRate']['name'], array('action' => 'edit', 'based'=>$based, 'id'=>$shippingRate['ShippingRate']['id'])); ?>
		&nbsp;</td>
		<td><?php echo $this->element('display_shipping_range', array('shippingRate'=>$shippingRate)); ?>&nbsp;</td>
		<td><?php echo $shippingRate['ShippingRate']['price']; ?>&nbsp;</td>
		
		
		<td class="actions">
			
			
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $shippingRate['ShippingRate']['id']), null, sprintf(__('Are you sure you want to delete %s for %s?', true), $shippingRate['ShippingRate']['name'], $displayCountryTitle)); ?>
		</td>
	</tr>
	
	<?php
	
		}
		
		if ($count == ($key+1) || $shippingRate['ShippedToCountry']['country_id'] != $shippingRates[$key + 1]['ShippedToCountry']['country_id']) {
			
			
			
			echo '<tr id="new-shipping-rate-'. $shippingRate['ShippedToCountry']['id'] .'"><td><a href="#" onclick="showPriceForm('.$shippingRate['ShippedToCountry']['id'].');return false;">Add price based rate</a>&nbsp;|&nbsp;<a href="#" onclick="showWeightForm('.$shippingRate['ShippedToCountry']['id'].');return false;">Add weight based rate</a></td></tr>';
			echo $this->element('add_weight_based_shipping_rate_form', array('id'=>$shippingRate['ShippedToCountry']['id'],
											 'country'=>$shippingRate['ShippedToCountry']['id']));
			echo $this->element('add_price_based_shipping_rate_form', array('id'=>$shippingRate['ShippedToCountry']['id'],
											'country'=>$shippingRate['ShippedToCountry']['id']));
		}
	?>
<?php endforeach; ?>

	</table>

</div>

<script>

	function afterAddRate(id, response) {
		var addRateRow = '#new-shipping-rate-'+id;
		var json_object = $.parseJSON(response);
		
		if (json_object.success) {
			$(addRateRow).before(json_object.contents);
		} else {
			$.each($.parseJSON(json_object.contents), function(key, value) {
				$('#flashMessage').text(value);
			});
		}
	}
	
	function showMaxPurchase(id) {
		var maxPurchase = '#max-purchase-'+id;
		var maxPurchaseLink = '#max-purchase-link-'+id;
		var maxPriceInput = '#max-price-input-'+id;
		$(maxPurchase).show();
		$(maxPurchaseLink).hide();
		$(maxPurchase + ' input').focus();
		$(maxPriceInput).blur(function() {
			
			if (!($(maxPriceInput).val().length > 0)) {
				$(maxPurchase).hide();
				$(maxPurchaseLink).show();
			}
		});
	}
	
	function showPriceForm(id) {
		
		var priceForm = '#price-form-'+id;
		var weightForm = '#weight-form-'+id;
		$(priceForm).show();
		$(weightForm).hide();
	}
	
	function showWeightForm(id) {
		
		var priceForm = '#price-form-'+id;
		var weightForm = '#weight-form-'+id;
		$(weightForm).show();
		$(priceForm).hide();
	}
	
	
</script>
