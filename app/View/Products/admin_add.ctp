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
					// we need a hidden for Product.shop_id
				    echo $this->Form->input('Product.shop_id', array('type'=>'hidden', 'value'=>Shop::get('Shop.id')));
				
					// hint for the title. now not in use. Perhaps later
					$titleHint = __('Examples: 14" LCD Screen, Maroon Brand X T-shirt');
				
					$titleLabel = $this->Form->label('Product.title', __('<h4>Title</h4>')  . $titleHint);
				
					echo $titleLabel;
					echo $this->Form->input('Product.title', array(
						'class' => 'text size-400',
						'label' => ''
					)); 
					
					

				// prepare the tinymce editor for description
				$this->TinyMce->editor(array(
					'theme' => 'advanced',
					'mode' => 'textareas',
					'plugins' => ' table',
					'theme_advanced_buttons1' => 'bold,italic,underline,undo,redo,link,unlink,forecolor,styleselect,removeformat,cleanup,code,table,fontselect,fontsizeselect',
					'theme_advanced_buttons2' => '',
					'theme_advanced_toolbar_location' => 'top',
					'remove_linebreaks' => false,
					'extended_valid_elements' => 'textarea[cols|rows|disabled|name|readonly|class]'));
					
					//
					echo $this->Form->input('Product.description', array('label' => __('Describe your product')));
					


				?>		
			</div>
			<div class="columns clear bt-space15">
				<div class="col1-2">
					<h2>Properties</h2>
					<div class="rule2"></div>
					<?php
					
					
					// default visible is ON
			    	echo $this->Form->input('Product.visible', array('type'=>'hidden', 'value'=>TRUE));

					echo $this->Form->input('Product.shipping_required', array(
						'type'=>'checkbox', 
						'checked'=>'checked', 
						'value'=>1, 
						'class' => 'bt-space15',
						'label'=>'<strong>Shipping Address required.</strong> Not for services or digital products.'
					));
					
					$currency = $shop_setting['currency'];
					
					// hidden for currency setting
					echo $this->Form->input('Product.currency', array('type'=>'hidden', 'value'=>$currency));

					?>
					<div class="columns clear">
						<div class="col1-2">
					<?php
					echo $this->Form->input('Product.price', array(
						'value'=>'0.00', 
						'label' => __('<h4>Selling Price</h4>'), 
						'after' => __(' ' .  $currency), 
						'class' => 'bt-space15 size-80', 
					));
					?>
						</div>
						<div class="col1-2 lastcol">
					<?php
					echo $this->Form->input('Product.displayed_weight', array(
						'value'=>'0.0', 
						'label' => __('<h4>Weight</h4>'), 
						'after' => __(' ' . $unitForWeight), 
						'class' => 'bt-space15 size-80', 
					));
					?>
						</div>
					</div>
					<?php
					$codeLabelExample = __('Unique identifier of the product for easier organization');										
					$codeLabel = $this->Form->label('Product.code', __('<h4>SKU Code (Optional)</h4>' . $codeLabelExample));

					echo $codeLabel;
					echo $this->Form->input('Product.code', array(
						'class' => 'text bt-space15',
						'label' => ''
					));
					
					?>
				</div>
				<div class="col1-2 lastcol">
				</div>
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