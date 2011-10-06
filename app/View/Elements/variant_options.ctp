<fieldset>
        <legend><?php echo __('Options');?></legend>
        <div id="variants">
            <?php
            $productOptions = !empty($this->request->data['Product']['options']) ? $this->request->data['Product']['options']: array();
            
            // we need to set this hidden field so that the options will definitely be updated
            echo $this->Form->input('Product.edit_options', array('type'=>'hidden',
                                                            'value'=>'1'));
            ?>

            <div id="vOpts">

                <?php
                $count = 0;
                if (!empty($productOptions)) {
                    $count = count($productOptions);
                    ?>                       
                <?php
                    echo $this->element('view_variant_option', array('productOptions'=>$productOptions));
                } else {
                    //echo $this->element('add_variant_option', array('show'=>true));
                }
                
                ?>
                <input type="hidden" value="<?php echo $count?>" name="vcount" id="vcount" /> 
            </div>
            <div class="clear"></div>
        </div>
        <?php
            echo $this->Html->link('Add another option', 'javascript: void(0);', array(
              'id' => 'plus',
              'style' => (count($productOptions) < 3) ? 'display: block' : 'display: none;'));
        ?>
</fieldset>        

