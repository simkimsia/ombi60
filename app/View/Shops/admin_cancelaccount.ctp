<div class="merchants form">
	
<?php echo $this->Form->create('Shop');?>
	<fieldset>
 		<legend><?php echo __('Cancel Account');?></legend>
	<?php
                $reasons = array('Choose another provider'=>'Choose another provider',
                                 'Stop business' => 'Stop business',
                                 );
                
                echo 'We are sad to see you go. Please tell us why.<br/>';
                
		echo $this->Form->input('Cancellation.short_reason', array('type'=>'select', 'options'=>$reasons, 'label'=>false));
                
                echo 'Anything else you want us to know?<br/>';
                echo $this->Form->textarea('Cancellation.long_reason', array('label'=>false));
                
		echo $this->Form->submit('Confirm');
                echo ' or ';
                echo $this->Html->link('Go Back', array('controller'=>'shops',
			     'action'=>'account',
			     'admin'=>true));
	?>
	</fieldset>
<?php echo $this->Form->end();?>
</div>
