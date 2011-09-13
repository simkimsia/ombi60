<div class="links view">
<h2><?php echo __('Link');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $link['Link']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $link['Link']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Route'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $link['Link']['route']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Link List'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($link['LinkList']['name'], array('controller' => 'link_lists', 'action' => 'view', $link['LinkList']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Link'), array('action' => 'edit', $link['Link']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Link'), array('action' => 'delete', $link['Link']['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $link['Link']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Links'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Link'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Link Lists'), array('controller' => 'link_lists', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Link List'), array('controller' => 'link_lists', 'action' => 'add')); ?> </li>
	</ul>
</div>
