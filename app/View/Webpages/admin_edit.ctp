<div class="webpages">
    <div class="text_center">
      <h2>
        <?php echo isset($this->request->data['Webpage']['title']) ? $this->request->data['Webpage']['title'] : ""; ?>
      </h2>
      <?php 
        echo $this->Html->link(__('View'), array('action' => 'view', $this->Form->value('Webpage.id')));
        echo ' | '. $this->Html->link(__('Delete'), array('action' => 'delete', $this->Form->value('Webpage.id')), null, sprintf(__('Are you sure you want to delete page %s?'), $this->Form->value('Webpage.title')));
        echo ' | '. $this->Html->link(__('Back to Pages'), array('controller'=>'webpages','action' => 'index'));  
      ?>
    </div>
<?php echo $this->Form->create('Webpage');?>
	<fieldset>
 		<legend><?php echo __('Edit this page'); ?></legend>
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
		$textbox = $this->Form->text('Webpage.handle', array('class' => 'small'));
		$prefix = Router::url('/pages/', true);
    $suffix = ' ( ' . $this->Html->link(__('What is this?'), '#') . ' )';
		echo $this->Html->div('input text', $label.$prefix.$textbox. $suffix ,array(), true);
		echo $this->Form->input('text', array('label' => __('Write your page')));
			
	?>
	</fieldset>
	<fieldset>
 		<legend><?php echo __('Properties'); ?></legend>
        <label><?php echo __('Page Visibility');?></label>
 		<span class="hint">If you want to hide this page from your clients, choose hidden.</span>
    <?php
		  echo $this->Form->input('Webpage.visible', array('options' => array('1'=>'Published', '0'=>'Hidden'), 'label' => false));
		  echo $this->Form->input('Webpage.author', array('options' => $authors));
    ?>
  </fieldset>
  <div class="submit">
    <?php echo $this->Form->submit(__('Update'), array('div' => false));?> &nbsp;<?php echo __('or'); ?>&nbsp;
    <?php echo $this->Html->link(__('Cancel'), array('controller'=>'webpages','action' => 'index')); ?>
  </div>
  <?php echo $this->Form->end();?>
</div>
