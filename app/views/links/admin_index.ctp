<div class="links index">
	<h2><?php __('Links');?></h2>
	
	<?php
	foreach ($lists as $list):
	
	echo $list['LinkList']['name'];
	
	?>
	
	<table cellpadding="0" cellspacing="0">
	<tr>
			
			<th><?php echo 'Name';?></th>
			<th><?php echo 'Route';?></th>
			
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($list['Link'] as $link):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		
		<td><?php echo $link['name']; ?>&nbsp;</td>
		<td><?php echo $this->Html->link($link['route'],
						 $link['route']); ?>&nbsp;</td>
		
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $link['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $link['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $link['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $link['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
<?php endforeach; ?>
	<p>

</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Link', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Link Lists', true), array('controller' => 'link_lists', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Link List', true), array('controller' => 'link_lists', 'action' => 'add')); ?> </li>
	</ul>
</div>