<fieldset>
        <legend><?php __('Options');?></legend>
        <div id="variants">
                
        <?php
        $productOptions = !empty($this->data['Product']['options']) ? $this->data['Product']['options']: array();
        ?>
        
                <div id="vOpts">
        
        <?php
        if (!empty($productOptions)) {
                
        ?>
                
                        <input type="hidden" value="<?php echo count($productOptions)?>" name="vcount" id="vcount" />
                        
        <?php
                echo $this->element('view_variant_option', array('productOptions'=>$productOptions));
        } 
        echo $this->Html->link('Add another option', 'javascript: void(0);', array('id' => 'plus', 'style' => ife((count($productOptions) < 3), 'display: block', 'display: none;')));
        ?>
                </div>
                <div class="clear"></div>
                
        </div>
</fieldset>        

