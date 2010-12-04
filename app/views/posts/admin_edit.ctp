<div class="posts form">
<?php echo $this->Form->create('Post', array('url'=>Router::url(array('controller'=>'posts',
							  'action'=>'edit',
							  'blog_id'=>$blog_id,
							  'id'=>$this->data['Post']['id']),true)));?>
	<fieldset>
 		<legend><?php __('Admin Edit Post'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('blog_id', array('type'=>'hidden', 'value'=>$blog_id));
		echo $this->Form->input('author_id');
		echo $this->Form->input('status',array('options' => array('1'=>'Published', '0'=>'Hidden')));
		echo $this->Form->input('title');
		
		
		$label = $this->Form->label('handle', 'Permalink/handle');
		$textbox = $this->Form->text('Post.slug');
		$prefix = Router::url('/blogs/'.$this->data['Blog']['short_name'].'/'.$this->data['Post']['id'].'-', true);
		echo $this->Html->div('input text', $label.$prefix.$textbox ,array(), true);
		
		echo $this->Form->input('body');
		
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', 'id'=>$this->Form->value('Post.id'), 'blog_id'=>$this->Form->value('Post.blog_id')), null, sprintf(__('Are you sure you want to delete %s?', true), $this->Form->value('Post.title'))); ?></li>
		
	</ul>
</div>