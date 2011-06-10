<div class="collections">
<?php echo $this->Form->create('SmartCollection', array('url' => array('action' => 'edit', $data['SmartCollection']['id']), ));?>
  <?php echo $this->Form->input('id', array('value' => $data['SmartCollection']['id']))?>
  <fieldset>
    <legend><?php __('Edit Smart Collection'); ?></legend>
  <?php
  
  $this->TinyMce->editor(array(
      'theme' => 'advanced',
      'mode' => 'textareas',
      'plugins' => ' table',
      'theme_advanced_buttons1' => 'bold,italic,underline,undo,redo,link,unlink,forecolor,styleselect,removeformat,cleanup,code,table,fontselect,fontsizeselect',
      'theme_advanced_buttons2' => '',
      'theme_advanced_toolbar_location' => 'top',
      'remove_linebreaks' => false,
      'extended_valid_elements' => 'textarea[cols|rows|disabled|name|readonly|class]'));
  
    echo $this->Form->input('shop_id', array('type'=>'hidden', 'value'=>Shop::get('Shop.id')));
    echo $this->Form->input('title', array('value' => $data['SmartCollection']['title']));
    echo $this->Form->input('description', array('label' => __('Write description of collection', true), 'value' => $data['SmartCollection']['description']));
  ?>
  </fieldset>
  
  <fieldset>
    <legend><?php __('Properties', FALSE)?></legend>
      <span class="hint"><?php __("If you don't want this smart collection to show up on your store front you can set its visibility to hidden.", FALSE);?></span>
      <div style="clear: both;"></div>
      <?php
        echo $this->Form->input('SmartCollection.visible', array('options' => array('1'=>'Published', '0'=>'Hidden'), 'label' => false, 'value' => $data['SmartCollection']['visible']));        
      ?>
  </fieldset><fieldset>
    <div class="submit">
      <?php echo $this->Form->submit(__('Edit Smart Collection', true), array('div' => false));?> &nbsp;<?php __('or'); ?>&nbsp;
      <?php echo $this->Html->link(__('Cancel', true), array('controller'=>'product_groups','action' => 'index'), array('onclick' => "return edit();")); ?>
    </div>
  </fieldset>

  
  <?php echo $this->Form->end(); ?>
</div>
