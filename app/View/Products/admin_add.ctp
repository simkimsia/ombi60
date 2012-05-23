<h1 class="center"><?php echo __('Add your New Product');?></h1>
<div class="rule"></div>
<div id="action-links">
	<ul>
		<li id="no-icon"><?php echo $this->Html->link(__('Cancel'), array('action' => 'index')); ?></li>
	</ul>

</div>

<div class="content-box">
	<div class="box-body">

		<div class="box-wrap clear">
			<?php

				echo $this->Form->create('Product', array(
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
					echo $this->Form->input('Product.title', array(
						'class' => 'text',
					));

				?>		
			</div>
			
			<div class="rule2"></div>
			<div class="form-field clear">
				<input type="submit" class="button" value="Create Product" />&nbsp;or&nbsp;
				<?php echo $this->Html->link(__('Cancel'), array('controller'=>'webpages','action' => 'index')); ?>
			</div>

		<?php echo $this->Form->end(); ?>
					
		</div>
	</div>
</div>