<div class="blogs form">
<?php echo $this->Form->create('Blog');?>
	<fieldset>
 		<legend><?php __('Admin Edit Blog'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('short_name');
		
		$label = $this->Form->label('handle', 'Permalink/handle');
		$textbox = $this->Form->text('Blog.short_name');
		$prefix = Router::url('/blogs/', true);
		echo $this->Html->div('input text', $label.$prefix.$textbox ,array(), true);
		
		
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Blog.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Blog.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Blogs', true), array('controller'=>'webpages','action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('New Post', true), array('controller' => 'posts', 'action' => 'add')); ?> </li>
	</ul>
</div>