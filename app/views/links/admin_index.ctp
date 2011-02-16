<?php

	echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.7/jquery-ui.min.js');
	
	function convertBlogOptions($blogs) {
		$array = array();
		foreach($blogs as $blog) {
			$array[$blog['Blog']['short_name']] = $blog['Blog']['short_name'];
		}
		return $array;
	}
	
	
	function convertEmptyOptions() {
		$array = array();
		$array[''] = '';
		
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
	
	<style type="text/css">
		.sortable { list-style-type: none; margin: 0; padding: 0; width: 100%; }
        	.sortable li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; font-size: 1.4em; height: 18px;}
        </style>
	
	<table cellpadding="0" cellspacing="0">
	
	
		
	<tr>
		<?php
		echo '
		<table id="display_list_'.$listId.'">';
		
		
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
		<tr>
			<td>
				<ul class="sortable" id="display_links_sortable_<?php echo $listId; ?>">
		<?php
		$i = 0;
		foreach ($list['Link'] as $link):
			
			
		?>
		<li class="ui-state-default" id="displayrow_<?php echo $link['id']; ?>">
			
			<span><?php echo $link['name']; ?>&nbsp;</span>
			<span><?php echo $this->Html->link($link['route'],
							   $link['route']); ?>
			</span>
			
		</li>
		<?php endforeach; ?>
					</ul>
					
				</td>
			</tr>
		<?php
			$displayLinksSortable = 'display_links_sortable_'.$listId;
			echo $this->Ajax->sortable($displayLinksSortable, array('update'=>"writeupdate('$displayLinksSortable')"));
			echo '<tr id="new_link_'. $listId .'"><td><a href="#" onclick="showLinkForm('.$listId.');return false;">Add Link</a>&nbsp;</td></tr>';
			echo $this->element('add_link_form', array('linkListId'=>$listId, 'linkCount' => $linkCount));
		?>
				
		</table>
	
		<?php
		echo $this->Form->create('Link', array('url'=>array('action'=>'edit',$listId)));
		echo $this->Form->input('LinkList.id', array('type'=>'hidden', 'value'=>$listId));
		echo '<table id="edit_list_'.$listId.'" style="display:none">';
		?>
		<tr>
			<?php echo "<td>$listName</td>"; ?>
		</tr>
		<?php
		
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
			$linkId = $link['id'];
			
		?>
		<tr id="edit_row_<?php echo $linkId; ?>">
			
			<td>
				<?php echo $this->Form->input('Link.'.$i.'.name', array('value'=>$link['name'])); ?>&nbsp;
				<?php echo $this->Form->input('Link.'.$i.'.id', array('type'=>'hidden',
										      'value'=>$linkId)); ?>
			</td>
			<?php
				$modelOptions = array('/blogs/'		=>'Blog',
						      '/cart/view'	=>'Cart',
						      '/products/'	=>'Catalogue',
						      '/products/view/' =>'Product',
						      '/pages/'		=>'Page',
						      '/'		=>'Shop Frontpage',
						      'web'		=>'Web Address',
						      );
			
			?>
			<td>
				<?php
				
				echo $this->Form->input('Link.'.$i.'.model',
					array('type'=>'select',
					      'options' => $modelOptions,
					      'selected' => $link['model'],
					      'div'=>false,
					      'label'=>false,
					      'style'=>'width:100%;',
					      'onchange'=>'resetLinkAction(\''.$i.'\', \''.$link['model'].'\', \''.$link['action'].'\')'));
				
				$options       = array();
				$actionNeeded  = true;
				$textBoxNeeded = false;
				
				if (strpos($link['model'], 'blog') !== false) {
					$options = convertBlogOptions($blogs);
				} else if (($link['model'] === '/products/') ||
					   ($link['model'] === '/') ||
					   ($link['model'] === '/cart/view') ) {
					$actionNeeded = false;
					$options      = convertEmptyOptions();
				} else if (strpos($link['model'], 'product') !== false) {
					$options = convertProductOptions($products);
				} else if (strpos($link['model'], 'page') !== false) {
					$options = convertPageOptions($pages);
				} else if ($link['model'] === 'web') {
					$actionNeeded  = false;
					$textBoxNeeded = true;
				}
				
				
				if ($actionNeeded) {
					$displayVisible = '';
					
				} else {
					$displayVisible = 'display:none;';
					
				}
				
				if ($textBoxNeeded) {
					$textBoxVisible = '';
				} else {
					$textBoxVisible = 'display:none;';
				}
				
				echo $this->Form->input('Link.'.$i.'.action', array(
						'type'=>'select',
						'options' => $options,
						'selected' => $link['action'],
						'div'=>false,
						'label'=>false,
						'style'=>'width:100%;'.$displayVisible));
				
				echo $this->Form->input('Link.'.$i.'.action1', array(
						'value' => $link['action'],
						'div'=>false,
						'label'=>false,
						'style'=>'width:100%;'.$textBoxVisible));
				
				
				?>
			&nbsp;
			</td>
			
			<td class="actions">
				<?php echo $this->Ajax->link(__('Delete', true),
							     array('action' => 'delete', $linkId),
							     array('confirm'=> sprintf(__('Are you sure you want to delete this link?', true)),
								   'complete' => "afterDeleteLink('$linkId', request.responseText);")
							     ); ?>
				
			</td>
		</tr>
		<?php endforeach;
		
		echo '
		<tr id="new_edit_link_'. $listId .'">
			<td>';
		echo $this->Form->submit('Save changes');
		echo '&nbsp;or&nbsp;';
		echo '<a href="#" onclick="cancelEditListForm('.$listId.')">Cancel</a>';
		echo '
			</td>
		</tr>';
		
		?>
		</table>
		<?php echo $this->Form->end(); ?>
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
		var displayLinkListUL = "#display_links_sortable_" + id;
		var editLinkRow = '#new_edit_link_'+id;
		var json_object = $.parseJSON(response);
		
		if (json_object.success) {
			var newLinkArray = json_object.contents.split('&copy;');
			$(displayLinkListUL).append(newLinkArray[0]);
			$(editLinkRow).before(newLinkArray[1]);
		} else {
			$.each($.parseJSON(json_object.contents), function(key, value) {
				$('#flashMessage').text(value);
			});
		}
	}
	
	function afterDeleteLink(id, response) {

		var displayLinkRow = '#displayrow_'+id;
		var editLinkRow = '#edit_row_'+id;
		var json_object = $.parseJSON(response);
		
		if (json_object.success) {
			$(displayLinkRow).remove();
			$(editLinkRow).remove();
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
		var displayListTable = '#display_list_' + id;
		var editListForm = '#edit_list_' + id;
		
		$(displayListTable).hide();
		$(editListForm).show();
	}
	
	function cancelEditListForm(id) {
		var displayListTable = '#display_list_' + id;
		var editListForm = '#edit_list_' + id;
		
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
		var thisLinkAction1 = "#Link" + linkId + "Action1";
		
		var selectedText = $(thisLinkModel + " option:selected").text();
		var actionsArray = new Object();
		
		var actionNeeded = true;
		var textBoxNeeded = false;
		
		if (selectedText == 'Blog') {
			actionsArray = blogs;
		} else if (selectedText == 'Product') {
			actionsArray = products;
		} else if (selectedText == 'Page') {
			actionsArray = pages;
		} else if ((selectedText == 'Shop Frontpage') ||
			   (selectedText == 'Cart') ||
			   (selectedText == 'Catalogue') ) {
			actionNeeded = false;
		} else if (selectedText == 'Web Address') {
			actionNeeded = false;
			textBoxNeeded = true;
		}
		
		var selectedValue = $(thisLinkModel).val();
		
		if (actionNeeded) {
			$innerHtml = '';
			for(keyArray in actionsArray) {
				var selected = '';
				
				if ((selectedValue == presetModelValue) && (keyArray == presetActionValue)) {
					selected = 'selected';
				}
				$innerHtml += '<option value="' + keyArray + '" '+selected+'>' + actionsArray[keyArray] + '</option>';	
			}
			$(thisLinkAction).html($innerHtml);
			$(thisLinkAction).show();
		} else {
			$innerHtml = '<option value="" selected></option>';
			$(thisLinkAction).html($innerHtml);
			$(thisLinkAction).hide();
		}
		
		if (textBoxNeeded) {
			$(thisLinkAction1).show();
		} else {
			$(thisLinkAction1).hide();
		}
		
	}
	
	function writeupdate(sortableId) {
		// append the # sign
		sortableId = "#" + sortableId;
		
		var sortableListArray = sortableId.split('_');
		var listId = sortableListArray.pop();
		
		//var id_array = $(sortableId).sortable("serialize", {key:'data[Link][displayrow]'});
		var id_array = $(sortableId).sortable("serialize");
		
		$.ajax({
			type: 'POST',
			url: '/admin/links/order/' + listId,
			data: id_array,
		});
			
		
	}
	
	
</script>
