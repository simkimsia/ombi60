<table cellpadding="2" cellspacing="2" width="100%" style="margin-bottom: 0px; display: none;" class="addMultiple">
<?php
        ?>
        <tr>
            <td style="width: 43%;" valign="top">
                <table cellpadding="0" cellspacing="0">
                    <tr>
                        <td valign="top">
                            <?php
                            echo $this->Form->input('VariantOption.0.field', array('class' => 'PluOptName', 'options' => $voptions, 'label' => false, 'div' => false, 'onChange' => 'checkCustomAdd(this.value)'));
                            ?>
                        </td>
                        <td style="display: none;" class="custom"  valign="top"><input type="text" class="custom" /></td>
                    </tr>
                </table>
            </td>
            
            <td  valign="top">
                <?php
                        echo $this->Form->input('VariantOption.0.value', array('class' => 'OptValue','label' => false, 'value' => 'Default Value', 'div' => false, ));
                ?>
            </td>
            <td valign="top"><div style="padding: 5px;"><?php echo $this->Html->link($this->Html->image('trash.gif', array('alt' => 'Remove')), 'javascript: void(0);', array('class' => 'minus', 'escape' => false));?></div></td>
        </tr>
</table>
