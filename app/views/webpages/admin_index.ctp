<div class="webpages index">
	<h2><?php __('Webpages');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
		
			<th><?php echo $this->Paginator->sort('title');?></th>
		
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th><?php echo $this->Paginator->sort('meta_title');?></th>
			<th><?php echo $this->Paginator->sort('meta_keywords');?></th>
			<th><?php echo $this->Paginator->sort('meta_description');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($webpages as $webpage):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		
		<td><?php echo $webpage['Webpage']['title']; ?>&nbsp;</td>
		
		<td><?php echo $webpage['Webpage']['created']; ?>&nbsp;</td>
		<td><?php echo $webpage['Webpage']['modified']; ?>&nbsp;</td>
		<td><?php echo $webpage['Webpage']['meta_title']; ?>&nbsp;</td>
		<td><?php echo $webpage['Webpage']['meta_keywords']; ?>&nbsp;</td>
		<td><?php echo $webpage['Webpage']['meta_description']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $webpage['Webpage']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $webpage['Webpage']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $webpage['Webpage']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $webpage['Webpage']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>

<div class="blogs index">
	<h2><?php __('Blogs');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
		
			<th><?php __('Title');?></th>
			
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($blogs as $blog):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		
		<td><?php echo $blog['Blog']['name']; ?>&nbsp;</td>

		<td><?php echo $blog['Blog']['created']; ?>&nbsp;</td>
		<td><?php echo $blog['Blog']['modified']; ?>&nbsp;</td>
		
		
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('controller'=>'blogs','action' => 'view', $blog['Blog']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('controller'=>'blogs','action' => 'edit', $blog['Blog']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('controller'=>'blogs','action' => 'delete', $blog['Blog']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $blog['Blog']['id'])); ?>
		</td>
	</tr>
	
	
<?php endforeach; ?>
	</table>

</div>


<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Webpage', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('New Blog', true), array('controller'=>'blogs','action' => 'add')); ?></li>
	</ul>
</div>