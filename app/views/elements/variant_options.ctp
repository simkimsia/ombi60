<fieldset>
        <legend><?php __('Options');?></legend>
        <div id="variants">
                
        <?php
        $productOptions = !empty($this->data['Product']['options']) ? $this->data['Product']['options']: array();
        ?>
        
                <div id="vOpts">
        
        <?php
        $count = 0;
        if (!empty($productOptions)) {
            $count = count($productOptions);
            ?>                       
        <?php
            echo $this->element('view_variant_option', array('productOptions'=>$productOptions));
        }
        
        ?>

        <input type="hidden" value="<?php echo $count?>" name="vcount" id="vcount" />
        <input type="hidden" value="0" name="newly_added_count" id="newly_added_count" /> 
                </div>
                <div class="clear"></div>
                
        </div>
        <?php
            echo $this->Html->link('Add another option', 'javascript: void(0);', array('id' => 'plus', 'style' => ife((count($productOptions) < 3), 'display: block', 'display: none;')));
        ?>
</fieldset>        

