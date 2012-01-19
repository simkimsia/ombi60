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
					if (text == 'Open Orders') {
						$('table'+tableId+' input[type=checkbox]:not(.open)').removeAttr('checked');
						$('table'+tableId+' input[type=checkbox].open').attr('checked', 'checked');
					}
					if (text == 'Closed Orders') {
						$('table'+tableId+' input[type=checkbox]:not(.closed)').removeAttr('checked');
						$('table'+tableId+' input[type=checkbox].closed').attr('checked', 'checked');
					}
				}});
 
 
			
			$('div.menuMoreActions').checkboxMenu({
				menuItemClick: function(text, count) {
					
					var openAction = text.match(/open/i);
					var closeAction = text.match(/close/i);
					
					if (openAction) {
						$(menuActionId).attr('value', 'Open');
					}
					
					if (closeAction) {
						$(menuActionId).attr('value', 'Close');
					}
					$(this).closest("form").submit();
					
				}});
			
		});
	</script>

	<?php echo $this->Form->create($modelName, array('action'=>'menu_action', 'class'=>'menuActions')); ?>
    
		<div class="menuSelectAll multiRowCheckboxMenu"> 
			<input id="selectAction" class="actionItem" type="submit" name="action" value="All" /> 
			<input id="deselectAction" class="actionItem" type="submit" name="action" value="None" />
			<input id="selectOpenAction" class="actionItem" type="submit" name="action" value="Open Orders" />
			<input id="selectClosedAction" class="actionItem" type="submit" name="action" value="Closed Orders" /> 
		</div>
		
		<div class="menuMoreActions multiRowCheckboxMenu actionMenu"> 
			<input class="selected" type="submit" name="action" value="More" /> 
			<input id="closeOrderAction" class="actionItem" type="submit" name="action" value="Close Orders" />
			<input id="openOrderAction" class="actionItem" type="submit" name="action" value="Open Orders" />
		</div>
		
		<?php echo $this->Form->input('menu_action', array('type'=>'hidden')); ?>

<?php //echo $this->element('pagination', array('modelName' => $modelName));?>