<div class="savedThemes index">
	<h2><?php echo __('Saved Themes');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('description');?></th>
			<th><?php echo $this->Paginator->sort('author');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th><?php echo $this->Paginator->sort('folder_name');?></th>
			<th><?php echo $this->Paginator->sort('shop_id');?></th>
			<th><?php echo $this->Paginator->sort('theme_id');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($savedThemes as $savedTheme):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $savedTheme['SavedTheme']['id']; ?>&nbsp;</td>
		<td><?php echo $savedTheme['SavedTheme']['name']; ?>&nbsp;</td>
		<td><?php echo $savedTheme['SavedTheme']['description']; ?>&nbsp;</td>
		<td><?php echo $savedTheme['SavedTheme']['author']; ?>&nbsp;</td>
		<td><?php echo $savedTheme['SavedTheme']['created']; ?>&nbsp;</td>
		<td><?php echo $savedTheme['SavedTheme']['modified']; ?>&nbsp;</td>
		<td><?php echo $savedTheme['SavedTheme']['folder_name']; ?>&nbsp;</td>
		
		<td>
			<?php echo $this->Html->link($savedTheme['Theme']['name'], array('controller' => 'themes', 'action' => 'view', $savedTheme['Theme']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $savedTheme['SavedTheme']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $savedTheme['SavedTheme']['id'])); ?>
			<?php echo $this->Html->link(__('Delete'), array('action' => 'delete', $savedTheme['SavedTheme']['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $savedTheme['SavedTheme']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Saved Theme'), array('action' => 'add')); ?></li>
		
		
		<li><?php echo $this->Html->link(__('List Themes'), array('controller' => 'themes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Theme'), array('controller' => 'themes', 'action' => 'add')); ?> </li>
	</ul>
</div>