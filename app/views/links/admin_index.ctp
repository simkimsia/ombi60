<div class="links index">
	<h2><?php __('Links');?></h2>
	
	<?php
	foreach ($lists as $list):
	
	echo $list['LinkList']['name'];
	
	?>
	
	<table cellpadding="0" cellspacing="0">
	<tr>
			
			<th><?php echo 'Name';?></th>
			<th><?php echo 'Route';?></th>
			
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($list['Link'] as $link):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		
		<td><?php echo $link['name']; ?>&nbsp;</td>
		<td><?php echo $this->Html->link($link['route'],
						 $link['route']); ?>&nbsp;</td>
		
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $link['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $link['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $link['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $link['id'])); ?>
		</td>
	</tr>
	<?php endforeach; ?>
	<?php
	
		echo '<tr id="new-link-'. $link['link_list_id'] .'"><td><a href="#" onclick="showLinkForm('.$link['link_list_id'].');return false;">Add Link</a>&nbsp;</td></tr>';
		echo $this->element('add_link_form', array('linkListId'=>$link['link_list_id']));
	?>
	</table>
<?php endforeach; ?>
	<p>

</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Link', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Link Lists', true), array('controller' => 'link_lists', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Link List', true), array('controller' => 'link_lists', 'action' => 'add')); ?> </li>
	</ul>
</div>

<?php
	# blog array;
	# "pass" php array to JS array:
	echo "<script>\n";
	echo "var blogs = new Object();\n";
	
	
	foreach($blogs as $key => $value) {
		$js_key = $value['Blog']['short_name'];
		echo "blogs['$js_key'] = '$js_key';\n";
	}
	
	echo "var products = new Object();\n";
	foreach($products as $key => $value) {
		$js_key = $value['Product']['id'];
		$js_value = $value['Product']['title'];
		echo "products['$js_key'] = '$js_value';\n";
	}
	
	echo "var pages = new Object();\n";
	foreach($pages as $key => $value) {
		$js_key = $value['Webpage']['handle'];
		$js_value = $value['Webpage']['title'];
		echo "pages['$js_key'] = '$js_value';\n";
	}
	# .....rest of JavaScript.....
	echo "</script>\n";
?>

<script>

	function afterAddLink(id, response) {
		var addRateRow = '#new-link-'+id;
		var json_object = $.parseJSON(response);
		
		if (json_object.success) {
			$(addRateRow).before(json_object.contents);
		} else {
			$.each($.parseJSON(json_object.contents), function(key, value) {
				$('#flashMessage').text(value);
			});
		}
	}
	
	
	function showLinkForm(id) {
		
		var linkForm = '#link-form-'+id;
		
		$(linkForm).show();
		
	}
	
	$(document).ready(function (){
		resetLinkAction();
		$('#LinkModel').change(function(){
			resetLinkAction();
		});
	});
	
	function resetLinkAction() {
			var selectedText = $("#LinkModel option:selected").text();
			var actionsArray = new Object();
			
			if (selectedText == 'Blog') {
				
				actionsArray = blogs;
				
			} else if (selectedText == 'Product') {
				actionsArray = products;
			} else if (selectedText == 'Page') {
				actionsArray = pages;
			}
			$innerHtml = '';
			for(keyArray in actionsArray) {
				
				$innerHtml += '<option value="' + keyArray + '">' + actionsArray[keyArray] + '</option>';	
			}
			$('#LinkAction').html($innerHtml);
	}
	
	
	
	
</script>
