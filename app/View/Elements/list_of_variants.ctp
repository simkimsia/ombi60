<script type="text/JavaScript">
   function showEditForm(variantId) {
        $('#row-edit-details-'+variantId).show();
        $('#row-'+variantId).hide();
   }
 
   function hideEditForm(formid, id) {
        $('#'+formid).hide();
        $('#row-'+id).show();  
   }
   
   function checkall() {     
        if ($('#select_all').is(':checked')) {
          $(".list_checkbox").attr('checked', true);
       } else {
          $(".list_checkbox").attr('checked', false);
       }
   }

</script>
<fieldset>
<?php

if (isset($variant_list) && !empty($variant_list) && is_array($variant_list)) { ?>
  <table class="variant_list" cellspacing="0" cellpadding="0">
  <th class="checkbox_cell"><!--<input id="select_all" type="checkbox" onlick="">-->
    <?php echo $this->Form->checkbox("checkall",array("id" => "select_all","onclick" => "checkall()"));?>
  </th>
   <?php
   $key=0;
   if (isset($variant_list['Product']['options']) && !empty($variant_list['Product']['options']) && is_array($variant_list['Product']['options'])) {
            foreach($variant_list['Product']['options'] as $field => $options) {
   ?>
        <th class="variant_option_<?php echo ++$key;?> option_header"> <?php echo ucfirst($field);?></th>
   <?php
   }
    }
   ?>
   <th> <?php echo __('SKU');?> </th>
   <th> <?php echo __('Price')." <span class=\"note\">".__("USD")."</span>";?> </th>
   <th> <?php echo __('In Stock'); ?> </th>
   <th> &nbsp; </th>
 
    
<?php  
   $rowIndex = 1;
   foreach ($variant_list['Variant'] as $variant) {
    
   ?>
   <tr id="row-<?php echo $variant['id'];?>" class="<?php echo ($rowIndex % 2 == 0) ? 'row-even' : 'row-odd'; ?>">
     <td class="checkbox_cell"><!--<input type="checkbox" class="list_checkbox" id="variant_<?php echo $variant['id'];?>" value="<?php echo $variant['id'];?>">-->
      <?php echo $this->Form->input("variants",array("class" => "list_checkbox" , "id" => "variant_".$variant['id'] ,"value" => $variant['id'],"type" => "checkbox","label" => false,"div" => false));?>
    
     
     
     </td>
      <?php
    
      if (isset($variant_list['Product']['options']) && !empty($variant_list['Product']['options']) && is_array($variant_list['Product']['options'])) {
             $key=0;
            foreach($variant_list['Product']['options'] as $field => $options) {
                
                  ?>
                   <td class="variant_option_<?php echo ++$key;?>">
                
                      <?php echo $variant['VariantOption'][$field]['value'] ?>
                 </td>
                 <?php
               
                
               } 
             ?>
           
             <td><?php  if (isset($variant['sku_code'])) {
          echo $variant['sku_code'];
      } ?>
      </td>
      <td><?php  if (isset($variant['price'])) {
          echo "$".$variant['price'];
      } ?>
      </td>
      <td> ∞</td>
      <td> <?php echo $this->Html->link(__("Edit"),"javascript: void(0);",array("onclick" => "showEditForm({$variant['id']})"));?> </td>
    </tr>
     <!-- row edit form -->
    <tr id="row-edit-details-<?php echo $variant['id'];?>" style="display:none;">
      <td colspan="<?php echo (count($variant_list['Product']['options']) + 5); ?>">
          <fieldset><?php echo $this->element('variant_edit_form',array('variant_detail' => $variant,
                                                                        'variant_list'   => $variant_list)); ?></fieldset>
      </td>    
    </tr>
      <!-- row edit form ends -->      
            <?php
           
           
      }
      ?>
        
  <?php
    $rowIndex++;
   }

?>
<tr>
  <td colspan="<?php echo (count($variant_list['Product']['options']) + 5); ?>">
   
   <p onclick="$('.new-variant-link').hide(); $('#new_variant').show(); $('.variant_option_1').select(); return false;">          
          <?php echo $this->Html->link(__('Create new variant'),'javascript: void(0);',array('class' => "new-variant-link"));?>
   </p>
  
  </td>
<tr>
</table>
 <?php   
}
?>
</fieldset>
<div id="new_variant" class="variant_form" style="display:none;">
<fieldset>

<h3> <?php echo __('New Variant');?> </h3>
  <?php echo $this->element('variant_edit_form',array('variant_detail' => array(),
                                                      'variant_list'   => $variant_list,
                                                      'variant_count'  => count($variant_list['Variant']))); ?>

</fieldset>
</div>
