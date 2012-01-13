<h1 class="center"><?php echo __('Add your New Blog');?></h1>
<div class="rule"></div>


<div class="content-box">
	<div class="box-body">

		<div class="box-wrap clear">
			<?php

				echo $this->Form->create('Blog', array(
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
					echo $this->Form->input('Blog.title', array(
						'class' => 'text',
					));

				?>		
			</div>
			
			<div class="rule2"></div>
			<div class="form-field clear">
				<input type="submit" class="button" value="Create Blog" />&nbsp;or&nbsp;
				<?php echo $this->Html->link(__('Cancel'), array('controller'=>'webpages','action' => 'index')); ?>
			</div>

		<?php echo $this->Form->end(); ?>
					
		</div>
	</div>
</div>