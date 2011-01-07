<?php

	function convertBlogOptions($blogs) {
		$array = array();
		foreach($blogs as $blog) {
			$array[$blog['Blog']['short_name']] = $blog['Blog']['short_name'];
		}
		return $array;
	}
	
	function convertProductOptions($products) {
		$array = array();
		foreach($products as $product) {
			$array[$product['Product']['id']] = $product['Product']['title'];
		}
		return $array;
	}
	
	function convertPageOptions($pages) {
		$array = array();
		foreach($pages as $page) {
			$array[$page['Webpage']['handle']] = $page['Webpage']['title'];
		}
		return $array;
	}
	
	
?>
<div class="links index">
	<h2><?php __('Links');?></h2>
	
	<?php
	foreach ($lists as $list):
	
	
	$listName = $list['LinkList']['name'];
	$listId = $list['LinkList']['id'];
	$linkCount = $list['LinkList']['link_count'];
	
	
	
	?>
	
	<table cellpadding="0" cellspacing="0">
	
	
		
	<tr>
		<?php
		echo '
		<table id="display-list-'.$listId.'">';
		
		
		echo '
			<tr >
				<td>
					'.$listName.'
				</td>
				<td>
					<a href="#" onclick="editListForm('.$listId.');return false;">Edit link list</a>
				</td>
			</tr>';
		?>
		
		<tr>	
			<th><?php echo 'Name';?></th>
			<th><?php echo 'Route';?></th>
			
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
			
			
		</tr>
		<?php endforeach; ?>
		<?php
		
			echo '<tr id="new-link-'. $listId .'"><td><a href="#" onclick="showLinkForm('.$listId.');return false;">Add Link</a>&nbsp;</td></tr>';
			echo $this->element('add_link_form', array('linkListId'=>$listId, 'linkCount' => $linkCount));
		?>
		</table>
	
		<?php
		echo '<table id="edit-list-'.$listId.'" style="display:none">';
		?>
		<tr>
			<?php echo "<td>$listName</td>"; ?>
		</tr>
		<?php
		echo $this->Form->create('Link', array('url'=>array('action'=>'edit',$listId)));
		echo $this->Form->input('LinkList.id', array('type'=>'hidden', 'value'=>$listId));
		echo '
		<tr>	
			<td>';
		
		echo $this->Form->input('LinkList.name', array('value'=>$listName));
		
				
		echo '
			</td>
		</tr>';
		
		echo '
		<tr>
			<th>Name Of Link</th>
			<th>Links to</th>
			<th></th>
		</tr>
		';
		
		
		foreach ($list['Link'] as $link):
			$i = $link['order'];
			
		?>
		<tr>
			
			<td>
				<?php echo $this->Form->input('Link.'.$i.'.name', array('value'=>$link['name'])); ?>&nbsp;
				<?php echo $this->Form->input('Link.'.$i.'.id', array('type'=>'hidden',
										      'value'=>$link['id'])); ?>
			</td>
			<?php
				$modelOptions = array('/blogs/'=>'Blog',
						      '/products/view/'=>'Product',
						      '/pages/'=>'Page',);
			
			?>
			<td>
				<?php echo $this->Form->input('Link.'.$i.'.model', array('type'=>'select',
										'options' => $modelOptions,
										'selected' => $link['model'],
										'div'=>false,
										'label'=>false,
										'style'=>'width:100%;',
										'onchange'=>'resetLinkAction(\''.$i.'\', \''.$link['model'].'\', \''.$link['action'].'\')'));
				
				$options = array();
				if (strpos($link['model'], 'blog') !== false) {
					$options = convertBlogOptions($blogs);
				} else if (strpos($link['model'], 'product') !== false) {
					$options = convertProductOptions($products);
				} else if (strpos($link['model'], 'page') !== false) {
					$options = convertPageOptions($pages);
				}
				
				
				
				echo $this->Form->input('Link.'.$i.'.action', array('type'=>'select',
									    'options' => $options,
									    'selected' => $link['action'],
									    'div'=>false,
									    'label'=>false,
									    'style'=>'width:100%;'));
				
				?>
			&nbsp;
			</td>
			
			<td class="actions">
				<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $link['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $link['id'])); ?>
			</td>
		</tr>
		<?php endforeach;
		
		echo '
		<tr id="new-edit-link-'. $listId .'">
			<td>';
		echo $this->Form->submit('Save changes');
		echo '&nbsp;or&nbsp;';
		echo '<a href="#" onclick="cancelEditListForm('.$listId.')">Cancel</a>';
		echo '
			</td>
		</tr>';
		echo $this->Form->end();
		?>
		</table>
	</tr>
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
		var editLinkRow = '#new-edit-link-'+id;
		var json_object = $.parseJSON(response);
		
		if (json_object.success) {
			var newLinkArray = json_object.contents.split('&copy;');
			$(addRateRow).before(newLinkArray[0]);
			$(editLinkRow).before(newLinkArray[1]);
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
	
	function editListForm(id) {
		var displayListTable = '#display-list-' + id;
		var editListForm = '#edit-list-' + id;
		
		$(displayListTable).hide();
		$(editListForm).show();
	}
	
	function cancelEditListForm(id) {
		var displayListTable = '#display-list-' + id;
		var editListForm = '#edit-list-' + id;
		
		$(displayListTable).show();
		$(editListForm).hide();
	}
	
	$(document).ready(function (){
		resetLinkAction();
		$('#LinkModel').change(function(){
			resetLinkAction();
		});
	});
	
	function resetLinkAction(linkId, presetModelValue, presetActionValue) {
		
		linkId            = typeof(linkId) != 'undefined' ? linkId : '';
		presetActionValue = typeof(presetActionValue) != 'undefined' ? presetActionValue : '';
		presetModelValue  = typeof(presetModelValue) != 'undefined' ? presetModelValue : '';
  
  
		var thisLinkModel  = "#Link" + linkId + "Model";
		var thisLinkAction = "#Link" + linkId + "Action";
		
		var selectedText = $(thisLinkModel + " option:selected").text();
		var actionsArray = new Object();
		
		if (selectedText == 'Blog') {
			actionsArray = blogs;
		} else if (selectedText == 'Product') {
			actionsArray = products;
		} else if (selectedText == 'Page') {
			actionsArray = pages;
		}
		
		var selectedValue = $(thisLinkModel).val();
		
		$innerHtml = '';
		for(keyArray in actionsArray) {
			var selected = '';
			
			if ((selectedValue == presetModelValue) && (keyArray == presetActionValue)) {
				selected = 'selected';
			}
			$innerHtml += '<option value="' + keyArray + '" '+selected+'>' + actionsArray[keyArray] + '</option>';	
		}
		$(thisLinkAction).html($innerHtml);
	}
	
	
	
	
</script>
