
<div class="collections">
      <div class="text_center">
        <h2><?php __('Add your New Smart Collection');?></h2>
        <?php echo $this->Html->link(__('Cancel', true), array('controller'=>'product_groups','action' => 'index')); ?>
    </div>

<?php echo $this->Form->create('SmartCollection');?>
  <fieldset>
    <legend><?php __('New Smart Collection'); ?></legend>
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
    echo $this->Form->input('title');
    echo $this->Form->input('description', array('label' => __('Write description of collection', true)));
  ?>
  </fieldset>
  <?php echo $this->element('admin_set_smart_collection_condition');?>

  <div class="submit">
    <?php echo $this->Form->submit(__('Create Smart Collection', true), array('div' => false));?> &nbsp;<?php __('or'); ?>&nbsp;
    <?php echo $this->Html->link(__('Cancel', true), array('controller'=>'product_groups','action' => 'index')); ?>
  </div>
  <?php echo $this->Form->end(); ?>
</div>
