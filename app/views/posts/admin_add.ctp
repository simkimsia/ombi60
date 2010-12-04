<div class="posts form">
<?php echo $this->Form->create('Post', array('url'=>array('controller'=>'posts',
					     'action' => 'add',
					     'blog_id'=>$blog_id)));?>
	<fieldset>
 		<legend><?php __('Admin Add Post'); ?></legend>
	<?php
		echo $this->Form->input('blog_id', array('type'=>'hidden', 'value'=>$blog_id));
		echo $this->Form->input('author_id', array('options' => $authors));
		
		echo $this->Form->input('title');
		
		echo $this->Form->input('body');
		
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Cancel', true), array('controller'=>'blogs','action' => 'view', $blog_id));?></li>
		
	</ul>
</div>