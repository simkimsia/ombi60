<?php
	
	echo $this->Html->script('http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js');
	
	// include uploadify specific js files
	echo $this->Html->script('/uploadify/js/jquery.uploadify.v2.1.0.min');
	echo $this->Html->script('/uploadify/js/swfobject');
	
	echo $this->element('jquery_uploadify_js', array('plugin' => 'uploadify'));
?>

<div>
<h2 align="center"><?php __('Add your New Product');?></h2>
<div align="center"><?php echo $this->Html->link(__('Cancel', true), array('action' => 'index', 'admin' => true)); ?></div>
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
			'theme_advanced_buttons1' => 'bold,italic,underline,undo,redo,link,unlink,forecolor,styleselect,removeformat,cleanup,code,table,fontselect,fontsizeselect',
			'theme_advanced_buttons2' => '',
			'theme_advanced_toolbar_location' => 'top',
			'remove_linebreaks' => false,
			'extended_valid_elements' => 'textarea[cols|rows|disabled|name|readonly|class]'));
	
		echo $this->Form->input('shop_id', array('type'=>'hidden', 'value'=> User::get('Merchant.shop_id')));
		echo $this->Form->error('Product.title');
		$titleLabel = $this->Form->label('title');
		$titleHint = __('Examples: 14" LCD Screen, Maroon Brand X T-shirt', true);
		echo $this->Form->input('title', array('error' => false, 'label' => false, 'before' => $titleLabel . '<span class="hint">' . $titleHint . '</span>'));
		echo $this->Form->input('description', array('label' => __('Describe your product', true)));
		echo $this->Form->input('Product.alt_id', array('type'=>'hidden', 'id'=>'alt_id', 'value'=>0));
	?>

	</fieldset>
	<fieldset class="left">
	<legend><?php __('Properties'); ?></legend>
	<?php
			$codeLabel = $this->Form->label('code', __('SKU Code <span class="small">(Optional)</span>', true)) . __(' ', true);
  		$codeHint = __('Unique identifier of the product for easier organization', true);
			echo $this->Form->input('code', array('before' => $codeLabel. '<span class="hint">' . $codeHint . '</span>', 'label' => false));
			$options=array('1'=> __('Published', true),'0'=> __('Hidden', true));
  		$attributes=array('value' => '1', 'legend' => __('Visible in store', true));
	  	echo $this->Form->radio('status',$options, $attributes);
			echo $this->Form->input('shipping_required', array('type'=>'checkbox', 'checked'=>'checked', 'value'=>1, 'label'=>'Shipping Address required'));
		  echo $this->Form->input('price', array('value'=>'0.00', 'label' => __('Selling Price', true), 'div' => array('class' => 'input text left'), 'after' => __(' SGD', true), 'class' => 'noclear'));
		  echo $this->Form->input('weight', array('value'=>'0.0', 'div' => array('class' => 'input text right'), 'class' => 'noclear', 'after' => __(' Kg', true)));
	?>
	</fieldset>
	<fieldset class="right">
	<legend><?php __('Product Images'); ?></legend>
	<br />
	<input type="file" name="uploadify" id="fileInput" />
	</fieldset>
<?php
	$options = array(

		'url' => array('controller'=>'products',
			       'action' => 'add',
			       'admin' => true,
			       ),
		'condition' => "ajaxConditionFunction()",
		'complete' => "ajaxCompleteFunction(request.responseText)", 'div' => false);
   
  echo '<div class="submit">';
	echo $this->Ajax->submit(__('Create Product', true), $options);
  echo ' or ' . $this->Html->link(__('Cancel', true), array('action' => 'index', 'admin' => true)); 
  echo '</div>';
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
