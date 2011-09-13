<?php
	echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js');
	echo $this->Html->script('jquery/jquery.tools-1.2.ui-full.min');
	
	// include uploadify specific js files
	echo $this->Html->script('/uploadify/js/jquery.uploadify.v2.1.0.min');
	echo $this->Html->script('/uploadify/js/swfobject');
	
	
?>

<fieldset>
	<legend>CSS</legend>
	<?php
	$link = Router::url(array('controller'=>'saved_themes',
					  'action'=>'edit_css',
					  'admin' => true,
					  
					  'folder_name' => $folder_name,
					  
					  'id' => $id,));
	echo '<a href="'.$link.'" rel="#overlay">style.css</a><br/>';
	?>
</fieldset>

<fieldset>
	<legend>Images</legend>
<?php
	echo '<div id="imagesDiv">';
	foreach($images as $key=>$value) {
		$link = Router::url(array('controller'=>'saved_themes',
					  'action'=>'edit_image',
					  'admin' => true,
					  
					  'folder_name' => $folder_name,
					  'image' => $value,
					  'id' => $id,));
		
		echo '<a href="'.$link.'" rel="#overlay">' . $value . '</a><br/>';
		
	}
	echo '</div>';
	
?>

	<a href="#" id="addImageLink">Add image</a>
	<div id="fileInputDiv">
		<input type="file" name="uploadify" id="fileInput" />
	</div>
</fieldset>

<fieldset>
	<legend>Details</legend>
	<div id = "SavedThemeAdminAddFormDiv" class="savedThemes form">
	<?php
	echo $this->Form->create('SavedTheme');
		
		echo $this->Form->error('SavedTheme.folder_name');
		echo $this->Form->input('name');
		echo $this->Form->input('original_name', array('type'=>'hidden', 'value'=>$this->request->data['SavedTheme']['name']));
		
		echo $this->Form->input('description');
		
		echo $this->Form->end('Update');
	?>
	</div>
</fieldset>



<!-- overlayed element -->
<div class="apple_overlay" id="overlay">

	<!-- the external content is loaded inside this tag -->
	<div class="contentWrap"></div>

</div>


<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Delete'), array('action' => 'delete', $this->Form->value('SavedTheme.id')), null, sprintf(__('Are you sure you want to delete # %s?'), $this->Form->value('SavedTheme.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Saved Themes'), array('action' => 'index'));?></li>
		
	</ul>
</div>

<!-- make all links with the 'rel' attribute open overlays -->
<script>

var imageUrl = '<?php echo Router::url(array('controller'=>'saved_themes',
					  'action'=>'edit_image',
					  'admin' => true,
					  
					  'folder_name' => $folder_name,
					  'image' => 'dummy.jpg',
					  'id' => $id,)); ?>';

function handlesUploadifyComplete(event, queueID, fileObj, response, data) {
	
	var actualLink = imageUrl.replace("dummy.jpg", fileObj.name);
	$('#imagesDiv').append('<a class="newImages" href="' + actualLink + '" rel="#overlay">' + fileObj.name + '</a><span class="italic">new image</span><br/>');

	
	return true;
}

function handlesUploadifyAllComplete (event, data) {
	
	// newImages endowed with overlay effect
	$("a.newImages").overlay({

		mask: 'darkred',
		effect: 'apple',

		onBeforeLoad: function() {

			// grab wrapper element inside content
			var wrap = this.getOverlay().find(".contentWrap");

			// load the page specified in the trigger
			wrap.load(this.getTrigger().attr("href"));
		}

	});
	
	
}

$(document).ready(function() {
	
	// initialize all current image links with overlay effect
	// if the function argument is given to overlay,
	// it is assumed to be the onBeforeLoad event listener
	$("a[rel]").overlay({

		mask: 'darkred',
		effect: 'apple',

		onBeforeLoad: function() {

			// grab wrapper element inside content
			var wrap = this.getOverlay().find(".contentWrap");

			// load the page specified in the trigger
			wrap.load(this.getTrigger().attr("href"));
		}

	});
	
	$('#fileInputDiv').hide();
	$('#addImageLink').click(function() {
		$('#addImageLink').hide();
		$('#fileInputDiv').show();
	});
});
</script>