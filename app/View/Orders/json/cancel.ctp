<div id="cancel_order" style="height:440px;width:600px;"> 

	<div class="clear">


	<div class="clean-margin content-box">
		<div class="box-body">
			<div class="box-header clear left">
				<h2>Cancel Order</h2>
			</div>
			
			<div class="box-wrap clear">
			<div class="left">
				<p class="clean-padding bt-space10">You should cancel this order if any of the following is true: </p>
				<ul class="tree">
					<li> order was fraudulent </li>
					<li> OR customer changed their minds </li>
					<li> OR products are unavailable </li>
				</ul>
				<p class="clean-padding bt-space10">Cancelling an order is final and <strong class="highlight-alt">there is no undo</strong>.</p>
			</div>
			
			<div class="rule"></div>
			<?php

				echo $this->Form->create('Order', array(
					'class' => 'validate-form form', 
					'inputDefaults' => array(
						'label' => array(
							'class' => ''
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
				<div class="left">

			<?php
			
				$cancelReasons = array(
					'Customer changed/cancelled orders',
					'Fraudulent order',
					'Products unavailable',
					'Other'
				);
			
				echo $this->Form->input('Order.cancel_reason', array(
					'type' => 'select',
					'options' => $cancelReasons,
					'label' => 'Reason: ',
					'div'	=> array(
						'class' => 'form-field clear bt-space10'
					)
				));
				
				echo '<div class="clear bt-space10">';
				echo '<div class="fl-space2 trio">';
				
				$authorized = ($order['Order']['payment_status'] == PAYMENT_AUTHORIZED);
				$paid		= ($order['Order']['payment_status'] == PAYMENT_PAID);

				if ($authorized) {
					echo $this->Form->input('Order.actions.void_authorization', array(
						'type' => 'checkbox',
						'checked' => true,
						'label' => array(
							'class' => 'right',
							'text' => '<strong>Void Authorization</strong>'
						),
						'div'	=> array(
							'class' => 'bt-space10'
						)
					));			
					
				} else if ($paid) {
					echo $this->Form->input('Order.actions.refund_payment', array(
						'type' => 'checkbox',
						'checked' => true,
						'label' => array(
							'class' => 'right',
							'text' => '<strong>Refund Payment</strong>'
						),
						'div'	=> array(
							'class' => 'bt-space10'
						)
					));					
				}

				echo '</div>';// trio fl-space2
				
				echo '<div class="lastcol">';
				if ($authorized) {
					echo '<p>You have not accepted payment yet. OMBI60 will void the authorization, releasing the money back to the customers</p>';
				} else if ($paid) {
					echo '<p>You have accepted payment. OMBI60 will refund the payment, returning the money back to the customers</p>';
				}

				
				echo '</div>';// lastcol
				
				echo '</div>';// clear bt-space10
				

				echo '<div class="clear bt-space10">';
				echo '<div class="fl-space2 trio">';

				echo $this->Form->input('Order.actions.send_email', array(
					'type' => 'checkbox',
					'checked' => true,
					'label' => array(
						'class' => 'right',
						'text' => '<strong>Send Email</strong>'
					),
					'div'	=> array(
						'class' => 'bt-space10'
					)
				));			

				echo '</div>';// trio fl-space2
				
				echo '<div class="lastcol">';
				echo '<p>Send a notification email to the customer.</p>';
				
				echo '</div>';// lastcol
				
				echo '</div>';// clear bt-space10			
			
			?>

				</div>

						<div class="rule2 bt-space20"></div>
						<div class="form-field clear fl">
							<input type="submit" class="button " value="Cancel this order" />
						</div>
				<?php echo $this->Form->end(); ?>

				</div>
			</div>
		</div>

		</div>
	</div>