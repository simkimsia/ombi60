<div class="domains form">
<?php echo $this->Form->create('Domain');?>
	<fieldset>
 		<legend><?php printf(__('Add %s'), __('Domain')); ?></legend>
	<?php
		echo 'http://' . $this->Form->input('domain');
		echo $this->Form->input('shop_id', array('type'=>'hidden', 'value'=>$shopId));
		echo $this->Form->input('primary', array('type'=>'hidden', 'value'=>false));
		echo $this->Form->input('always_redirect_here', array('type'=>'hidden', 'value'=>false));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(sprintf(__('List %s'), __('Domains')), array('action' => 'index'));?></li>
		
		
	</ul>
</div>