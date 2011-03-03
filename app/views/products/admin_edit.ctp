<?php
	echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js');
	
	// include uploadify specific js files
	echo $this->Html->script('/uploadify/js/jquery.uploadify.v2.1.0.min');
	echo $this->Html->script('/uploadify/js/swfobject');
	
	echo $this->element('jquery_uploadify_js', array('plugin' => 'uploadify'));
?>

<div>
<div class="text_center"><h2><?php __($this->Form->value('Product.title'));?></h2>
    <?php echo $this->Html->link(__('Duplicate', true), array('action' => 'duplicate', $this->Form->value('Product.id'))); ?>|
    <?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Product.id')), null, sprintf(__('Are you sure you want to delete this product?', true))); ?>|
    <?php echo $this->Html->link(__('Cancel', true), array('action' => 'index', 'admin' => true));?>
</div>
<?php
	echo $this->element('errors', array('errors' => $errors));
	echo $this->Form->create('Product' , array('type'=>'file'));
	echo $this->Form->input('id');
	echo $this->Form->input('shop_id', array('type'=>'hidden', 'value'=> User::get('Merchant.shop_id')));
?>
	<fieldset>
 		<legend><?php __('Edit this Product');?></legend>
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
		echo $this->Form->input('title', array('error' => false, 'label' => false));
		echo $this->Form->input('description');
		echo $this->Form->input('Product.alt_id', array('type'=>'hidden', 'id'=>'alt_id', 'value'=>0));
	?>

	</fieldset>
	<fieldset class="left">
	<legend><?php __('Properties'); ?></legend>
	<?php
			$codeLabel = $this->Form->label('code', __('SKU Code', true)) . __(' ', true);
  		
			echo $this->Form->input('code', array('label' => false));
			$options=array('1'=> __('Published', true),'0'=> __('Hidden', true));
  		$attributes=array('value' => '1', 'legend' => __('Visible in store', true));
	  	echo $this->Form->radio('status',$options, $attributes);
			echo $this->Form->input('shipping_required', array('type'=>'checkbox', 'checked'=>'checked', 'value'=>1, 'label'=>'Shipping Address required'));
		  echo $this->Form->input('price', array('label' => __('Selling Price', true), 'div' => array('class' => 'input text left'), 'after' => __(' SGD', true), 'class' => 'noclear'));
		  echo $this->Form->input('weight', array('div' => array('class' => 'input text right'), 'class' => 'noclear', 'after' => __(' Kg', true)));
	?>
	</fieldset>
	<?php echo $this->element('product_images_add_form_uploadify'); ?>
	<!--<fieldset class="right">
	<legend><?php __('Product Images'); ?></legend>
	<br />
	<input type="file" name="uploadify" id="fileInput" />
	</fieldset>-->
<?php
	$options = array(

		'url' => array('controller'=>'products',
			       'action' => 'edit',
			       'admin' => true,
			       ),
		'condition' => "ajaxConditionFunction()",
		'complete' => "ajaxCompleteFunction(request.responseText)", 'div' => false);
   
  echo '<div class="submit">';
	echo $this->Ajax->submit(__('Update', true), $options);
  echo ' or ' . $this->Html->link(__('Cancel', true), array('action' => 'index', 'admin' => true)); 
  echo '</div>';
	echo $this->Form->end();
?>

</div>


<script type="text/javascript" language="javascript">

	var product_id = '<?php echo $product_id; ?>';
	
	
	function afterDelete(response) {
		var json_object = $.parseJSON(response);
	
		if (json_object.success) {
			var contents = $.parseJSON(json_object.contents);
			var id = '#product_image-' + contents.id;
			
			$(id).remove();
			
		} else {
			var contents = $.parseJSON(json_object.contents);
			var errors = contents.reason;
			
			alert(errors);
		}	
	}

	function makeThumbnail(filename) {
		var thumb = '<?php echo $this->Html->image("../uploads/products/thumb/small/dummy.jpg"); ?>&nbsp;';
		return thumb.replace('dummy.jpg',filename);
	}
	
	function makeActionLinks(id, filename, cover) {
		
		var deleteLink = $('div#dummyTrashLinkDiv').html();
		deleteLink = deleteLink.replace('fakefilename', filename);
		deleteLink = deleteLink.replace('dummy', id+'_elt');
		deleteLink = deleteLink.replace('0-' + product_id,  id + '-' + product_id);
		
		var featureLink = '';
		if (cover == 0) {
			featureLink = '<?php echo $this->Html->link($this->Html->image('x_solid_red_25.gif'),
						array('controller' => 'product_images', 'action' => 'make_this_cover', 'admin' => true, 'id' => 0, 'product_id' => $product_id),
						array('escape' => false));
					?>';
			featureLink = featureLink.replace('0/cover', id +'/cover');
		} else {
			featureLink = '<?php echo $this->Html->image('tick.gif'); ?>';
		}	
		
		
		return deleteLink + featureLink;
		
	}
	
	function bindNewCallback(id, filename) {
	
		
		postUrl = "<?php echo Router::url(array('controller' => 'product_images', 'action' => 'delete', 'id'=>0, 'product_id'=>$product_id)); ?>";
		postUrl = postUrl.replace('0-' + product_id,  id + '-' + product_id);
		
		id = '#' + id+'_elt';

		$(id).bind('click', function() {
			if (confirm('Are you sure you want to delete '+filename+'?')) {
				$.ajax({
				    async: true,
				    type: 'post',
				    beforeSend: function(request) {
					$('#busy-indicator').show();
				    },
				    complete: function(request, json) {
					afterDelete(request.responseText);
					$('#busy-indicator').hide()
				    },
				    url: postUrl
				});
			} else {
				return false;
			}
		});

	}
	
	function handlesUploadifyComplete(event, queueID, fileObj, response, data) {
	
	
		var json_object = $.parseJSON(response);
		
		var imageID = 0;
		var imageName = '';
		var cover = 0;
		
		if (json_object.success) {
			var contents = $.parseJSON(json_object.contents);
			imageID = contents.id;
			imageName = contents.filename;
			cover = contents.cover;
		} else {
			return false;
		}
	
	
		imageItem = '<li id="product_image-' + imageID + '"><div class="product_image-preview">';
		imageItem += makeThumbnail(imageName) + '</div>';
		imageItem += makeActionLinks(imageID, imageName, cover);
		imageItem += '</li>';
		
		
		$('#product_images-list').append(imageItem);
	
		bindNewCallback(imageID, imageName);
		
		return true;
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
			document.forms["ProductAdminEditForm"].submit();
			return false;
		} else {
			return true;
		}
		
	}

</script>
