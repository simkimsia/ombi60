<div class="addMultiple" id="form_<?php echo (isset($id)? $id: "");?>" rel="<?php echo (isset($id)? $id: "");?>">  
  <select name="fields[]">
    <option value="Product.title" <?php echo (isset($field) && $field == "Product.title") ? "selected='selected'": "";?>>Product title</option>
    <option value="Product.price" <?php echo (isset($field) && $field == "Product.price") ? "selected='selected'": "";?>>Product price</option>
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
    <option value="equals" <?php echo (isset($relation) && $relation == "equals") ? "selected='selected'": "";?>>is equal to</option>
    <option value="greater_than" <?php echo (isset($relation) && $relation == "greater_than") ? "selected='selected'": "";?>>is greater than</option>
    <option value="less_than" <?php echo (isset($relation) && $relation == "less_than") ? "selected='selected'": "";?>>is less than</option>
    <option value="starts_with" <?php echo (isset($relation) && $relation == "starts_with") ? "selected='selected'": "";?>>starts with</option>
    <option value="ends_with" <?php echo (isset($relation) && $relation == "ends_with") ? "selected='selected'": "";?>>ends with</option>
    <option value="contains" <?php echo (isset($relation) && $relation == "contains") ? "selected='selected'": "";?>>contains</option>
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
  <input type="text" name="conditions[]" style="width: auto;" value="<?php echo (isset($condition) ? $condition: null);?>" />
  <?php if (isset($condition) && $condition == "") {
    echo "<br />";
    echo "<span class='error'>Condition could not be left empty</span>";
  }?>
<?php 
  //echo $this->Form->input('SmartCollectionCondition.0.Condition',array('label' => false, 'div' => false, 'style' => 'width: auto;', 'div' => false, 'class' => 'smartCondition'));
  ?>
  <div style="float: right;">
    <?php 
    echo $this->Html->link($this->Html->image('plus.png', array('alt' => 'Plus')), 'javascript: void(0);', array('escape' => false, 'class' => 'plus'));
    $url = (isset($id) ? array('controller' => 'smart_collections', 'action' => 'remove_condition') : "javascript: void(0)");
    //$id = (isset($smart_condition['id']) ? 'id'=> $smart_condition['id']: "");
    echo $this->Html->link($this->Html->image('minus.png', array('alt' => 'Minus')), $url, array('escape' => false, 'class' => 'minus', 'id' => (isset($id)? $id: "")));
    ?>
  </div>
</div> 