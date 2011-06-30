<?php ?>
<style>
    
</style>
<ul class="opts">
    <?php
    $selectedFields = array_keys($productOptions);
    // we need to set this hidden field so that the options will definitely be updated
    echo $this->Form->input('Product.edit_options', array('type'=>'hidden',
                                                            'value'=>'1'));
    foreach($productOptions as $field=>$option) : ?>
        <li id="<?php echo $field; ?>" class="">
            <ul class="alreadAddedOptions">
                <li class="selectOpts">
                    <table cellpadding="0" cellspacing="0" style="background: none;">
                        <tr>
                            <td>                            
                                <select name="data[Product][options][<?php echo $field; ?>][new_field]" onchange="checkCustom(this.value, '<?php echo $field;?>');" class="OptName">';
                        
                                        <option <?php echo ife(($field == "title"), 'selected="selected"', "");?> <?php echo ife((in_array("title", $selectedFields) || $field === "title"), "", 'disabled=true')?> value="title">Title</option>
                                        <option <?php echo ife(($field == "color"), 'selected="selected"', "");?> <?php echo ife((in_array("color", $selectedFields) || $field === "color"), "", 'disabled=true')?> value="color">Color</option>
                                        <option <?php echo ife(($field == "style"), 'selected="selected"', "");?> <?php echo ife((in_array("style", $selectedFields) || $field === "style"), "", 'disabled=true')?> value="style">Style</option>
                                        <option <?php echo ife(($field == "size"), 'selected="selected"', "");?> <?php echo ife((in_array("size", $selectedFields) || $field === "size"), "", 'disabled=true')?> value="size">Size</option>
                                        <option <?php echo ife(($field == "material"), 'selected="selected"', "");?> <?php echo ife((in_array("material", $selectedFields) || $field === "material"), "", 'disabled=true')?> value="material">Material</option>
                                        <option <?php echo ife(($field == "custom"), 'selected="selected"', "");?> value="custom" >Custom</option>
                                </select>
                                <!--<input type="hidden" id="ProductOptions<?php echo Inflector::camelize(str_replace(' ', '_', $field)); ?>Delete" name="data[Product][options][<?php echo $field; ?>][delete]" value="0" id="deleteOption_<?php echo $field;?>" />-->
                                <input type="hidden" name="data[Product][options][<?php echo $field; ?>][delete]" value="0" id="deleteOption_<?php echo $field;?>" />
                            </td>
                            <td style="display: none;" style="width: 30%;" id="showCustom_<?php echo $field;?>"><input type="text" name="data[Product][options][<?php echo $field; ?>][custom_new_field]" /></td>
                        </tr>
                    
                    </table>
                </li>
                <li class="selectVals">
                    <?php
                    if (!empty($option['values_in_string'])) {
                            $value = $option['values_in_string'];
                            ?>
                            <!--<input type="hidden" name="data[VariantOption][<?php //echo $variantId;?>_<?php //echo $i;?>][value]" value="<?php //echo implode(', ', $value);?>" />-->
                            <span style="padding-top:10px; display: block;">
                            <?php
                            echo $value;
                            ?></span><?php
                    }
                    ?>
                </li>
                <li class="optsTrash">
                    <?php
                    if (count(explode(', ', $value)) <= 1) {
                            ?>
                            <div style="text-align: right;"><?php echo $this->Html->link($this->Html->image('trash.gif', array('alt' => 'Remove')), 'javascript: void(0);', array('class' => 'minus', 'escape' => false, 'id' => "minus_".$field, 'rel' => 'remove_'.$option['option_ids']));?></div>
                            
                            <?php
                    }?>
                </li>
                <div class="clear"></div>
            </ul>
            
        </li>
        <li style="display: none" id="<?php echo "undo_".$field?>"><div style="padding: 5px; text-align: right;" ><?php __(ucfirst($field) . " will be deleted "); echo $this->Html->link('undo', 'javascript: void(0);', array('class' => 'undo', 'escape' => false, 'id' => 'aundo_'.$field));?></div></li>                 
    <?php
        endforeach;
    ?>
</ul>