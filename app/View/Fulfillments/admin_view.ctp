<h1><?php echo __('Report for Fulfillment');?></h1>

<div class="content-box">
	<div class="box-body">
		<div class="box-header clear">
			<h2>About Your Store</h2>
		</div>
	
		<div class="box-wrap clear">

		<?php

			echo $this->Form->create('Fulfillment', array(
				'class' => 'validate-form form bt-space15', 
				'inputDefaults' => array(
					'label' => array(
						'class' => 'form-label size-120 fl-space2'
					),
					'div'	=> array(
						'class' => 'form-field clear'
					),
					'error' => array(
						'attributes' => array(
							'wrap' => 'label', 
							'class' => 'error', 
							'for' => true
						)
					)
				)
			));
		?>
		
			<div class="columns clear bt-space15">
		<?php	
		echo $this->Form->input('Fulfillment.id', array(
			'type'=>'hidden', 
			'value'=>$fulfillment['Fulfillment']['id']
		));
		
		echo $this->Form->input('Fulfillment.order_id', array(
			'type'=>'hidden', 
			'value'=>$fulfillment['Fulfillment']['order_id']
		));

		echo $this->Form->label(
			'Fulfillment.order', 
			'Order', 
			array('class' => 'form-label size-120 fl-space2'
		));

			
			
		echo $this->Form->input('Fulfillment.tracking_number');

		

	   ?>
		
		</div>
		<div class="rule2"></div>
		<div class="form-field clear">
			<input type="submit" class="button" value="Update" />
		</div>
		

		

		<?php echo $this->Form->end(); ?>
		
		</div>
	</div>
</div>

<script type="text/javascript" language="javascript">


</script>