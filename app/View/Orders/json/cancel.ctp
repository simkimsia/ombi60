<div id="cancel_order" style="height:460px;width:600px;"> 

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




				</div>

						<div class="rule2 bt-space20"></div>
						<div class="form-field clear">
							<input type="submit" class="button " value="Cancel this order" />
						</div>
				<?php echo $this->Form->end(); ?>

				</div>
			</div>
		</div>

		</div>
	</div>