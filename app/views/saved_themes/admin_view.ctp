<div class="savedThemes view">
<h2><?php  __('Saved Theme');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $savedTheme['SavedTheme']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $savedTheme['SavedTheme']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $savedTheme['SavedTheme']['description']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Author'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $savedTheme['SavedTheme']['author']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $savedTheme['SavedTheme']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $savedTheme['SavedTheme']['modified']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Folder Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $savedTheme['SavedTheme']['folder_name']; ?>
			&nbsp;
		</dd>
		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Theme'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($savedTheme['Theme']['name'], array('controller' => 'themes', 'action' => 'view', $savedTheme['Theme']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Saved Theme', true), array('action' => 'edit', $savedTheme['SavedTheme']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Saved Theme', true), array('action' => 'delete', $savedTheme['SavedTheme']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $savedTheme['SavedTheme']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Saved Themes', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Saved Theme', true), array('action' => 'add')); ?> </li>
		
		
		<li><?php echo $this->Html->link(__('List Themes', true), array('controller' => 'themes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Theme', true), array('controller' => 'themes', 'action' => 'add')); ?> </li>
	</ul>
</div>
