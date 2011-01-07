<?php

	if ($link['Link']['id'] != null) {
            
            
            $order = $link['Link']['order'];
            $linkId = $link['Link']['id'];
            $linkName = $link['Link']['name'];
            $linkModel = $link['Link']['model'];
            $linkAction = $link['Link']['action'];
            $linkRoute = $link['Link']['route'];
            
            // please note that &copy; below is a very important delimiter
            // before the &copy; it is used for the display link list
            // after is for edit list
		
            // assume max 20 links per link list
?>
	
        <tr>
		
		<td><?php echo $linkName; ?>&nbsp;</td>
		<td><?php echo $this->Html->link($linkRoute,
						 $linkRoute); ?>&nbsp;</td>
	    
	</tr>&copy;
	<tr>
			
                <td>
                        <?php echo $this->Form->input('Link.' . $order . '.name', array('value'=>$linkName));
                        ?>&nbsp;
                        <?php echo $this->Form->input('Link.' . $order . '.id', array('type'=>'hidden',
                                                                              'value'=>$linkId)); ?>
                </td>
                <?php
                        $modelOptions = array('/blogs/'=>'Blog',
                                              '/products/view/'=>'Product',
                                              '/pages/'=>'Page',);
                        
                ?>
                <td>
                        <?php echo $this->Form->input('Link.' . $order . '.model', array('type'=>'select',
                                                                                        'options' => $modelOptions,
                                                                                        'selected' => $linkModel,
                                                                                        'div'=>false,
                                                                                        'label'=>false,
                                                                                        'style'=>'width:100%;',
                                                                                        'onchange'=>'resetLinkAction(\''.$order.'\', \''.$linkModel.'\', \''.$linkAction.'\')'));
                        
                        
                        echo $this->Form->input('Link.' . $order . '.action', array('type'=>'select',
                                                                                    'options' => $actionOptions,
                                                                                    'selected' => $linkAction,
                                                                                    'div'=>false,
                                                                                    'label'=>false,
                                                                                    'style'=>'width:100%;'));
                        
                        ?>
                &nbsp;
                </td>
                
                <td class="actions">
                        <?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $linkId), null, sprintf(__('Are you sure you want to delete # %s?', true), $linkId)); ?>
                </td>
        </tr>
<?php
	}
?>
	
