<?php
	
	echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js');
	
	//Here we will include all the JQuery files required by multi file functionlity
	
	echo $this->Html->script('jquery/multiple_file/jquery.MultiFile.js');

	
	
?>
<div>
<h2 align="center"><?php echo __('Add your New Product');?></h2>
<div align="center"><?php echo $this->Html->link(__('Cancel'), array('action' => 'index', 'admin' => true)); ?></div>
<?php
	echo $this->element('errors', array('errors' => $errors));
	echo $this->Form->create('Product' , array('type'=>'file'));
?>
	<fieldset>
 		<legend><?php echo __('New Product');?></legend>
	<?php
	
	
		$this->TinyMce->editor(array(
			'theme' => 'advanced',
			'mode' => 'textareas',
			'plugins' => ' table',
			'theme_advanced_buttons1' => 'bold,italic,underline,undo,redo,link,unlink,forecolor,styleselect,removeformat,cleanup,code,table,fontselect,fontsizeselect',
			'theme_advanced_buttons2' => '',
			'theme_advanced_toolbar_location' => 'top',
			'remove_linebreaks' => false,
			'extended_valid_elements' => 'textarea[cols|rows|disabled|name|readonly|class]'));
    echo $this->Form->input('shop_id', array('type'=>'hidden', 'value'=>Shop::get('Shop.id')));
		//echo $this->Form->input('shop_id', array('type'=>'hidden', 'value'=> User::get('Merchant.shop_id')));
		echo $this->Form->error('Product.title');
		$titleLabel = $this->Form->label('title');
		$titleHint = __('Examples: 14" LCD Screen, Maroon Brand X T-shirt');
		echo $this->Form->input('title', array('error' => false, 'label' => false, 'before' => $titleLabel . '<span class="hint">' . $titleHint . '</span>'));
		echo $this->Form->input('description', array('label' => __('Describe your product')));
		
	?>

	</fieldset>
	<fieldset class="left">
	<legend><?php echo __('Properties'); ?></legend>
	<?php
		$codeLabel = $this->Form->label('code', __('SKU Code <span class="small">(Optional)</span>')) . __(' ');
  		$codeHint = __('Unique identifier of the product for easier organization');
		echo $this->Form->input('code', array('before' => $codeLabel. '<span class="hint">' . $codeHint . '</span>', 'label' => false));
		$options=array('1'=> __('Published'),'0'=> __('Hidden'));
  		$attributes=array('value' => '1', 'legend' => __('Visible in store'));
	  	echo $this->Form->radio('visible',$options, $attributes);
		echo $this->Form->input('shipping_required', array('type'=>'checkbox', 'checked'=>'checked', 'value'=>1, 'label'=>'Shipping Address required'));
		$currency = $shop_setting['currency'];
		echo $this->Form->input('currency', array('type'=>'hidden', 'value'=>$currency));
		echo $this->Form->input('price', array('value'=>'0.00', 'label' => __('Selling Price'), 'div' => array('class' => 'input text left'), 'after' => __(' ' .  $currency), 'class' => 'noclear'));
		echo $this->Form->input('displayed_weight', array('value'=>'0.0', 'div' => array('class' => 'input text right'), 'class' => 'noclear', 'after' => __(' ' . $unitForWeight)));
		
		echo '<strong>Product Options</strong>';
		echo $this->Form->input('Variant.0.VariantOption.0.field', array('label' => __('Option Field'),'value'=>'Title'));
		echo $this->Form->input('Variant.0.VariantOption.0.value', array('label' => __('Default Value'), 'value'=>'Default Title'));
		echo $this->Form->input('Variant.0.VariantOption.0.order', array('type'=>'hidden', 'value'=>'0'));
	?>
	</fieldset>
	
	<fieldset class="right">
	<legend><?php echo __('Product Images'); ?></legend>
	<br />
	<?php //echo $this->Form->input('ProductImage.product_images', array('class' => 'multi', 'type' => 'file', 'accept' => 'gif|jpg'));?>
	<input type="file" class="multi max-4" maxlength="4" name="product_images[]" accept="gif|jpg|jpeg|png|ico|bmp"/>
	</fieldset>
	
	<fieldset class="right">
		<legend><?php echo __('Collections'); ?></legend>
		<?php echo $this->Form->input('Product.selected_collections',
					 array('type' => 'select',
					       'multiple' => 'checkbox',
					       'options' => $collections)); ?>
	</fieldset>
	
<?php
	echo '<div class="submit">';
	echo $this->Form->submit(__('Create Product'), array('div' => FALSE));
	echo ' or ' . $this->Html->link(__('Cancel'), array('action' => 'index', 'admin' => true)); 
	echo '</div>';
	echo $this->Form->end();
?>

</div>

