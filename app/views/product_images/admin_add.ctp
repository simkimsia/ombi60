<div class="productImages form">
<?php echo $this->Form->create('ProductImage', array('type'=>'file'));?>
	<fieldset>
 		<legend><?php __('Add ProductImage');?></legend>
	<?php
		
		echo $this->Form->file('image');
	?>
	</fieldset>
<?php echo $this->Form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List ProductImages', true), array('action' => 'index'));?></li>
	</ul>
</div>

