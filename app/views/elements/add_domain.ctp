<div id="add_domain_div" style="display: none;" class="margin_top_15">
    <div style="display:none;" id="show_error"></div>
    <?php echo __('Enter your domain below');?>
    <br />
<?php
    echo $this->Form->create('Domain', array('action' => 'add', 'id' => 'domain_form'));
    echo 'http://' . $this->Form->input('domain', array('type' => 'text', 'div' => FALSE, 'label' => FALSE, 'class' => 'text_field', 'error' => 'Please add domain name.'));
    echo $this->Form->input('shop_id', array('type'=>'hidden', 'value'=>$shopId));
    echo $this->Form->input('primary', array('type'=>'hidden', 'value'=>false));
    echo $this->Form->input('always_redirect_here', array('type'=>'hidden', 'value'=>false));
    ?>
    <div class="submit">
    <?php
    echo $this->Ajax->submit('Claim your domain', array('url'=>array('action'=>'add'),
                                                       'complete' => "afterAddDomain(request.responseText);",
                                                       'div'=>false));
    
    echo '&nbsp;or&nbsp;<a href="#" onclick="$(\'#add_domain_div\').hide();$(\'#add_domain\').show(); return false;">Cancel</a>';
    ?>
    </div>    
    <?php
    echo $this->Form->end();
?>
</div>
