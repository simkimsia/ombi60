<table cellpadding="2" cellspacing="2" width="100%" style="margin-bottom: 0px;">
<?php
$tmp = array();
foreach ($variantOption as $optionIdField => $optionValue) {
        $idFieldArr = explode("_", $optionIdField);
        $afield = $idFieldArr[0];
        $tmp[$afield] = $optionValue;
}

$checks = array_keys(array_diff_key($voptions, $tmp));

$i = 0;
?>
<input type="hidden" id="checks" value = <?php echo json_encode($checks);?> />
<?php
foreach ($variantOption as $IdField => $value) {
        $idFieldArr = explode("_", $IdField);
        $field = $idFieldArr[0];
        $optionId = $idFieldArr[1];
        ?>
        <tr id="<?php echo $i;?>">
            <td class="alreadAddedOptions" style="width: 50%;">
                <table cellpadding="0" cellspacing="0">
                    <tr>
                        <td>
                            <select name="data[VariantOption][<?php echo $variantId;?>_<?php echo $i;?>][field]" onchange="checkCustom(this.value, <?php echo $i;?>);" class="OptName">                                                
                                    <option <?php echo ife(($field == "title"), 'selected="selected"', "");?> <?php echo ife((in_array("title", $checks) || $field === "title"), "", 'disabled=true')?> value="title">Title</option>
                                    <option <?php echo ife(($field == "color"), 'selected="selected"', "");?> <?php echo ife((in_array("color", $checks) || $field === "color"), "", 'disabled=true')?> value="color">Color</option>
                                    <option <?php echo ife(($field == "style"), 'selected="selected"', "");?> <?php echo ife((in_array("style", $checks) || $field === "style"), "", 'disabled=true')?> value="style">Style</option>
                                    <option <?php echo ife(($field == "size"), 'selected="selected"', "");?> <?php echo ife((in_array("size", $checks) || $field === "size"), "", 'disabled=true')?> value="size">Size</option>
                                    <option <?php echo ife(($field == "material"), 'selected="selected"', "");?> <?php echo ife((in_array("material", $checks) || $field === "material"), "", 'disabled=true')?> value="material">Material</option>
                                    <option <?php echo ife(($field == "custom"), 'selected="selected"', "");?> value="custom" >Custom</option>
                            </select>
                        </td>
                        <td style="display: none;" style="width: 30%;" id="showCustom_<?php echo $i;?>"><input type="text" name="data[VariantOption][<?php echo $variantId; ?>_<?php echo $i;?>][fieldcustom]" /></td>
                    </tr>
                </table>
            </td>
            
            <td style="width: 50%;" valign="justify">
                <?php
                if (!empty($value)) {
                        ?>
                        <input type="hidden" name="data[VariantOption][<?php echo $variantId;?>_<?php echo $i;?>][value]" value="<?php echo implode(', ', $value);?>" />
                        <span style="padding-top:10px; display: block;">
                        <?php
                        echo implode(', ', $value);
                        ?></span><?php
                }
                ?>
            </td>
            <td valign="top"><div style="padding: 5px;"><?php echo $this->Html->link($this->Html->image('trash.gif', array('alt' => 'Remove')), 'javascript: void(0);', array('class' => 'minus', 'escape' => false, 'id' => "minus_".$i, 'rel' => 'remove_'.$optionId));?></div></td>
        </tr>
        <?php
        $i++;
}
?>
</table>