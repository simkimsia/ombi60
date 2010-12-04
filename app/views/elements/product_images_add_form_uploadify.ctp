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
 		<legend><?php __('Images');?></legend>
	<?php
		echo $this->Form->input('product_id', array('type'=>'hidden', 'value'=>$product_id));
		echo $this->Form->input('imagesCount', array('type'=>'hidden', 'value'=>count($productImages)));
	?>
		<input type="file" name="uploadify" id="fileInput" />
		
		
	<div class="products ">
	<a name="images"></a>
		<div class="">
		<ul id="product_images-list" class="product_image-thumbs">
		
		
		
		<?php
		
		echo $this->element('product_images_ajax_list');
		
		?>
		</ul>
		</div>
		
	</div>
		
	</fieldset>
<?php echo $this->Form->end('Submit');?>


	<div id="dummyTrashLinkDiv" style="display:none;">
		<?php
			$trashPic = $this->Html->image('trash.gif');
			// before changing this code, please double check against the bindNewClick js function below.
			// that will append in the ajax call for those dynamically generated images.
			echo $this->Ajax->link($trashPic,
						     array('controller' => 'product_images', 'action' => 'delete', 'id'=>0, 'product_id'=>$product_id),
						     array('id'=>'dummy',
							   'complete' => "afterDelete(request.responseText);",
							   'escape' => false,
							   'indicator' => 'busy-indicator',
							   'confirm' => sprintf(__('Are you sure you want to delete %s?', true), 'fakefilename')));
		?>
	</div>

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



</script>