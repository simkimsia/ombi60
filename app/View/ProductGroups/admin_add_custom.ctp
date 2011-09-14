<div class="collections">
      <div class="text_center">
        <h2><?php echo __('Add your New Custom Collection');?></h2>
        <?php echo $this->Html->link(__('Cancel'), array('controller'=>'product_groups','action' => 'index')); ?>
    </div>

<?php echo $this->Form->create('ProductGroup');?>
	<fieldset>
 		<legend><?php echo __('New Custom Collection'); ?></legend>
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
		echo $this->Form->input('title');
		echo $this->Form->input('description', array('label' => __('Write description of collection')));
	
	?>
	</fieldset>
	<fieldset>
 		<legend><?php echo __('Properties'); ?></legend>
 		<label><?php echo __('Custom Collection Visibility');?></label>
 		<span class="hint">If you want to hide this collection from your clients, choose hidden.</span> 		
    <?php 
	      echo $this->Form->input('visible',array('options' => array('1'=>'Published', '0'=>'Hidden'), 'label' => false)); 

    ?>
  </fieldset>
  <div class="submit">
    <?php echo $this->Form->submit(__('Create Custom Collection'), array('div' => false));?> &nbsp;<?php echo __('or'); ?>&nbsp;
    <?php echo $this->Html->link(__('Cancel'), array('controller'=>'product_groups','action' => 'index')); ?>
  </div>
  <?php echo $this->Form->end(); ?>
</div>
