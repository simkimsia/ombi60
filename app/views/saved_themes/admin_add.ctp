<?php
	
	// include uploadify specific js files
	echo $this->Html->script('/uploadify/js/jquery.uploadify.v2.1.0.min');
	echo $this->Html->script('/uploadify/js/swfobject');
	
	echo $this->element('jquery_uploadify_js', array('plugin' => 'uploadify'));
?>

			
<div id = "SavedThemeAdminAddFormDiv" class="savedThemes form">
<?php echo $this->Form->create('SavedTheme', array('type' => 'file'));?>
	<fieldset>
 		<legend><?php __('Admin Add Saved Theme'); ?></legend>
	<?php
		
		echo 'Upload your css ';
		echo $this->Html->image('minus.png', array('id'=>'submittedfilebtn',
							   /*'style'=>'float:left;'*/));
		echo '<div id="submittedfile">';
		echo $this->Form->error('SavedTheme.submittedfile');
		echo $this->Form->file('SavedTheme.submittedfile');
		echo '</div>';
		
		echo 'OR</br></br>';
		echo $this->Form->label('Write your own css');
		echo $this->Html->image('plus.png', array('id'=>'cssbtn'));
		echo '<div id="css">';
		echo $this->Form->textarea('SavedTheme.css',  array('rows' => '10', 'cols' => '10'));
		echo '</div>';
		echo $this->Form->error('SavedTheme.folder_name', NULL, array('id'=>'folder_name-error-msg'));
		
		echo $this->Form->input('SavedTheme.cssName', array('type'=>'hidden', 'id'=>'cssname', 'value'=>'submittedfile'));
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->Form->input('SavedTheme.alt_id', array('type'=>'hidden', 'id'=>'alt_id', 'value'=>0));
		
		
		
	?>
		
		<input type="file" name="uploadify" id="fileInput" />
		
	</fieldset>
	
	
<?php
$options = array(
 //'value' => 'Submit',
   //'id' => 'submitBtn',
   'url' => array('controller'=>'saved_themes',
		  'action' => 'add',
		  'admin' => true,
		  ),
   //'update'=>'SavedThemeAdminAddForm',
   'condition' => "ajaxConditionFunction()",
   'complete' => "ajaxCompleteFunction(request.responseText)");
   

echo $this->Ajax->submit('Submit', $options);

echo $this->Form->end();?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Saved Themes', true), array('action' => 'index'));?></li>
		
	</ul>
</div>
<script type="text/javascript">

var newAltId = 0;

function handlesUploadifyAllComplete(event, data) {
	$('#alt_id').attr('value', newAltId);
	
	document.forms["SavedThemeAdminAddForm"].submit();
}


function ajaxCompleteFunction(response) {
	
	var json_object = $.parseJSON(response);
	
	if (json_object.success) {
		var contents = $.parseJSON(json_object.contents);
		
		$('#fileInput').uploadifySettings('folder', '/' + contents.folder_name);
		newAltId = contents.id;
		
		$('#fileInput').uploadifyUpload();
		
		
	} else {
		var contents = $.parseJSON(json_object.contents);
		var errors = contents.reason;
		
		if (errors['folder_name'].length > 0 ) {
			if ($('#folder_name-error-msg').length == 0) {
				$('#cssname').before('<div id="folder_name-error-msg" class="error-message">' + errors['folder_name'] + '</div>');	
			} else {
				$('#folder_name-error-msg').text(errors['folder_name']);
			}
			
		} 
		
	}
	
}


function ajaxConditionFunction() {
	
	queueSize = $('#fileInput').uploadifySettings('queueSize');
	if (queueSize == 0) {
		document.forms["SavedThemeAdminAddForm"].submit();
		return false;
	} else {
		return true;
	}
	
}

$(document).ready(function() {
	
	
	$('#submittedfile').show();
	$('#css').hide();
	
	
	$('#submittedfilebtn').click(function () {
		toggleDiv($(this), $('#submittedfile'));
		toggleDiv($('#cssbtn'), $('#css'));
		toggleCss();
	});
	$('#cssbtn').click(function () {
		toggleDiv($(this), $('#css'));
		toggleDiv($('#submittedfilebtn'), $('#submittedfile'));
		toggleCss();
	});
	
	function toggleCss() {

		if ($('#submittedfilebtn').attr('src').indexOf('minus') > -1) {
			$('#cssname').attr('value', 'submittedfile');
			
		} else if ($('#cssbtn').attr('src').indexOf('minus') > -1) {
			$('#cssname').attr('value', 'css');
		}
	}
  
	function toggleDiv(btn, div) {	
		div.toggle();
		newVisible = btn.attr('src').indexOf('minus');
		var newImage = '';
		if (newVisible > 1) {
			newImage = btn.attr('src').replace('minus', 'plus');
		} else {
			newImage = btn.attr('src').replace('plus', 'minus');		
		}
		btn.attr('src', newImage);
	}
  
});
</script>