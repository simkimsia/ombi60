<?php
		
		
	//Here we will include all the JQuery files required by multi file functionlity
	echo $this->Html->script('jquery/multiple_file/jquery.MultiFile.js');

	
	
?>
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
					),
					'type' => 'file',
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
					
					echo '<h4>Product Options</h4>';
					echo '<div class="class">How your customers choose variations of your product</div>';
					
					echo $this->Form->input('Product.options_on', array(
						'type'=>'checkbox', 
						'class' => 'bt-space15',
						'label'=>'Product has <strong>multiple options</strong> for its variants.'
					));
					
					?>
					<div id="options" style="display:none;">
						<?php
						
						
						echo $this->Form->input('Variant.0.VariantOption.0.field', array('label' => __('Option Field'),'value'=>'Title'));
						echo $this->Form->input('Variant.0.VariantOption.0.value', array('label' => __('Default Value'), 'value'=>'Default Title'));
						echo $this->Form->input('Variant.0.VariantOption.0.order', array('type'=>'hidden', 'value'=>'0'));
						?>
					</div>
					<h2>Collections</h2>
					<div class="rule2"></div>
					<?php 
					$label = $this->Form->label('Product.selected_collections', __('<h4>Choose the custom collections this product belongs to:</h4>'));
					
					echo $label;

					$counter = 1;
					foreach($collections as $key=>$value) {
						$class = 'col1-2';
						
						if ($counter % 2 == 0) {
							$class = 'col1-2 lastcol';
						}
						
						echo $this->Form->input('Product.selected_collections.' . $key, array(
							'type' => 'checkbox',
							'label' => $value,
							'value' => $key,
							'div' => array(
								'class' => $class
							),
							'hiddenField' => false
						));
						$counter ++;
					}

					?>
					
				</div>
				<div class="col1-2 lastcol">
					<h2>Product Images</h2>
					<div class="rule2"></div>
					<input type="file" class="multi max-4" name="product_images[]" accept="gif|jpg|jpeg|png|ico|bmp" />
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
<script type="text/javascript">

	$(document).ready(function() {
		// Your code here
		$('#ProductOptionsOn').click(function() {
			if ($(this).is(':checked')) {
				$('#options').show();
			} else {
				$('#options').hide();
			}
			
		});
		
	});
	
</script>