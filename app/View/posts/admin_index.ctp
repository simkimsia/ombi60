<div class="posts index">
	<h2><?php echo __('Posts');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('blog_id');?></th>
			<th><?php echo $this->Paginator->sort('author_id');?></th>
			<th><?php echo $this->Paginator->sort('visible');?></th>
			<th><?php echo $this->Paginator->sort('title');?></th>
			<th><?php echo $this->Paginator->sort('slug');?></th>
			<th><?php echo $this->Paginator->sort('content');?></th>
			<th><?php echo $this->Paginator->sort('no_comments');?></th>
			<th><?php echo $this->Paginator->sort('allow_comments');?></th>
			<th><?php echo $this->Paginator->sort('allow_pingback');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($posts as $post):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $post['Post']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($post['Blog']['title'], array('controller' => 'blogs', 'action' => 'view', $post['Blog']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($post['Author']['name'], array('controller' => 'authors', 'action' => 'view', $post['Author']['id'])); ?>
		</td>
		<td><?php echo $post['Post']['visible']; ?>&nbsp;</td>
		<td><?php echo $post['Post']['title']; ?>&nbsp;</td>
		<td><?php echo $post['Post']['slug']; ?>&nbsp;</td>
		<td><?php echo $post['Post']['content']; ?>&nbsp;</td>
		<td><?php echo $post['Post']['no_comments']; ?>&nbsp;</td>
		<td><?php echo $post['Post']['allow_comments']; ?>&nbsp;</td>
		<td><?php echo $post['Post']['allow_pingback']; ?>&nbsp;</td>
		<td><?php echo $post['Post']['created']; ?>&nbsp;</td>
		<td><?php echo $post['Post']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $post['Post']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $post['Post']['id'])); ?>
			<?php echo $this->Html->link(__('Delete'), array('action' => 'delete', $post['Post']['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $post['Post']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%')
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous'), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next') . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Post'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Blogs'), array('controller' => 'blogs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Blog'), array('controller' => 'blogs', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Authors'), array('controller' => 'authors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Author'), array('controller' => 'authors', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Comments'), array('controller' => 'comments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Comment'), array('controller' => 'comments', 'action' => 'add')); ?> </li>
	</ul>
</div>