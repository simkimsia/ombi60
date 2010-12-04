<?php
	
	foreach ($savedThemes as $key=>$savedTheme):
		
		$id = $savedTheme['SavedTheme']['id'];
?>
	
		<li id="theme-<?php echo $id; ?>">
			<div class="theme-preview">
			<?php echo $this->Html->image('../theme/' .$savedTheme['SavedTheme']['folder_name'] . '/img/preview.jpg'); ?>&nbsp;
			</div>
			<?php
			$trashPic = $this->Html->image('trash.gif');
			
			echo $this->Ajax->link($trashPic,
						     array('controller' => 'saved_themes', 'action' => 'delete', 'admin' => true, $id),
						     array('complete' => "afterDelete(request.responseText);",
							   'escape' => false,
							   'indicator' => 'busy-indicator',
							   'confirm' => sprintf(__('Are you sure you want to delete %s?', true), $savedTheme['SavedTheme']['name'])));
			
			echo $this->Html->link($this->Html->image('edit-theme.gif'),
						array('controller' => 'saved_themes', 'action' => 'edit', 'admin' => true, $id),
						array('escape' => false));
			
			if ($savedTheme['SavedTheme']['featured']) {
				echo $this->Html->image('tick.gif');
				
			} else {
				echo $this->Html->link($this->Html->image('x_solid_red_25.gif'),
						array('controller' => 'saved_themes', 'action' => 'feature', 'admin' => true, $id),
						array('escape' => false));	
			}
			
			?>&nbsp;
							   
							   
		</li>
	
<?php endforeach; ?>
	