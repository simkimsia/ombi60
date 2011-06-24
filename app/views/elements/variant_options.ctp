<fieldset>
        <legend><?php __('Variant Options');?></legend>
        <div id="variants">
        <?php
        $voptions = array(
                'title' => 'Title',
                'color' => 'Color',
                'style' => 'Style',
                'size' => 'Size',
                'material' => 'Material',
                'custom' => 'Custom',
                );                      
        //Frist check if variant option is present or not
        ?><?php                
        if (!empty($variants)) {
                ?>
                <div id="vOpts">
                <?php
                foreach ($variants as $variantId => $variantOptions) {
                        echo $this->Form->input('VariantOption.variant_id', array('type' => 'hidden', 'value' => $variantId));
                        ?>
                        <input type="hidden" value="<?php echo count($variantOptions)?>" name="vcount" id="vcount" />
                        <?php
                        echo $this->element('view_variant_option', array(
                                                                        'variantOption' => $variantOptions, 
                                                                        'variantId' => $variantId,
                                                                        'voptions' => $voptions,
                                                                        ));
                }
                ?></div><?php
                
                //echo $this->element('add_variant_option', array('voptions' => $voptions));
                echo $this->Html->link('Add more variant option', 'javascript: void(0);', array('id' => 'plus', 'style' => ife((count($variantOptions) < 3), 'display: block', 'display: none;')));
        } else {
                ?><div id="vOpts"><?php
                //echo $this->element('add_variant_option', array('voptions' => $voptions));
                ?></div><?php
                echo $this->Html->link('Add more variant option', 'javascript: void(0);', array('id' => 'plus'));                        
        }
        ?>
                <div class="clear"></div>
                
        </div>
</fieldset>        

