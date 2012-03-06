<?php

$pluralName = Inflector::pluralize(strtolower($modelName));
$tableId = $pluralName.'Table';
$menuActionId = $modelName.'MenuAction';

echo $this->Html->script('simpleweb/jquery.multirowcheckboxmenu', array('inline' => FALSE));

echo $this->Html->css('multirow-checkbox-menu');

?>

	<script type="text/javascript">
	
		var tableId = '#<?php echo $tableId; ?>';
		var menuActionId = '#<?php echo $menuActionId; ?>';
		var pluralName = '<?php echo $pluralName; ?>';
		
		$(document).ready(function() {
			
			$('div.menuSelectAll').checkboxMenu({
				menuItemClick: function(text, count) { 
					if (text == 'All') {
						$('table'+tableId+' input[type=checkbox]').attr('checked','checked');
					}
					if (text == 'None') {
						$('table'+tableId+' input[type=checkbox]').removeAttr('checked');
					}
					if (text == 'Published') {
						$('table'+tableId+' input[type=checkbox].hidden').removeAttr('checked');
						$('table'+tableId+' input[type=checkbox]:not(.hidden)').attr('checked', 'checked');
					}
					if (text == 'Hidden') {
						$('table'+tableId+' input[type=checkbox]:not(.hidden)').removeAttr('checked');
						$('table'+tableId+' input[type=checkbox].hidden').attr('checked', 'checked');
					}
				}});
 
 
             $('div.deleteButton').click(
				function() {
					if (confirm('Delete selected '+pluralName+'?')) {
						$(menuActionId).attr('value', 'Delete');
						$(this).closest("form").submit();
					}
				});
			
			$('div.menuMoreActions').checkboxMenu({
				menuItemClick: function(text, count) {
					
					var publishAction = text.match(/published/i);
					var hideAction = text.match(/hidden/i);
					
					if (publishAction) {
						$(menuActionId).attr('value', 'Publish');
					}
					
					if (hideAction) {
						$(menuActionId).attr('value', 'Hide');
					}
					$(this).closest("form").submit();
					
				}});
			
		});
	</script>

	<?php echo $this->Form->create($modelName, array('action'=>'menu_action', 'class'=>'menuActions')); ?>
    
		<div class="menuSelectAll multiRowCheckboxMenu"> 
			<input id="selectAction" class="actionItem" type="submit" name="action" value="All" /> 
			<input id="deselectAction" class="actionItem" type="submit" name="action" value="None" />
			<input id="selectVisibleAction" class="actionItem" type="submit" name="action" value="Published" />
			<input id="selectHiddenAction" class="actionItem" type="submit" name="action" value="Hidden" /> 
		</div>
		
		<div class="deleteButton">Delete</div>
		
		<div class="menuMoreActions multiRowCheckboxMenu actionMenu"> 
			<input class="selected" type="submit" name="action" value="More" /> 
			<input id="publishAction" class="actionItem" type="submit" name="action" value="Mark as Published" />
			<input id="hideAction" class="actionItem" type="submit" name="action" value="Mark as Hidden" />
		</div>
		
		<?php echo $this->Form->input('menu_action', array('type'=>'hidden')); ?>

<?php //echo $this->element('pagination', array('modelName' => $modelName));?>