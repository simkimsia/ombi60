<div id="contact" style="height:460px;width:600px;"> 

	<div class="clear">


	<div class="clean-margin content-box">
		<div class="box-body">
			<div class="box-wrap clear">
			<?php

				echo $this->Form->create('Order', array(
					'class' => 'validate-form form', 
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
						),
					)
				));
			?>
				<div class="columns clear">

			<?php
				$toName = $order['User']['full_name'];
				$toEmail = $order['User']['email'];
				
				$toEmailAddresses = array(
					$toEmail => $toName
				);
				
				App::uses('StringLib', 'UtilityLib.Lib');
				$emailStringTo = StringLib::emailAddressFormat($toEmailAddresses);
				
				echo $this->Form->input('ContactEmail.to', array(
					'label' => array(
						'text' => 'To',
						'class' => 'form-label size-120 fl-space2 bt-space10',
					),
					'class' => 'required text fl-space2 size-200',
					'value' => $emailStringTo
				));

				$fromEmailAddresses = array(
					$fromEmail => $fromName
				);
				
				$emailStringFrom = StringLib::emailAddressFormat($fromEmailAddresses);
		
				echo $this->Form->input('ContactEmail.from', array(
					'label' => array(
						'text' => 'From',
						'class' => 'form-label size-120 fl-space2',
					),
					'class' => 'required text fl-space2 size-200 bt-space10',
					'value'	=> $emailStringFrom
				));
				
				echo $this->Form->input('ContactEmail.subject', array(
					'label' => array(
						'text' => 'Subject',
						'class' => 'form-label size-120 fl-space2 ',
					),
					'class' => 'required text fl-space2 size-200 bt-space20',
					'value'	=> 'Order #' . $order['Order']['order_no'] . ' with ' . $shopName
				));
		
				?>
				
				
				<?php
				$emailContent = 'Dear ' . $toName . ",\n\n\n" . $shopName;
				
				echo $this->Form->input('ContactEmail.content', array(
					'label' => false,
					'class' => 'textarea bt-space30 full clean-padding',
					'cols'	=> '80',
					'rows'	=> '12',
					'type' => 'textarea',
					'default'	=> $emailContent,
					'escape' => false
				));
								
				?>
				
					
	
					</div>
	
					<div class="rule2 bt-space20"></div>
					<div class="form-field clear">
						<input type="submit" class="button " value="Send Email" />
					</div>
			<?php echo $this->Form->end(); ?>

			</div>
		</div>
	</div>
		
	</div>
</div>