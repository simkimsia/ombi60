<div class="domains form">
<?php echo $this->Form->create('Domain');?>
	<fieldset>
 		<legend><?php printf(__('Add %s', true), __('Domain', true)); ?></legend>
	<?php
		echo 'http://' . $this->Form->input('domain');
		echo $this->Form->input('shop_id', array('type'=>'hidden', 'value'=>$shopId));
		echo $this->Form->input('primary', array('type'=>'hidden', 'value'=>false));
		echo $this->Form->input('always_redirect_here', array('type'=>'hidden', 'value'=>false));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Domains', true)), array('action' => 'index'));?></li>
		
		
	</ul>
</div>