<fieldset>
<?php echo $this->Form->create('',array('action' => 'variant_create','class' => 'variant'));?>
      <!-- setting options -->
      <table cellspacing="0" cellpadding="0" class="variant_div">
      <tbody>
       <tr class="variant_div">
        <td colspan="4">
          <div id="errors_for_product_variant"></div>
           <?php if (!isset($variant_detail['id'])) { ?>
          <p class="sb"><span class="note highlight-alt"><?php echo __('Your customers will select this new variant by the following',true);?>:</span></p>
          <?php } ?>
               <?php 
                $i=1;
               
              
              if (isset($variant_list['Product']['options']) && !empty($variant_list['Product']['options']) && is_array($variant_list['Product']['options'])) {
             $key=0;
            foreach($variant_list['Product']['options'] as $field => $options) {
                  echo $this->Form->input("Variant.option.$field",array('label' => __(ucfirst($field),true),'size' => '30','div' => array('class' => "variant_fields variant_option_$i"),'value' => isset($variant_detail['VariantOption'][$field]['value']) ?  "{$variant_detail['VariantOption'][$field]['value']}" : ""));$i++;
             }
            
            }
              
              ?>
                                            
                
          <div class="clearfix"></div>

        </td>
      </tr>
      <!-- end setting options -->

      <!-- more product information -->
      <tr class="divider variant_div">
        <td>        
          <?php echo $this->Form->input("Variant.sku_code",array("label" => __("SKU",true)." <span class=\"note\">".__("Stock Keeping Unit",true)."</span>","size" => "20","style" => "width:auto;","class" => "variant_more_options","value" => (isset($variant_detail['sku_code'])) ? $variant_detail['sku_code'] : ''));?>
        </td>
        <td>
        
          
           <?php echo $this->Form->input("Variant.price",array("label" => __("Selling price",true),"size" => "8","style" => "width:auto;","after" => __("USD",true),"class" => "variant_more_options","value" => isset($variant_detail['price']) ?  $variant_detail['price'] : ''));?>
        </td>
        <td>
         
            <?php echo $this->Form->input("Variant.compare_with_price",array("label" => __("Compare at price",true)." <span class=\"note\">(".__("optional",true).")</span>","after" => __("USD",true),"size" => "8","style" => "width:auto;","class" => "variant_more_options","value" => isset($variant_detail['compare_with_price']) ? $variant_detail['compare_with_price'] : ''));?>
        </td>
        <td>
         
            <?php echo $this->Form->input("Variant.weight",array('label' => __('Weight',true),'size' => '8','style' => 'width:auto;','class' => 'variant_more_options',"after" => __("lbs",true),"value" => isset($variant_detail['weight']) ? $variant_detail['weight'] : '')); ?>
        </td>
      </tr>
      <!-- end more product information -->

       <?php 
        if (isset($variant_detail['id'])) {
       echo $this->Form->input("Variant.id",array('type' => 'hidden',"value" => isset($variant_detail['id']) ? $variant_detail['id'] : ''));
          echo $this->Form->input("Variant.product_id",array('type' => 'hidden',"value" => isset($variant_detail['product_id']) ? $variant_detail['product_id'] : ''));
       }
       ?>
      <tr class="no-border variant_div">
        <td colspan="4">
                    <table class="secondary-variant-options" width="300px;">
                      <tbody>
                      <tr class="no-border">
                        <td class="right" >
                            <label for="variant-new-requires-shipping"><?php echo __('Require a shipping address',true);?></label>
                        </td>
                        <td>
                      
                          <?php echo $this->Form->input('Variant.shipping_required',array('value' => 1,'label' => false,'div' => false,'after' => '<span class="hint">'.__('not needed for services or digital goods',true).'</span>','checked' => !empty($variant_detail['shipping_required']) ? true : false ));?>
                          
                          
                        </td>
                      </tr>

                     
                    </tbody></table>
        </td>
      </tr>
    </tbody>
    </table>
<?php
	echo '<div class="submit group-actions">';
	if (!isset($variant_detail['id'])) {
	   echo $this->Form->submit(__('Create Variant', true), array('div' => FALSE));
	   echo ' or ' . $this->Html->link(__('Cancel', true),'javascript: void(0);', array('onclick' => '$(".variant_form").hide();$(".new-variant-link").show()')); 
	} else {
	   echo $this->Form->submit(__('Update', true), array('div' => FALSE));
	   $formid = 'row-edit-details-'.$variant_detail['id'];
	  /* echo "<script type='text/JavaScript'> var formid = <? echo $formid; ?></script> "; */
	   echo ' or ' . $this->Html->link(__('Cancel', true),'javascript: void(0);', array('onclick' => "hideEditForm('$formid')")); 
	}
	
	echo '</div>';
	echo $this->Form->end();
?>
</fieldset>
