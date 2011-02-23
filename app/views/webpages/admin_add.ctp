<div class="webpages main-container-div">
      <div class="text_center">
        <h2><?php __('Add your New Page');?></h2>
        <?php echo $this->Html->link(__('Cancel', true), array('controller'=>'webpages','action' => 'index')); ?>
    </div>

<?php echo $this->Form->create('Webpage');?>
	<fieldset>
 		<legend><?php __('New page'); ?></legend>
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
		echo $this->Form->input('text', array('label' => __('Write your page', true)));
	
	?>
	</fieldset>
	<fieldset>
 		<legend><?php __('Properties'); ?></legend>
 		<label><?php __('Page Visibility');?></label>
 		<span class="hint">If you want to hide this page from your clients, choose hidden.</span> 		
    <?php 
      echo $this->Form->input('visible',array('options' => array('1'=>'Published', '0'=>'Hidden'), 'label' => false)); 
  		echo $this->Form->input('Webpage.author', array('options' => $authors));
    ?>
  </fieldset>
  <div class="submit">
    <?php echo $this->Form->submit(__('Create page', true), array('div' => false));?> &nbsp;<?php __('or'); ?>&nbsp;
    <?php echo $this->Html->link(__('Cancel', true), array('controller'=>'webpages','action' => 'index')); ?>
  </div>
  <?php echo $this->Form->end(); ?>
</div>
