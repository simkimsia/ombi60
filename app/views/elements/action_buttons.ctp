<?php 
echo $this->Html->script('simpleweb/jquery.multirowcheckboxmenu', array('inline' => FALSE));

echo $this->Html->css('multirow-checkbox-menu');
?>

	<script type="text/javascript"> 
		
		$(document).ready(function() {
			
			$('div.menuSelectAll').checkboxMenu({
				menuItemClick: function(text, count) { 
					if (text == 'All') {
						$('table#webpages-table input[type=checkbox]').attr('checked','checked');
					}
					if (text == 'None') {
						$('table#webpages-table input[type=checkbox]').removeAttr('checked');
					}
					if (text == 'Published') {
						$('table#webpages-table input[type=checkbox].hidden').removeAttr('checked');
						$('table#webpages-table input[type=checkbox]:not(.hidden)').attr('checked', 'checked');
					}
					if (text == 'Hidden') {
						$('table#webpages-table input[type=checkbox]:not(.hidden)').removeAttr('checked');
						$('table#webpages-table input[type=checkbox].hidden').attr('checked', 'checked');
					}
				}});
 
 
                        $('div.deleteButton').click(
				function() {
					return confirm('Delete selected webpages?');
				});
			
			$('div.menuMoreActions').checkboxMenu({
				menuItemClick: function(text, count) { 
					if (text == 'Publish') {
						
						
					}
					if (text == 'Hide') {
						
					}
					
				}});
			
		});
	</script>

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

<?php echo $this->element('pagination', array('modelName' => $modelName));?>