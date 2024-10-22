<div class="collections">
    <div class="text_center">
        <h2>
          <?php echo $productGroup['ProductGroup']['title']; ?>
        </h2>
        <?php echo $this->Html->link(__('Edit'), array('action' => 'edit_custom', $productGroup['ProductGroup']['id'])); ?>
        &nbsp;|&nbsp;
          <?php echo $this->Html->link(__('Delete'), array('action' => 'delete', $productGroup['ProductGroup']['id']), null, sprintf(__('Are you sure you want to delete this collection?'), $productGroup['ProductGroup']['id'])); ?>&nbsp;|&nbsp;
          <?php echo $this->Html->link(__('Back to Collections'), array('action' => 'index')); ?>
  </div>
 
  <!-- start element -->
  <?php echo $this->element('admin_product_search_and_list'); ?>
  <!-- end element -->
  <div>
    <fieldset>
        <legend>Properties</legend>
        <label><?php echo __('Page Visibility');?></label>
 		<span class="hint">If you want to hide this collection from your clients, choose hidden.</span>
 		<br>
 	<?php 
        echo $this->Form->input('ProductGroup.visible',array('options' => array('1'=>'Published', '0'=>'Hidden'), 'label' => false, 'selected' => $productGroup['ProductGroup']['visible'])); 
         ?>
	 
	 <?php 
	    echo $this->Ajax->observeField( 'ProductGroupVisible', 
		array(
		    'url' => array( 'action' => 'toggle',
				   'controller' => 'product_groups',
				   'admin' => true,
				   $productGroup['ProductGroup']['id']),
		    //'complete' => 'alert(request.responseText)'
		) 
	    ); 
	?>
        <br>        
        
        
    </fieldset>
  </div>	
</div>
