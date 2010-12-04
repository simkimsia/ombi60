<?php
	
	echo $this->Html->script('http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js');
	
	// include uploadify specific js files
	echo $this->Html->script('/uploadify/js/jquery.uploadify.v2.1.0.min');
	echo $this->Html->script('/uploadify/js/swfobject');
	
	echo $this->element('jquery_uploadify_js', array('plugin' => 'uploadify'));
?>

<div class="products form">

<?php
	echo $this->element('errors', array('errors' => $errors));
	echo $this->Form->create('Product' , array('type'=>'file'));
?>
	<fieldset>
 		<legend><?php __('Add Product');?></legend>
	<?php
		echo $this->Form->input('shop_id', array('type'=>'hidden', 'value'=> User::get('Merchant.shop_id')));
		echo $this->Form->error('Product.title');
		echo $this->Form->input('title', array('error' => false));
		echo $this->Form->input('code');
		echo $this->Form->input('description');
		echo $this->Form->input('price', array('value'=>'0.00'));
		echo $this->Form->input('weight', array('value'=>'0.0'));
		echo $this->Form->input('shipping_required', array('type'=>'checkbox', 'checked'=>'checked', 'value'=>1, 'label'=>'Shipping Address required'));
		$options=array('1'=>'Enabled','0'=>'Disabled');
		$attributes=array('value' => '1');
		echo $this->Form->radio('status',$options, $attributes);
		echo $this->Form->input('Product.alt_id', array('type'=>'hidden', 'id'=>'alt_id', 'value'=>0));
	?>

	<input type="file" name="uploadify" id="fileInput" />

	</fieldset>
<?php
	$options = array(

		'url' => array('controller'=>'products',
			       'action' => 'add',
			       'admin' => true,
			       ),
		'condition' => "ajaxConditionFunction()",
		'complete' => "ajaxCompleteFunction(request.responseText)");
   

	echo $this->Ajax->submit('Submit', $options);

	echo $this->Form->end();
?>

</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Products', true)), array('action' => 'index'));?></li>
	</ul>
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
