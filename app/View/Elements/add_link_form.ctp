
<?php
        echo '<tr id="link-form-'.$linkListId.'" style="display:none;"><td colspan="4">';
        echo $this->Form->create('Link', array('url'=>array('action'=>'add')));
        ?>
        <?php
        echo '<table class="new_link_table" cellpadding="0" cellspacing="0">';
        
        echo '<tr class="add-link-tr"><td class="new-link link-name border_none">';
        echo $this->Form->input('Link.name', array('div'=>false,
                                                   'style'=>'width:auto;', 'label' => __('Name of new link')));
        echo '</td>';
        
        echo '<td class="new-link link-route border_none">';
        $modelOptions = array(
                '/blogs/'               =>'Blog',
		'/cart'	      	  	=>'Cart',
		'/collections/all'	=>'Catalogue',
                '/products/'	        =>'Product',
		'/pages/'	        =>'Page',
		'/'		        =>'Shop Frontpage',
                'web'                   =>'Web Address',
	);
        
        echo $this->Form->label('Route');
        echo $this->Form->input('Link.model', array(
		'id'=>'LinkModelList'.$linkListId,
                'type'=>'select',
                'options' => $modelOptions,
                'selected' => '/blogs/',
                'div'=>false,
                'label'=>false,
                'style'=>'width:auto;',
		'class'=>'new-link-model'));
        
        echo "&nbsp;&nbsp;";
        $options = array();
        echo $this->Form->input('Link.action', array(
		'id'=>'LinkActionList'.$linkListId,
                'type'=>'select',
                'options' => $options,
                'div'=>false,
                'label'=>false,
                'style'=>'width:auto;'));
        
        echo $this->Form->input('Link.action1', array(
		'id'=>'LinkAction1List'.$linkListId,
                'div'=>false,
                'label'=>false,
                'style'=>'width:auto;display:none;'));
        
        echo '</td>';
        
        echo '</tr>';
        
        echo '<tr class="add-link-tr-submit"><td colspan="2" class="border_none">';
        echo '<div class="submit">';
        echo $this->Form->input('Link.link_list_id', array('type'=>'hidden','value'=>$linkListId));
	echo $this->Form->input('Link.parent_model', array('type'=>'hidden',
							   'value'=>'',
							   'id'=>'LinkParentModelList'.$linkListId,));
	echo $this->Form->input('Link.parent_id', array('type'=>'hidden',
							'value'=>'',
							'id'=>'LinkParentIdList'.$linkListId,));
        echo $this->Ajax->submit('Add new link', array('url'=>array('action'=>'add'),
                                                'complete' => "afterAddLink($linkListId, request.responseText);",
                                                'div'=>false));
        
        echo '&nbsp;or&nbsp;<a href="#" onclick="$(\'#link-form-'.$linkListId.'\').hide();$(\'#new_link_'.$linkListId.'\').show(); return false;">Cancel</a>';
        echo '</div>';
        
        echo '</td></tr>';
        echo '</table>';
        echo $this->Form->end();
        echo '</td></tr>';
?>
