<?php
	echo $this->Html->script('http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js');

?>

			
<div id = "SavedThemeAdminAddFormDiv" class="savedThemes form">
<?php echo $this->Form->create('SavedTheme');?>
	<fieldset>
 		<legend><?php __('Themes available'); ?></legend>
	<?php
		
	echo $this->Form->input('id', array('type'=>'hidden',
					    'value'=>$savedThemeId));
	echo $this->Form->input('theme_id', array('value'=>$theme_id));
	echo $this->Form->input('original_theme_id', array('type'=>'hidden',
							   'value'=>$theme_id));
	
	echo $this->Form->input('folder_name', array('type'=>'hidden'));
	
	echo '<div class="panes">';
	foreach($themes as $id=>$foldername) {
		echo '<div id="img_'.$id.'">';
		echo $this->Html->image('../theme/' . $foldername . '/img/preview.jpg');
		echo '</div>';
	}
	
	echo '</div>';			
	?>
		
		
	</fieldset>
	
	
<?php

echo $this->Form->end('Submit');?>
</div>

<script type="text/javascript">


	$(document).ready(function() {
		
		
		// first hide all the images in panes initially
		$('div.panes').children().hide();
		// display the initial value for theme
		$('#img_' + $('#SavedThemeThemeId').val()).show();
		
		$('#SavedThemeThemeId').change(function() { 
			var message_index;
		 
			message_index = $(this).val(); 
			$('div.panes').children().hide();
		 
			if (message_index > 0) 
			    $('#img_' + message_index).show();
		}); 
	  
	});
</script>