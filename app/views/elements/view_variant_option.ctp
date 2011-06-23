
<?php
$checks = array_keys(array_diff_key($voptions, $variantOption));
$i = 0;
foreach ($variantOption as $field => $value) {
        ?>                                
        <div style="float: left;" class="alreadAddedOptions">
                <select name="data[VariantOption][<?php echo $variantId;?>][field]" onchange="checkCustom(this.value, <?php echo $i;?>);">                                                
                        <option <?php echo ife(($field == "title"), 'selected="selected"', "");?> <?php echo ife((in_array("title", $checks) || $field === "title"), "", 'disabled=true')?> value="title">Title</option>
                        <option <?php echo ife(($field == "color"), 'selected="selected"', "");?> <?php echo ife((in_array("color", $checks) || $field === "color"), "", 'disabled=true')?> value="color">Color</option>
                        <option <?php echo ife(($field == "style"), 'selected="selected"', "");?> <?php echo ife((in_array("style", $checks) || $field === "style"), "", 'disabled=true')?> value="style">Style</option>
                        <option <?php echo ife(($field == "size"), 'selected="selected"', "");?> <?php echo ife((in_array("size", $checks) || $field === "size"), "", 'disabled=true')?> value="size">Size</option>
                        <option <?php echo ife(($field == "material"), 'selected="selected"', "");?> <?php echo ife((in_array("material", $checks) || $field === "material"), "", 'disabled=true')?> value="material">Material</option>
                        <option <?php echo ife(($field == "custom"), 'selected="selected"', "");?> value="custom" >Custom</option>
                </select>
                <input type="text" name="data[VariantOption][<?php echo $variantId; ?>][fieldcustom]" id="showCustom_<?php echo $i;?>" style="display: none; width: 30%;" />
        </div><?php
        if (!empty($value)) {
                ?>
                <input type="hidden" name="data[VariantOption][<?php echo $variantId;?>][value]" value="<?php echo implode(', ', $value);?>" />
                <?php
                echo implode(', ', $value);
        }
        ?><div class="clear"></div>
        
        <?php
        $i++;
}
?>