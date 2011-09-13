<div class="domains view">
<h2><?php echo __('Domain');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $domain['Domain']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Domain'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $domain['Domain']['domain']; ?>
			&nbsp;
		</dd>
		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Primary'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $domain['Domain']['primary']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Always Redirect Here'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $domain['Domain']['always_redirect_here']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(sprintf(__('Edit %s'), __('Domain')), array('action' => 'edit', $domain['Domain']['id'])); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Delete %s'), __('Domain')), array('action' => 'delete', $domain['Domain']['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $domain['Domain']['id'])); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('List %s'), __('Domains')), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('New %s'), __('Domain')), array('action' => 'add')); ?> </li>
		
		
	</ul>
</div>
