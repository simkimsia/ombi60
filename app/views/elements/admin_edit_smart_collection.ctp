<div class="collections">
<?php echo $this->Form->create('ProductGroup', array('url' => array('action' => 'edit_smart', $data['ProductGroup']['id']), ));?>
  <?php echo $this->Form->input('id', array('value' => $data['ProductGroup']['id']))?>
  <fieldset>
    <legend><?php echo __('Edit Smart Collection'); ?></legend>
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
    echo $this->Form->input('title', array('value' => $data['ProductGroup']['title']));
    
    $label = $this->Form->label('handle', 'Permalink/handle');
    $textbox = $this->Form->text('ProductGroup.handle', array('class' => 'small', 'value' => $data['ProductGroup']['handle']));
    $prefix = Router::url('/collections/', true);
    $suffix = ' ( ' . $this->Html->link(__('What is this?'), '#') . ' )';
    echo $this->Html->div('input text', $label.$prefix.$textbox. $suffix ,array(), true);
    
    echo $this->Form->input('description', array('label' => __('Write description of collection'), 'value' => $data['ProductGroup']['description']));
  ?>
  </fieldset>
  
  <fieldset>
    <legend><?php echo __('Properties', FALSE)?></legend>
      <span class="hint"><?php echo __("If you don't want this smart collection to show up on your store front you can set its visibility to hidden.", FALSE);?></span>
      <div style="clear: both;"></div>
      <?php
        echo $this->Form->input('ProductGroup.visible', array('options' => array('1'=>'Published', '0'=>'Hidden'), 'label' => false, 'value' => $data['ProductGroup']['visible']));        
      ?>
  </fieldset><fieldset>
    <div class="submit">
      <?php echo $this->Form->submit(__('Edit Smart Collection'), array('div' => false));?> &nbsp;<?php echo __('or'); ?>&nbsp;
      <?php echo $this->Html->link(__('Cancel'), array('controller'=>'product_groups','action' => 'index'), array('onclick' => "return edit();")); ?>
    </div>
  </fieldset>

  
  <?php echo $this->Form->end(); ?>
</div>
