<h1 class="center"><?php echo __('Add your New Page');?></h1>
<div class="rule"></div>
<!--
<div id="action-links">
	<ul>
	    <li class="no-icon"><?php echo $this->Html->link(__('Cancel'), array('controller'=>'blogs','action' => 'view', $blog_id));?></li>
	</ul>
</div>
-->

<div class="content-box">
	<div class="box-body">
		<div class="box-wrap clear">
			<?php

				echo $this->Form->create('Webpage', array(
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
						),

					)
				));
			?>
			<div class="columns clear bt-space15">

			<?php
			$this->TinyMce->editor(array(
					'theme' => 'advanced',
					'mode' => 'textareas',
					'plugins' => ' table',
					'theme_advanced_buttons1' => 'bold,italic,underline,undo,redo,link,unlink,forecolor,styleselect,removeformat,cleanup,code,table,fontselect,fontsizeselect',
					'theme_advanced_buttons2' => '',
					'remove_linebreaks' => false,
					'theme_advanced_toolbar_location' => 'top',
					'extended_valid_elements' => 'textarea[cols|rows|disabled|name|readonly|class]'));
	
				
				echo $this->Form->input('Webpage.shop_id', array('type'=>'hidden', 'value'=>Shop::get('Shop.id')));
		
				echo $this->Form->input('Webpage.title', array(
					'class' => 'required text fl-space2'
				));
		
				echo $this->Form->input('Webpage.content', array(
					'label' => array(
						'text' => 'Write your page',
						'class' => 'form-label size-120 fl-space2',
					),
					'class' => 'textarea fl-space2'
				));
		
				?>
				

				
				<?php
				
				echo $this->Form->input('Webpage.visible',array(
					'options' => array(
						'1'=>'Published', 
						'0'=>'Hidden'), 
					'label' => array(
						'text' => 'Visibility',
						'class' => 'form-label size-120 fl-space2',
					),
				)); 
				
				?>
				
					

				<?php
		  		echo $this->Form->input('Webpage.author', array('options' => $authors));
      
	
			?>
	
			</div>
	
			<div class="rule2"></div>
			<div class="form-field clear">
				<input type="submit" class="button" value="Create New Page" />&nbsp;or&nbsp;
				<?php echo $this->Html->link(__('Cancel'), array('controller'=>'webpages','action' => 'index')); ?>
			</div>
			<?php echo $this->Form->end(); ?>

		</div>
	</div>
</div>
