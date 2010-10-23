<div class="products form">
<?php echo $this->Form->create('Product');?>
	<fieldset>
 		<legend><?php __('Edit Product');?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('shop_id', array('type'=>'hidden', 'value'=> User::get('Merchant.shop_id')));
		echo $this->Form->input('title');
		echo $this->Form->input('code');
		echo $this->Form->input('description');
		echo $this->Form->input('price');
		echo $this->Form->input('weight');
		echo $this->Form->input('shipping_required', array('type'=>'checkbox',  'label'=>'Shipping Address required'));
		$options=array('1'=>'Enabled','0'=>'Disabled');
		echo $this->Form->radio('status',$options);

	?>
	</fieldset>
<?php echo $this->Form->end('Submit');?>
</div>
