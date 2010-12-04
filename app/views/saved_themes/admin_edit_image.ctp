<div class="savedThemes ">
<?php echo $this->Form->create('SavedTheme', array('url'=>
						   array('controller'=>'saved_themes',
							'action' => 'edit_image',
							'admin' => true,
							'id' => $id,
							'folder_name' => $folder_name,
							'image' => $image)
						   ));?>
	<fieldset>
 		<legend><?php echo $image; ?></legend>
	<?php
		
		
		echo $this->Html->link(__('Delete', true), array('action' => 'delete_image',
								 'folder_name' => $folder_name,
								 'image' => $image,
								 'id' => $id), null, sprintf(__('Are you sure you want to delete %s?', true), $image));

		echo '<a href="#" id="renameImage">Rename</a>';
				
		
		
	?>
		
		
		
	</fieldset>
	<fieldset id="renameImageFS">
	<?php
		echo $this->Form->input('Image.name', array('value'=>$image));
		
		echo $this->Form->submit('Submit');
		
		echo ' or <a href="#" id="cancelRename">Cancel</a>';
	?>
	</fieldset>
	<fieldset>
	<?php
		echo 'Filename:' . $image;
		
		echo $this->Html->image($imageUrl, array('id'=>'preview-image'));
	
	?>
	
	</fieldset>
	
	
<?php


echo $this->Form->end();?>
</div>
<script type="text/javascript">
$(document).ready(function() {
	$('#renameImageFS').hide();
	
	$('#renameImage').click(function () {
		
		$('#renameImageFS').toggle();
	});
	$('#cancelRename').click(function () {
		
		$('#renameImageFS').hide();
	});
});
</script>