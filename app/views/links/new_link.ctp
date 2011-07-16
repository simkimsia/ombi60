<?php

	if ($link['Link']['id'] != null) {
            
            
            $order = $link['Link']['order'];
            $linkId = $link['Link']['id'];
            $linkName = $link['Link']['name'];
            $linkModel = $link['Link']['model'];
            $linkAction = $link['Link']['action'];
            $linkRoute = $link['Link']['route'];
	    $parentModel = $link['Link']['parent_model'];
	    $parentId = $link['Link']['parent_id'];
            
            // please note that &copy; below is a very important delimiter
            // before the &copy; it is used for the display link list
            // after is for edit list
		
            // assume max 20 links per link list
?>
	
        <li id="displayrow_<?php echo $linkId; ?>">
		
		<span class="link_li"><?php echo $linkName; ?>&nbsp;</span>
		<span class="link_li"><?php echo $this->Html->link($linkRoute,
						 $linkRoute); ?>&nbsp;</span>
	    
	</li>&copy;
	<tr id="edit_row_<?php echo $linkId; ?>">
			
                <td>
                        <?php echo $this->Form->input('Link.' . $order . '.name', array('value'=>$linkName, 'label' => FALSE, 'div' => FALSE));
                        ?>&nbsp;
                        <?php echo $this->Form->input('Link.' . $order . '.id', array('type'=>'hidden',
                                                                              'value'=>$linkId)); ?>
                </td>
                <?php
                        $modelOptions = array(
                                '/blogs/'               =>'Blog',
                                '/cart'	        	=>'Cart',
                                '/collections/all'	=>'Catalogue',
                                '/products/'       	=>'Product',
                                '/pages/'	        =>'Page',
                                '/'		        =>'Shop Frontpage',
                                'web'                   =>'Web Address',
                        );
                        
                ?>
                <td>
                        <?php echo $this->Form->input('Link.' . $order . '.model', array(
											'id' => 'Link'.$linkId.'Model',
											'type'=>'select',
                                                                                        'options' => $modelOptions,
                                                                                        'selected' => $linkModel,
                                                                                        'div'=>false,
                                                                                        'label'=>false,
                                                                                        'onchange'=>'resetLinkAction(\''.$linkId.'\', \''.$linkModel.'\', \''.$linkAction.'\')'));
                        
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
                                
                        echo $this->Form->input('Link.' . $order . '.action', array('type'=>'select',
										    'id'=>'Link'.$linkId.'Action',
                                                                                    'options' => $actionOptions,
                                                                                    'selected' => $linkAction,
                                                                                    'div'=>false,
                                                                                    'label'=>false,
                                                                                    'style'=>$displayVisible,
										    'onchange'=>'updateParentModelId(\''.$linkId.'\')'));
                        
                        echo $this->Form->input('Link.'.$order.'.action1', array(
						'value' => $linkAction,
						'div'=>false,
						'label'=>false,
						'id' => 'Link'.$linkId.'Action1',
						'style'=>$textBoxVisible));
			
			echo $this->Form->input('Link.'.$order.'.parent_model', array('type'=>'hidden',
										      'value'=>$parentModel,
										      'id'=> 'Link'.$linkId.'ParentModel'));
			echo $this->Form->input('Link.'.$order.'.parent_id', array('type'=>'hidden',
										   'value'=>$parentId,
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
<?php
	}
?>
	
