<?php
        echo '<tr id="link-form-'.$linkListId.'" style="display:none;"><td colspan="4">';
        echo $this->Form->create('Link', array('url'=>array('action'=>'add')));
        echo '<table class="new-link-table">';
        
        echo '<tr><td class="new-link link-name">';
        echo $this->Form->input('Link.name', array('div'=>false,
                                                   'style'=>'width:100%;'));
        echo '</td>';
        
        echo '<td class="new-link link-route">';
        $modelOptions = array('/blogs/'=>'Blog',
                              '/products/view/'=>'Product',
                              '/pages/'=>'Page',);
        echo $this->Form->label('Links to');
        echo $this->Form->input('Link.model', array('type'=>'select',
                                                    'options' => $modelOptions,
                                                    'selected' => '/blogs/',
                                                    'div'=>false,
                                                    'label'=>false,
                                                    'style'=>'width:100%;'));
        
        $options = array();
        echo $this->Form->input('Link.action', array('type'=>'select',
                                                    'options' => $options,
                                                    'div'=>false,
                                                    'label'=>false,
                                                    'style'=>'width:100%;'));
        
        echo '</td>';
        
        echo '</tr>';
        
        echo '<tr><td>';
        echo '<div class="submit">';
        echo $this->Form->input('Link.link_list_id', array('type'=>'hidden','value'=>$linkListId));        
        echo $this->Ajax->submit('Add Link', array('url'=>array('action'=>'add'),
                                                'complete' => "afterAddLink($linkListId, request.responseText);",
                                                'div'=>false));
        
        echo '&nbsp;or&nbsp;<a href="#" onclick="$(\'#link-form-'.$linkListId.'\').hide();return false;">Cancel</a>';
        echo '</div>';
        
        echo '</td></tr>';
        echo '</table>';
        echo $this->Form->end();
        echo '</td></tr>';
?>