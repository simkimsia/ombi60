<?php 
echo $this->Html->script(array('smart_collections/admin'), array('inline' => false));
//debug($smart_collection);
?>
<?php if (isset($view)) { ?>
  <form id="saveConditionForm" action="/admin/smart_collections/save_condition" method="post" style="width: auto;">
    <input type="hidden" name="smart_collection_id" id ="SmartCollectionId" value="<?php echo $smart_collection['SmartCollection']['id']?>"/>
<?php } ?>
<?php //echo $this->Form->create('SmartCollection', array('url' => array('action' => 'save_condition'), 'id' => 'saveConditionForm'));?>

  <?php //echo $this->Form->input('SmartCollectionId', array('type' => 'hidden', 'value' => $smart_collection['SmartCollection']['id'], 'id' => 'SmartCollectionId'));?>

<fieldset>
  <legend><?php __('Set your conditions'); ?></legend>
  <span class="hint">You can add as many conditions as you need by using the buttons on the right.</span>
  <div style="clear: both;"></div>
  <div id="setCondition">
    <?php  
    if (isset($view)) { 
      if (!empty($smart_collection['SmartCollectionCondition'])) {
        foreach ($smart_collection['SmartCollectionCondition'] as $smart_condition) {
          $field = $smart_condition['field'];
          $relation = $smart_condition['relation'];
          $condition = $smart_condition['condition'];
          $id = $smart_condition['id'];
          echo $this->element('condition_form', array('field' => $field, 'relation' => $relation, 'condition' => $condition, 'id' => $id)); 
        }
      } else {
        echo $this->element('condition_form');
      }
    } else {
      echo $this->element('condition_form');
    }
    ?>

  </div>
  <?php if (isset($view)) { ?><input type="submit" value="Update Collection"><?php }?>
  
</fieldset>
<?php //echo $this->Form->end();?>
<?php if (isset($view)) { ?></form><?php }?>
<div id="product-list">
<?php 
//echo $this->Session->flash();
if (isset($products) && !empty($products) && count($products) > 0) {
  ?><?php
  echo $this->element('admin_smart_collection_products');
  ?><?php
}
?>
</div>