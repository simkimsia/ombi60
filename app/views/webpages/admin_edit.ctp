<div class="webpages form">
<?php echo $this->Form->create('Webpage');?>
	<fieldset>
 		<legend><?php __('Admin Edit Webpage'); ?></legend>
	<?php
	
	$this->TinyMce->editor(array(
			'theme' => 'advanced',
			'mode' => 'textareas',
			'plugins' => ' table',
			'theme_advanced_buttons1' => 'bold,italic,underline,undo,redo,link,unlink,forecolor,styleselect,removeformat,cleanup,code,table,fontselect,fontsizeselect',
			'theme_advanced_buttons2' => '',
			'remove_linebreaks' => false,
			'extended_valid_elements' => 'textarea[cols|rows|disabled|name|readonly|class]'));
	
	
		echo $this->Form->input('id');
		
		
		echo $this->Form->input('title');
		echo $this->Form->input('text');
		echo $this->Form->input('Webpage.author', array('options' => $authors));
		echo $this->Form->input('Webpage.visible', array('options' => array('1'=>'Published', '0'=>'Hidden')));
		
		$label = $this->Form->label('handle', 'Permalink/handle');
		$textbox = $this->Form->text('Webpage.handle');
		$prefix = Router::url('/pages/', true);
		echo $this->Html->div('input text', $label.$prefix.$textbox ,array(), true);
		
		
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Webpage.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Webpage.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Webpages', true), array('action' => 'index'));?></li>
		
	</ul>
</div>