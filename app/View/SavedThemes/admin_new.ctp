<h1><?php echo __('Upload a new Theme');?></h1>

<div class="content-box">
	<div class="box-body">
		<div class="box-header clear">
			<h2>About Your Store</h2>
		</div>
	
		<div class="box-wrap clear">

		<?php

			echo $this->Form->create('SavedTheme', array(
				'type'	=> 'file',
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
		echo $this->Form->input('SavedTheme.upload', array(
			'type'=>'file'
		));
		
		
		?>
		</div>
		<div class="rule2"></div>
		<div class="form-field clear">
			<input type="submit" class="button" value="Upload Theme" />
		</div>
		
		<?php echo $this->Form->end(); ?>
		
		</div>
	</div>
</div>