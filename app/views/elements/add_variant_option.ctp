<div class="addMultiple" style="display: none;">
        <?php
                echo $this->Form->input('VariantOption.0.field', array('class' => 'OptName', 'options' => $voptions, 'label' => false, 'div' => false, 'onChange' => 'checkCustomAdd(this.value)'));
                ?><input type="text" style="display: none; width: 30%;" class="custom" /><?php
                echo $this->Form->input('VariantOption.0.value', array('class' => 'OptValue','label' => false, 'value' => 'Default Value', 'div' => false, 'style' => 'width: 30%;'));
        ?>
        
        <?php echo $this->Html->link('x', 'javascript: void(0);', array('class' => 'minus'));?>
<div class="clear"></div>
</div>