<div class="collections">
    <div class="text_center">
        <h2>
          <?php echo $smart_collection['ProductGroup']['title']; ?>
        </h2>
        <?php echo $this->Html->link(__('Edit', true), array('action' => 'edit_smart', $smart_collection['ProductGroup']['id'])); ?>
        &nbsp;|&nbsp;
          <?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $smart_collection['ProductGroup']['id']), null, sprintf(__('Are you sure you want to delete this collection?', true), $smart_collection['ProductGroup']['id'])); ?>&nbsp;|&nbsp;
          <?php echo $this->Html->link(__('Back to Collections', true), array('controller'=>'product_groups','action' => 'index')); ?>
  </div>
  <?php
  //echo $this->Html->script(array('admin_view_custom'), array('inline' => false));
  echo $this->Form->input('id', array('id' => 'smartCollectionId', 'value' => $smart_collection['ProductGroup']['id'], 'type' => 'hidden'));
?>
  
  <fieldset id="sDescription">
      <legend><?php __('Description', FALSE)?></legend>
      <div><?php print $smart_collection['ProductGroup']['description'];?></div>
  </fieldset>
  <div id="edit-form" style="display: none;">
    <?php echo $this->element('admin_edit_smart_collection', array('data' => $smart_collection));?>
  </div>
  <div id="smartCollection">
    <?php echo $this->element('admin_set_smart_collection_condition');?>
  </div>
  <fieldset>
    <legend><?php __('Properties', FALSE)?></legend>
      <span class="hint"><?php __("If you don't want this smart collection to show up on your store front you can set its visibility to hidden.", FALSE);?></span>
      <div style="clear: both;"></div>
      <?php
        echo $this->Form->input('ProductGroup.visible', array('options' => array('1'=>'Published', '0'=>'Hidden'), 'label' => false, 'value' => $smart_collection['ProductGroup']['visible']));
        
      ?>
  </fieldset>
  <div style="clear: both;"></div>
  
  
  <!-- start element -->
  <?php //echo $this->element('admin_product_search_and_list'); ?>
  <!-- end element -->
  
</div>
