<?php 
echo $html->script('jquery.styledButton.js', array('inline' => FALSE));
echo $html->script('jquery.action_button.js', array('inline' => FALSE));  

echo $html->css('styledButton');
?>

<div style="width: 85%;">
        <div class="action-buttons">
            <span class="selectCheckbox"><input type="checkbox" class="checkAll" /></span><span class="checkUnCheck" style="width: 50px;">⇣
		        <ul>
			        <li>All</li>
			        <li>None</li>
			        <li>Published</li>
			        <li>Hidden</li>
		        </ul>
	        </span>
            <!--<span style="margin-left: -8px;"><?php 
            /*$options = array(
                        'all' => 'All', 
                        'none' => 'None', 
                        'published' => "Published", 
                        'hidden' => 'Hidden');
            echo $form->input('check_uncheck_all', array(
                                                    'options' => $options, 
                                                    'label' => FALSE, 
                                                    'div' => FALSE,
                                                    'id' => 'check_uncheck_options',
                                                    'style' => 'width: 23px;'
                                                   ));*/
            ?></span>-->
        </div>
        <div class="action-buttons"><span class="delete">Delete</span></div>
        <div id="delete_confirm" style="display: none;"><?php echo $deleteConfirm;?></div>
        <div id="delete_url" style="display: none;"><?php echo $deleteURL;?></div>
        &nbsp;
        <div class="action-buttons">
            <span class="moreaction">More Actions
		        <ul>
			        <li>Publish Page</li>
			        <li>Hide Page</li>
		        </ul>
	        </span>
            <?php 
            /*$more_action = array('1' => 'Publish Page', '0' => 'Hide Page');
            echo $form->input('more_actions', array(
                                               'options' => $more_action,
                                               'empty' => 'More Actions',
                                               'label' => FALSE,
                                               'div' => FALSE,
                                              ));*/?></div>
        <div>
        <div style="text-align: right;"><?php echo $this->element('pagination', array('modelName' => $modelName));?></div>
        
        </div>
    </div>
