<?php
	echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js');
	
	// include uploadify specific js files
	echo $this->Html->script('/uploadify/js/jquery.uploadify.v2.1.0.min');
	echo $this->Html->script('/uploadify/js/swfobject');
	
	
	
	
?>
<?php echo $this->Html->script('variant_options', array('inline' => false));?>
<div>
<div class="text_center"><h2><?php echo __($this->Form->value('Product.title'));?></h2>
    <?php echo $this->Html->link(__('Duplicate'), array('action' => 'duplicate', $this->Form->value('Product.id'))); ?>|
    <?php echo $this->Html->link(__('Delete'), array('action' => 'delete', $this->Form->value('Product.id')), null, sprintf(__('Are you sure you want to delete this product?'))); ?>|
    <?php echo $this->Html->link(__('Cancel'), array('action' => 'index', 'admin' => true));?>
</div>
<?php
	echo $this->element('errors', array('errors' => $errors));
	echo $this->Form->create('Product' , array('type'=>'file'));
	echo $this->Form->input('id');
	echo $this->Form->input('shop_id', array('type'=>'hidden', 'value'=> User::get('Merchant.shop_id')));
?>
	<fieldset>
 		<legend><?php echo __('Edit this Product');?></legend>
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
	
		echo $this->Form->input('shop_id', array('type'=>'hidden', 'value'=> Shop::get('Shop.id')));
		echo $this->Form->error('Product.title');
		$titleLabel = $this->Form->label('title');
		echo $this->Form->input('title', array('error' => false, 'label' => false));
		
		$label = $this->Form->label('handle', 'Permalink/handle');
		$textbox = $this->Form->text('Product.handle', array('class' => 'small'));
		$prefix = Router::url('/products/', true);
		$suffix = ' ( ' . $this->Html->link(__('What is this?'), '#') . ' )';
		echo $this->Html->div('input text', $label.$prefix.$textbox. $suffix ,array(), true);
		
		echo $this->Form->input('description');
		
		echo $this->Form->input('Product.alt_id', array('type'=>'hidden', 'id'=>'alt_id', 'value'=>0));
	?>

	</fieldset>
	<fieldset class="left">
	<legend><?php echo __('Properties'); ?></legend>
	
        <?php echo $this->element('variant_options');?>

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
	echo $this->Form->submit(__('Update Product'), array('div' => FALSE));
	echo ' or ' . $this->Html->link(__('Cancel'), array('action' => 'index', 'admin' => true)); 
	echo '</div>';
	echo $this->Form->end();
?>
<?php
        $voptions = array(
                        'title' => 'Title',
                        'color' => 'Color',
                        'style' => 'Style',
                        'size' => 'Size',
                        'material' => 'Material',
                        'custom' => 'Custom',
                        );
        ?>
<?php echo $this->element('add_variant_option', array('voptions' => $voptions));?>

<?php echo $this->element('list_of_variants',array('variant_list' => $this->request->data));?>
</div>


