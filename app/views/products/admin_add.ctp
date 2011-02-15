<?php
	
	echo $this->Html->script('http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js');
	
	// include uploadify specific js files
	echo $this->Html->script('/uploadify/js/jquery.uploadify.v2.1.0.min');
	echo $this->Html->script('/uploadify/js/swfobject');
	
	echo $this->element('jquery_uploadify_js', array('plugin' => 'uploadify','buttonText'  => 'Choose File'));
?>

<div class="products form products_index">
  <h2><?php __('Add your New Product');?></h2>
<?php echo $this->Html->link(__('Cancel', true), array('controller' => 'products', 'action' => 'index')); ?>
  

<?php
	echo $this->element('errors', array('errors' => $errors));
	echo $this->Form->create('Product' , array('type'=>'file'));
?>
	<fieldset>
 		<legend><?php __('New Product');?></legend>
	<?php
	
	
		$this->TinyMce->editor(array(
			'theme' => 'advanced',
			'mode' => 'textareas',
			'plugins' => ' table',
			'theme_advanced_buttons1' => 'bold,italic,underline,undo,redo,link,unlink,forecolor,styleselect,removeformat,cleanup,code,table,fontselect,fontsizeselect,code',
			'theme_advanced_buttons2' => '',
			'theme_advanced_buttons3_add_before' => "tablecontrols,separator",
      'theme_advanced_toolbar_location' => 'top',
      'theme_advanced_toolbar_align' => 'left',
      'theme_advanced_path_location' => 'bottom', 
			'remove_linebreaks' => false,
			'extended_valid_elements' => 'textarea[cols|rows|disabled|name|readonly|class]'));
	
		echo $this->Form->input('shop_id', array('type'=>'hidden', 'value'=> User::get('Merchant.shop_id')));
		echo $this->Form->error('Product.title');
		echo $this->Form->input('title', array('error' => false, 'style' => 'width:360px;', 'label'=>'Title', 'between'=>'Examples: 14@ LCD Screen, Maroon Brand X T-shirt <br />'));
		echo $this->Form->input('description',array('label'=>'<b>Describe this product</b>'));
		?>
		</fieldset>
		<fieldset style="width:44%;float:left;">
 		<legend><?php __('Properties');?></legend>
 		<div style="margin-bottom:0px;font-size:120%;">
		  <b>SKU Code (optional)</b>
		</div>  
    <?
		echo $this->Form->input('code', array('label'=>'Unique identifier for easier organisation'));
		$options=array('1'=>'Published','0'=>'Hidden');
		$attributes=array('value' => '1');
		?><div style="width:300px;"><?
		echo $this->Form->radio('Visible in Store',$options, $attributes);
		?></div><?
		echo $this->Form->input('shipping_required', array('type'=>'checkbox', 'checked'=>'checked', 'value'=>1, 'label'=>'Shipping Address required'));
		echo $this->Form->input('Product.alt_id', array('type'=>'hidden', 'id'=>'alt_id', 'value'=>0));
		//echo $this->Form->input('price', array('value'=>'0.00', 'label'=>'Selling Price'));
		//echo "SGD";
		//echo $this->Form->input('weight', array('value'=>'0.0', 'label'=>'Weight'));
		//echo "kg";
	?>
	    <div class="input text clear_none" style="width:170px;float:left;">
        <label for="ProductPrice"><b>Selling Price</b></label>
        <input style="width:100px;" name="data[Product][price]" type="text" value="0.00" maxlength="15" id="ProductPrice" /> SGD
      </div>
      <div class="input text clear_none" style="width:170px;float:left;">
        <label for="ProductWeight"><b>Weight</b></label>
        <input style="width:100px;" name="data[Product][weight]" type="text" value="0.0" maxlength="15" id="ProductWeight" /> kg
      </div>
		</fieldset>
	  
		
		<fieldset style="width:44%;float:right;">
 		<legend><?php __('Product Images');?></legend>

	<input type="file" name="uploadify" id="fileInput" />

	</fieldset>
<?php
	$options = array(

		'url' => array('controller'=>'products',
			       'action' => 'add',
			       'admin' => true,
			       ),
		'style' => "width:180px;float:left;",
		'condition' => "ajaxConditionFunction()",
		'complete' => "ajaxCompleteFunction(request.responseText)");
   
?>
  
<div class="product_submit"> <?
	echo $this->Ajax->submit('Create Product', $options);
	?> <div class="cancel">&nbsp;or&nbsp;<?
  echo $this->Html->link(__('Cancel', true), array('controller' => 'products', 'action' => 'index'));
  ?></div></div><?	

	echo $this->Form->end();
?>

</div>

<script type="text/javascript" language="javascript">
	
	var newAltId = 0;

	function handlesUploadifyAllComplete(event, data) {
		$('#alt_id').attr('value', newAltId);
		
		document.forms["ProductAdminAddForm"].submit();
	}

	
	function ajaxCompleteFunction(response) {
		
		var json_object = $.parseJSON(response);
		
		if (json_object.success) {
			
			var contents = $.parseJSON(json_object.contents);
			
			var script = '<?php echo $uploadifySettings['script']; ?>';
			$('#fileInput').uploadifySettings('script', script + '/' + contents.id + '<?php echo "?sess=".$this->Session->id();?>');
			newAltId = contents.id;
			
			
			
			$('#fileInput').uploadifyUpload();
			
			
		} else {
			var contents = $.parseJSON(json_object.contents);
			var errors = contents.reason;
			
			if (errors['title'].length > 0 ) {
				
				if ($('#title-error-msg').length == 0) {
					$('#ProductTitle').before('<div id="title-error-msg" class="error-message">' + errors['title'] + '</div>');	
				} else {
					$('#title-error-msg').text(errors['title']);
				}
				
				
			} 
			
		}
		
	}
	
	
	function ajaxConditionFunction() {
		
		queueSize = $('#fileInput').uploadifySettings('queueSize');
		if (queueSize == 0) {
			document.forms["ProductAdminAddForm"].submit();
			return false;
		} else {
			return true;
		}
		
	}


</script>
