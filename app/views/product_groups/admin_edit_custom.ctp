<div class="collections">
    <div class="text_center">
      <h2>
        <?php echo isset($this->data['ProductGroup']['title']) ? $this->data['ProductGroup']['title'] : ""; ?>
      </h2>
      <?php 
        echo $this->Html->link(__('View', true), array('action' => 'view', $this->Form->value('ProductGroup.id')));
        echo ' | '. $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('ProductGroup.id')), null, sprintf(__('Are you sure you want to delete page %s?', true), $this->Form->value('ProductGroup.title')));
        echo ' | '. $this->Html->link(__('Back to Pages', true), array('controller'=>'product_groups','action' => 'index'));  
      ?>
    </div>
<?php echo $this->Form->create('ProductGroup');?>
	<fieldset>
 		<legend><?php __('Edit this Smart Collection'); ?></legend>
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
	
	
		echo $this->Form->input('id');
		
		
		echo $this->Form->input('title');
  
		$label = $this->Form->label('handle', 'Permalink/handle');
		$textbox = $this->Form->text('ProductGroup.handle', array('class' => 'small'));
		$prefix = Router::url('/collections/', true);
		$suffix = ' ( ' . $this->Html->link(__('What is this?', true), '#') . ' )';
		echo $this->Html->div('input text', $label.$prefix.$textbox. $suffix ,array(), true);
		echo $this->Form->input('description', array('label' => __('Write description of collection', true)));
			
	?>
	</fieldset>
	
	<fieldset>
 		<legend><?php __('Properties'); ?></legend>
        <label><?php __('Page Visibility');?></label>
 		<span class="hint">If you want to hide this collection from your clients, choose hidden.</span>
    <?php
		  echo $this->Form->input('ProductGroup.visible', array('options' => array('1'=>'Published', '0'=>'Hidden'), 'label' => false));
		  
    ?>
  </fieldset>
  <div class="submit">
    <?php echo $this->Form->submit(__('Update', true), array('div' => false));?> &nbsp;<?php __('or'); ?>&nbsp;
    <?php echo $this->Html->link(__('Cancel', true), array('controller'=>'product_groups','action' => 'index')); ?>
  </div>
  <?php echo $this->Form->end();?>
  
   <?php echo $this->element('admin_product_search_and_list'); ?>
</div>
