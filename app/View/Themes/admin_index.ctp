<div class="themes index">
	<h2><?php echo __('Themes');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('description');?></th>
			<th><?php echo $this->Paginator->sort('author');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($themes as $theme):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $theme['Theme']['id']; ?>&nbsp;</td>
		<td><?php echo $theme['Theme']['name']; ?>&nbsp;</td>
		<td><?php echo $theme['Theme']['description']; ?>&nbsp;</td>
		<td><?php echo $theme['Theme']['author']; ?>&nbsp;</td>
		<td><?php echo $theme['Theme']['created']; ?>&nbsp;</td>
		<td><?php echo $theme['Theme']['modified']; ?>&nbsp;</td>
		
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $theme['Theme']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $theme['Theme']['id'])); ?>
			<?php echo $this->Html->link(__('Delete'), array('action' => 'delete', $theme['Theme']['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $theme['Theme']['id'])); ?>
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
		<?php echo $this->Paginator->prev('<< '.__('previous'), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next').' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(sprintf(__('New %s'), __('Theme')), array('action' => 'settings')); ?></li>
		
		
	</ul>
</div>