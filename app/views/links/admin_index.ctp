<?php echo $this->element('admin_scripts'); ?>
<?php

	echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.7/jquery-ui.min.js');
	
	function convertBlogOptions($blogs) {
		$array = array();
		foreach($blogs as $blog) {
			$array[$blog['Blog']['short_name']] = $blog['Blog']['title'];
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
			$array[$product['Product']['handle']] = $product['Product']['title'];
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

<div class="">
	<h2 class="text_center"><?php __('Navigation & Menu Links');?></h2>
	<div id="domain_intro_text">
	    <strong>Link Lists</strong>
	    <br>
	    There are two link lists. One for the Main Menu you see at the top of your shop. 
	    <br>
	    One for the Footer you see at the bottom of your shop.	    
	</div>
	
	<?php
	foreach ($lists as $list):
	
	
	$listName = $list['LinkList']['name'];
	$listId = $list['LinkList']['id'];
	$linkCount = $list['LinkList']['link_count'];
	
	
	
	?>
	
	<style type="text/css">
		.sortable { list-style-type: none; margin: 0; padding: 0; width: 100%; }
        .sortable li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; font-size: 1.4em; height: 18px; /*background: url('/img/admin/icon_star_empty.gif') no-repeat left center #E4E4E4;*/}
        .sortable li:hover
        {
            background: url('/img/admin/hand_icon.gif') no-repeat left center;
        }
        </style>
	<table cellpadding="0" cellspacing="0" class="products-table">
	
	
		
	<tr>
		<?php
		echo '
		<table id="display_list_'.$listId.'" cellpadding="0" cellspacing="0" class="products-table">';		
		echo '
			<tr class="background_gray" >
				<td class="background_none" >
					<strong>'.$listName.'</strong>
				</td>
				<td class="background_none" style="text-align: right;">
					<a href="#" onclick="editListForm('.$listId.');return false;">Edit link list</a>
				</td>
			</tr>';
		?>
		
		<tr>	
			<th width="42%"><?php echo __('Name of link', true);?></th>
			<th width="45%"><?php echo 'Route';?></th>
			
		</tr>
		<tr>
			<td colspan="2">
				<ul class="sortable" id="display_links_sortable_<?php echo $listId; ?>">
		<?php
		$i = 0;
		foreach ($list['Link'] as $link):
    		$class = null;
			if ($i++ % 2 == 0) {
				$class = 'background_gray';
			}			
		?>
		<li class="ui-state-default <?php echo $class;?>" id="displayrow_<?php echo $link['id']; ?>">
			<span class="link_li"><?php echo $this->Html->link($link['name'], $link['route']); ?>&nbsp;</span>
			<span class="link_li"><?php echo $this->Html->link($link['route'],
							   $link['route']); ?>
			</span>
			
		</li>
		<?php endforeach; ?>
					</ul>
					
				</td>
			</tr>
			<tr><td colspan="2" style="background: none;">&nbsp;</td></tr>
			<!--<tr><td colspan="2" class="background_gray" style="padding-top: 0px;padding-bottom: 0px;">&nbsp;</td></tr>
			<tr><td colspan="2" style="background: none;">&nbsp;</td></tr>-->
		<?php
			$displayLinksSortable = 'display_links_sortable_'.$listId;
			echo $this->Ajax->sortable($displayLinksSortable, array('update'=>"writeupdate('$displayLinksSortable')"));
			echo '<tr id="new_link_'. $listId .'" class="background_gray"><td class="background_none" colspan="2"><a href="#" onclick="showLinkForm('.$listId.');return false;">Add Link</a>&nbsp;</td></tr>';
			echo $this->element('add_link_form', array('linkListId'=>$listId, 'linkCount' => $linkCount));
		?>
				
		</table>
	
		<?php
		echo $this->Form->create('Link', array('url'=>array('action'=>'edit',$listId)));
		echo $this->Form->input('LinkList.id', array('type'=>'hidden', 'value'=>$listId));
		echo '<table id="edit_list_'.$listId.'" style="display:none;" class="items-table">';
		?>
		<tr>
			<?php //echo "<td>$listName</td>"; ?>
      <td><?php //echo __('Name of link list') ?></td>
		</tr>
		<?php
		
		echo '
		<tr>	
			<td colspan="3">';
		
		echo $this->Form->input('LinkList.name', array('value'=>$listName, 'label' => __('Name of link list', true)));
		
				
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
				<?php echo $this->Form->input('Link.'.$i.'.name', array('value'=>$link['name'], 'label' => FALSE, 'div' => false)); ?>&nbsp;
				<?php echo $this->Form->input('Link.'.$i.'.id', array('type'=>'hidden',
										      'value'=>$linkId)); ?>
			</td>
			<?php
				$modelOptions = array('/blogs/'			=>'Blog',
						      '/cart'			=>'Cart',
						      '/collections/all'  	=>'Catalogue',
						      '/products/' 		=>'Product',
						      '/pages/'			=>'Page',
						      '/'			=>'Shop Frontpage',
						      'web'			=>'Web Address',
						      );
			
			?>
			<td>
				<?php
				
				echo $this->Form->input('Link.'.$i.'.model',
					array('type'=>'select',
					      'id'=>'Link'.$linkId.'Model',
					      'options' => $modelOptions,
					      'selected' => $link['model'],
					      'div'=>false,
					      'label'=>false,
					      'onchange'=>'resetLinkAction(\''.$linkId.'\', \''.$link['model'].'\', \''.$link['action'].'\')'));
				
				$options       = array();
				$actionNeeded  = true;
				$textBoxNeeded = false;
				
				if (strpos($link['model'], 'blog') !== false) {
					$options = convertBlogOptions($blogs);
				} else if (($link['model'] === '/collections/all') ||
					   ($link['model'] === '/') ||
					   ($link['model'] === '/cart') ) {
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
						'id'=>'Link'.$linkId.'Action',
						'options' => $options,
						'selected' => $link['action'],
						'div'=>false,
						'label'=>false,
						'style'=>$displayVisible,
						'onchange'=>'updateParentModelId(\''.$linkId.'\')'
						));
				
				echo $this->Form->input('Link.'.$i.'.action1', array(
						'id'=>'Link'.$linkId.'Action1',
						'value' => $link['action'],
						'div'=>false,
						'label'=>false,
						'style'=>$textBoxVisible));
				
				echo $this->Form->input('Link.'.$i.'.parent_model', array('type'=>'hidden',
										      'value'=>$link['parent_model'],
										      'id'=> 'Link'.$linkId.'ParentModel'));
				echo $this->Form->input('Link.'.$i.'.parent_id', array('type'=>'hidden',
										   'value'=>$link['parent_id'],
										   'id'=> 'Link'.$linkId.'ParentId'));
				
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
		echo $this->Form->submit('Save Changes', array('div' => false));
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
	<div class="clear">&nbsp;</div>
<?php endforeach; ?>

</div>


<?php
	# blog array;
	# "pass" php array to JS array:
	echo "<script>\n";
	echo "var blogs = new Object();\n";
	echo "var blogIds = new Object();\n";
	
	foreach($blogs as $key => $value) {
		$js_key = $value['Blog']['short_name'];
		$js_value = $value['Blog']['title'];
		$js_blogId = $value['Blog']['id'];
		echo "blogs['$js_key'] = '$js_value';\n";
		echo "blogIds['$js_key'] = '$js_blogId';\n";
	}
	
	echo "var products = new Object();\n";
	echo "var productIds = new Object();\n";
	
	foreach($products as $key => $value) {
		$js_key = $value['Product']['handle'];
		$js_value = $value['Product']['title'];
		$js_productId = $value['Product']['id'];
		echo "products['$js_key'] = '$js_value';\n";
		echo "productIds['$js_key'] = '$js_productId';\n";
	}
	
	echo "var pages = new Object();\n";
	echo "var pageIds = new Object();\n";
	foreach($pages as $key => $value) {
		$js_key = $value['Webpage']['handle'];
		$js_value = $value['Webpage']['title'];
		$js_pageId = $value['Webpage']['id'];
		echo "pages['$js_key'] = '$js_value';\n";
		echo "pageIds['$js_key'] = '$js_pageId';\n";
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
		$('#new_link_'+id).hide();
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
		<?php
		foreach ($lists as $list):
		$listId = $list['LinkList']['id'];
		echo "resetLinkActionForAddLinkForm($listId);";
		endforeach;
		?>
		$('.new-link-model').change(function(){
			idOfLinkModel = $(this).attr("id");
			// the model should start with LinkModelList
			resetLinkActionForAddLinkForm(idOfLinkModel.substr(13));
		});
	});
	
	function resetLinkActionForAddLinkForm(linkListId) {
		
		linkId            = '';
		presetActionValue = '';
		presetModelValue  = '';
		
		var thisLinkModel  = "#LinkModelList" + linkListId;
		var thisLinkAction = "#LinkActionList" + linkListId;
		var thisLinkAction1 = "#LinkAction1List" + linkListId;
		
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
		
		updateParentModelIdForAddLinkForm(linkListId);
	}
	
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
		
		updateParentModelId(linkId);
		
	}
	
	function updateParentModelId(linkId) {
		var thisLinkModel  = "#Link" + linkId + "Model";
		var thisLinkAction = "#Link" + linkId + "Action";
		var thisLinkParentModel  = "#Link" + linkId + "ParentModel";
		var thisLinkParentId	 = "#Link" + linkId + "ParentId";
		
		var selectedText = $(thisLinkModel + " option:selected").text();
		var parentModel = '';
		var parentId = '';
		
		
		if (selectedText == 'Blog') {
			parentModel = 'Blog';
			parentId = getParentId(blogIds, thisLinkAction);
			
		} else if (selectedText == 'Product') {
			parentModel = 'Product';
			parentId = getParentId(productIds, thisLinkAction);
			
		} else if (selectedText == 'Page') {
			parentModel = 'Webpage';
			parentId = getParentId(pageIds, thisLinkAction);
		}
		
		$(thisLinkParentModel).attr('value', parentModel);
		$(thisLinkParentId).attr('value', parentId);
	}
	
	function updateParentModelIdForAddLinkForm(linkListId) {
		var thisLinkModel  = "#LinkModelList" + linkListId;
		var thisLinkAction = "#LinkActionList" + linkListId;
		var thisLinkParentModel  = "#LinkParentModelList" + linkListId;
		var thisLinkParentId	 = "#LinkParentIdList" + linkListId;
		
		var selectedText = $(thisLinkModel + " option:selected").text();
		var parentModel = '';
		var parentId = '';
		
		
		if (selectedText == 'Blog') {
			parentModel = 'Blog';
			parentId = getParentId(blogIds, thisLinkAction);
			
		} else if (selectedText == 'Product') {
			parentModel = 'Product';
			parentId = getParentId(productIds, thisLinkAction);
			
		} else if (selectedText == 'Page') {
			parentModel = 'Webpage';
			parentId = getParentId(pageIds, thisLinkAction);
		}
		
		$(thisLinkParentModel).attr('value', parentModel);
		$(thisLinkParentId).attr('value', parentId);
	}
	
	function getParentId(actionsArray, thisLinkAction) {
		var handle = $(thisLinkAction).attr('value');
		return actionsArray[handle];
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
