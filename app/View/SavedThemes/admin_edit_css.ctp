<div class="savedThemes ">
<?php echo $this->Form->create('SavedTheme', array('url'=>
						   array('controller'=>'saved_themes',
							'action' => 'edit_css',
							'admin' => true,
							'id' => $id,
							'folder_name' => $folder_name,
							)
						   ));?>
	<fieldset>
 		<legend><?php echo 'style.css'; ?></legend>
	<?php
		
		
		echo $this->Form->input('Css.contents', array('type'=>'textarea', 'value'=>$contents));

		echo $this->Form->submit('Submit');
				
		
		
	?>
			
	</fieldset>
	
	
	
<?php


echo $this->Form->end();?>
</div>
<script type="text/javascript">
$(document).ready(function() {
	
});
</script>