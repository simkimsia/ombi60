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
	
		// displayed field
		echo '		<div class="form-field clear">';
		echo $this->Form->label(
			'Fulfillment.order', 
			'Order', 
			array('class' => 'form-label size-120 fl-space2'
		));
		
		$orderLink = $this->Html->link('#' . $fulfillment['Order']['order_no'], array(
			'controller'	=> 'orders',
			'action'		=> 'view',
			'admin'			=> true,
			'id'			=> $fulfillment['Order']['id']
		));		
		
		echo $this->Html->div('form_static_data', $orderLink);

		echo '		</div>';
		// end of order 
		
		// displayed field order_line_item_count
		echo '		<div class="form-field clear">';
		echo $this->Form->label(
			'Fulfillment.order_line_item_count', 
			'Total Line Items shipped', 
			array('class' => 'form-label size-120 fl-space2'
		));
		
		echo $this->Html->div('form_static_data', $fulfillment['Fulfillment']['order_line_item_count']);
		echo '		</div>';
		// end of order_line_item_count

		echo $this->Form->input('Fulfillment.tracking_number');
		
		// displayed field created
		echo '		<div class="form-field clear">';
		echo $this->Form->label(
			'Fulfillment.created', 
			'Created', 
			array('class' => 'form-label size-120 fl-space2'
		));
		echo $this->Html->div('form_static_data', $fulfillment['Fulfillment']['created']);

		echo '		</div>';
		// end of created
		
		


		

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