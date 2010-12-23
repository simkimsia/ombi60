<?php
	echo $this->Html->script('http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js');
?>
<div class="shippingRates form">
<?php echo $this->Form->create('ShippingRate', array('url'=>array('action'=>'edit',
								  'controller'=>'shipping_rates',
								  'admin'=>true,
								  'based'=>$based,
								)));?>
	<fieldset>
 		<legend><?php __('Edit Shipping Rate'); ?></legend>
		
	<dl id="details">
		<?php $displayCountryTitle = ($this->data['Country']['name'] !== null) ? $this->data['Country']['printable_name'] : 'Rest of World'; ?>
		
		<dt><?php __('Name'); ?></dt>
		<dd>
			<?php echo $this->data['ShippingRate']['name']; ?>
			&nbsp;
		</dd>
		<dt><?php __('Price'); ?></dt>
		<dd>
			<?php echo $this->Number->currency($this->data['ShippingRate']['price']); ?>
			&nbsp;
		</dd>
		<dt><?php __('Shipping to '); ?></dt>
		<dd>
			
			<?php echo $displayCountryTitle; ?>
			&nbsp;
		</dd>
		<?php if (array_key_exists('WeightBasedRate', $this->data)) { ?>
		<dt><?php __('Weight Range'); ?></dt>
		<dd>
			<?php echo 'From ' . $this->data['WeightBasedRate']['min_weight'] . ' to ' . $this->data['WeightBasedRate']['max_weight']; ?>
			&nbsp;
		</dd>
		<?php } ?>
		
		<?php if (array_key_exists('PriceBasedRate', $this->data)) { ?>
		<dt><?php __('Price Range'); ?></dt>
		<dd>
			<?php if ( $this->data['PriceBasedRate']['max_price'] !== null) echo 'From ' . $this->data['PriceBasedRate']['min_price'] . ' to ' . $this->data['PriceBasedRate']['max_price']; ?>
			
			<?php if ( $this->data['PriceBasedRate']['max_price'] == null) echo $this->Number->currency($this->data['PriceBasedRate']['min_price']) . ' and above';?>
		</dd>
		<?php } ?>
	</dl>
		
	<div id="editForm" style="display:none">
	<?php
		$id = $this->data['ShippingRate']['id'];
		echo $this->Form->input('ShippingRate.name');
		echo $this->Form->input('ShippingRate.shipped_to_country_id', array('type'=>'hidden'));
		echo $this->Form->input('ShippingRate.id', array('type'=>'hidden'));
		echo $this->Form->input('ShippingRate.price', array('label'=>'Price to ship'));

		if (array_key_exists('WeightBasedRate', $this->data)) { 
		
			echo $this->Form->label('Weight');
			echo $this->Form->input('WeightBasedRate.id', array('type'=>'hidden'));
			echo $this->Form->text('WeightBasedRate.min_weight');
			echo 'kg - ';
			echo $this->Form->text('WeightBasedRate.max_weight');
			echo 'kg';
		}
		
		if (array_key_exists('PriceBasedRate', $this->data)) {
			echo $this->Form->input('PriceBasedRate.id', array('type'=>'hidden'));
			echo $this->Form->label('Purchase range');
			echo '$';
			echo $this->Form->text('PriceBasedRate.min_price');
			echo 'SGD';
			
			echo '&nbsp;<a href="#" id="max-purchase-link-'.$id.'" onclick="showMaxPurchase('.$id.');return false;">and more</a>';
			$style = ($this->data['PriceBasedRate']['max_price'] == null) ? 'style="display:none"' : '';
			echo '<span id="max-purchase-'.$id.'" '. $style .'>';
			echo $this->Form->text('PriceBasedRate.max_price', array('id'=>'max-price-input-'.$id));
			echo 'SGD';
			echo '</span>';
		}
		
		echo $this->Form->submit(__('Submit', true));
	
	?>
	
	</div>
	</fieldset>
<?php echo $this->Form->end();?>
</div>


<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo '<a href="#" onclick="toggleEditForm();return false;">'. __('Edit Shipping Rate', true) . '</a>'; ?> </li>
		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->data['ShippingRate']['id']), null, sprintf(__('Are you sure you want to delete %s for %s?', true), $this->data['ShippingRate']['name'], $displayCountryTitle)); ?></li>
		
	</ul>
</div>
<script>

	

	function toggleEditForm() {
		$('#editForm').toggle();
		$('#details').toggle();
	}
	
	function showMaxPurchase(id) {
		var maxPurchase = '#max-purchase-'+id;
		var maxPurchaseLink = '#max-purchase-link-'+id;
		var maxPriceInput = '#max-price-input-'+id;
		$(maxPurchase).show();
		$(maxPurchaseLink).hide();
		$(maxPurchase + ' input').focus();
		$(maxPriceInput).blur(function() {
			if (!($(maxPriceInput).val().length)) {
				$(maxPurchase).hide();
				$(maxPurchaseLink).show();
			}
		});
	}
</script>
	