<style>
  .plus {
    padding: 5px; margin: 5px;
  }
  .minus {
    padding: 5px; margin: 5px;
  }
</style>
<?php 
echo $this->Html->script(array('smart_collections/admin'), array('inline' => false));
//debug($smart_collection);
?>
<fieldset>
  <legend><?php __('Set your conditions'); ?></legend>
    <span class="hint">You can add as many conditions as you need by using the buttons on the right.</span>      
    <div style="clear: both;"></div>
    <div id="setCondition">
      <?php 
        if (isset($smart_collection['SmartCollectionCondition']) && !empty($smart_collection['SmartCollectionCondition'])) {
          ?>
            <?php echo $this->Form->create('SmartCollectionCondition', array('url' => array('controller' => 'smart_collections', 'action' => 'update_collection'), 'inputDefaults' => array('label' => false, 'div' => false)));?>
            <?php echo $this->Form->input('SmartCollectionId', array('type' => 'hidden', 'value' => $smart_collection['SmartCollection']['id'], 'id' => 'SmartCollectionId'));?>
          <?php
          foreach ($smart_collection['SmartCollectionCondition'] as $smart_condition) {
//debug($smart_condition);
            $field = $smart_condition['field'];
            $relation = $smart_condition['relation'];
            $condition = $smart_condition['condition'];
            echo $this->Form->input('smart_collection_condition_id', array('type' => 'hidden', 'value' => $smart_condition['id']));
            ?>
              <div class="addMultiple" rel="<?php echo $smart_condition['id'];?>">
                <select name="fields[]">
                  <option value="Product.title" <?php echo ($field == "Product.title") ? "selected='selected'": "";?>>Product title</option>
                  <option value="Product.price" <?php echo ($field == "Product.price") ? "selected='selected'": "";?>>Product price</option>
                </select>
                
                <?php 
        /*        $fields = array(
                          'Product.title' => 'Product title',
                          'Product.price' => 'Product price',
                          );
                echo $this->Form->input('SmartCollectionCondition.0.Field',array('options' => $fields, 'label' => false, 'div' => false, 'class' => 'smartField'));
        */
                ?>
                <select name="relations[]">
                  <option value="equals" <?php echo ($relation == "equals") ? "selected='selected'": "";?>>is equal to</option>
                  <option value="greater_than" <?php echo ($relation == "greater_than") ? "selected='selected'": "";?>>is greater than</option>
                  <option value="less_than" <?php echo ($relation == "less_than") ? "selected='selected'": "";?>>is less than</option>
                  <option value="starts_with" <?php echo ($relation == "starts_with") ? "selected='selected'": "";?>>starts with</option>
                  <option value="ends_with" <?php echo ($relation == "ends_with") ? "selected='selected'": "";?>>ends with</option>
                  <option value="contains" <?php echo ($relation == "contains") ? "selected='selected'": "";?>>contains</option>
                </select>
                <?php 
                /*$relations = array(
                              'equals'       => 'is equal to',
                              'greater_than' => 'is greater than',
                              'less_than'    => 'is less than',
                              'starts_with'  => 'starts with',
                              'ends_with'    => 'ends with',
                              'contains'     => 'contains',
                              );
                echo $this->Form->input('SmartCollectionCondition.0.Relation',array('options' => $relations, 'label' => false, 'div' => false, 'class' => 'smartRelation'));*/ 

                ?>
                <input type="text" name="conditions[]" style="width: auto;" value=<?php echo $condition;?> />
        <?php 
                //echo $this->Form->input('SmartCollectionCondition.0.Condition',array('label' => false, 'div' => false, 'style' => 'width: auto;', 'div' => false, 'class' => 'smartCondition'));
                ?>
                <div style="float: right;">
                  <?php 
                  echo $this->Html->link($this->Html->image('plus.png', array('alt' => 'Plus')), 'javascript: void(0);', array('escape' => false, 'class' => 'plus'));
                  echo $this->Html->link($this->Html->image('minus.png', array('alt' => 'Minus')), 'javascript: void(0);', array('escape' => false, 'class' => 'minus'));
                  ?>
                </div>
              </div>            
            <?php
          }
          ?>
          <?php echo $this->Form->submit('Update Collection', array('div' => false));?>
          <?php echo $this->Form->end();?>
          <?php
        } else {
          ?>
          <div class="addMultiple">
            <select name="fields[]">
              <option value="Product.title">Product title</option>
              <option value="Product.price">Product price</option>
            </select>
            <?php 
    /*        $fields = array(
                      'Product.title' => 'Product title',
                      'Product.price' => 'Product price',
                      );
            echo $this->Form->input('SmartCollectionCondition.0.Field',array('options' => $fields, 'label' => false, 'div' => false, 'class' => 'smartField'));
    */
            ?>
            <select name="relations[]">
              <option value="equals">is equal to</option>
              <option value="greater_than">is greater than</option>
              <option value="less_than">is less than</option>
              <option value="starts_with">starts with</option>
              <option value="ends_with">ends with</option>
              <option value="contains">contains</option>
            </select>
            <?php 
            /*$relations = array(
                          'equals'       => 'is equal to',
                          'greater_than' => 'is greater than',
                          'less_than'    => 'is less than',
                          'starts_with'  => 'starts with',
                          'ends_with'    => 'ends with',
                          'contains'     => 'contains',
                          );
            echo $this->Form->input('SmartCollectionCondition.0.Relation',array('options' => $relations, 'label' => false, 'div' => false, 'class' => 'smartRelation'));*/ 

            ?>
            <input type="text" name="conditions[]" style="width: auto;" />
    <?php 
            //echo $this->Form->input('SmartCollectionCondition.0.Condition',array('label' => false, 'div' => false, 'style' => 'width: auto;', 'div' => false, 'class' => 'smartCondition'));
            ?>
            <div style="float: right;">
              <?php 
              echo $this->Html->link($this->Html->image('plus.png', array('alt' => 'Plus')), 'javascript: void(0);', array('escape' => false, 'class' => 'plus'));
              echo $this->Html->link($this->Html->image('minus.png', array('alt' => 'Minus')), 'javascript: void(0);', array('escape' => false, 'class' => 'minus'));
              ?>
            </div>
          </div>
          <?php
        }
      ?>
    </div>      

</fieldset>
<?php 
if (isset($products) && !empty($products)) {
  echo $this->element('admin_smart_collection_products');
}
?>