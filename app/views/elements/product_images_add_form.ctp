<div class="products form">

<?php
	echo $this->element('errors', array('errors' => $errors));
	echo $this->Form->create('ProductImage' , array('id' => 'ProductImageAdminAddByProductForm',
							'type'=>'file',
                                                        'url' => array('controller' => 'product_images',
                                                                        'action' => 'add_by_product',
                                                                        'product_id' => $product_id,
                                                                       ),
                                                        ));
?>
	<fieldset>
 		<legend><?php __('Add Product');?></legend>
	<?php

		echo $this->Form->input('ProductImage.0.filename', array('type' => 'file', 'class'=>'multi'));
		echo $this->Form->input('imagesCount', array('type'=>'hidden', 'value'=>count($productImages)));

	?>

	</fieldset>
<?php echo $this->Form->end('Submit');?>

</div>

<script type="text/javascript" language="javascript">


	function adjustImageArrayIndex(form) {
		var count = 0;

		form.find(':input').each(function() {
			if ($(this).attr('name') == 'data[ProductImage][0][filename]') {
				$(this).attr('name', 'data[ProductImage][' + count + '][filename]');
				count ++;
			}
		});

		return false;
	}

	$(document).ready(function() {

		$('#ProductImageAdminAddByProductForm').submit(function(){
			adjustImageArrayIndex($(this));
		});
	});



</script>