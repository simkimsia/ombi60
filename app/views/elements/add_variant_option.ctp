<?php ?>
<ul class="addMultiple" style="margin-bottom: 0px; <?php echo ife(isset($show), 'display: block;', 'display: none')?>;">
    <li class="selectOpts">
        <table cellpadding="0" cellspacing="0">
            <tr>
                <td valign="top">
                    <?php
                    
                    $voptions = array('title'=>'Title',
                                        'color'=>'Color',
                                        'style'=>'Style',
                                        'size'=>'Size',
                                        'material'=>'Material',
                                        'custom'=>'Custom', 
                                );
                    echo $this->Form->input('Product.new_options.0.field', array('class' => 'PluOptName', 'options' => $voptions, 'label' => false, 'div' => false, 'onChange' => 'checkCustomAdd(this.value)'));
                    ?>
                </td>
                <td style="display: none;" class="custom"  valign="top"><input type="text" class="custom" name="data[Product][new_options][0][custom_field]"/></td>
            </tr>
        </table>
    </li>
    <li class="selectVals">
        <?php
            echo $this->Form->input('Product.new_options.0.value', array('class' => 'OptValue','label' => false, 'value' => 'Default Title', 'div' => false, ));
        ?>
    </li>
    <li class="optsTrash">
        <div><?php echo $this->Html->link($this->Html->image('trash.gif', array('alt' => 'Remove')), 'javascript: void(0);', array('class' => 'minus', 'escape' => false));?></div>
    </li>
    <div class="clear"></div>
</ul>