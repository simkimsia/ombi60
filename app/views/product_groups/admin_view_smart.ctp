<div class="collections">
    <div class="text_center">
        <h2>
          <?php echo $productGroup['ProductGroup']['title']; ?>
        </h2>
        <?php echo $this->Html->link(__('Edit', true), array('action' => 'edit_smart', $productGroup['ProductGroup']['id'])); ?>
        &nbsp;|&nbsp;
          <?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $productGroup['ProductGroup']['id']), null, sprintf(__('Are you sure you want to delete this collection?', true), $productGroup['ProductGroup']['id'])); ?>&nbsp;|&nbsp;
          <?php echo $this->Html->link(__('Back to Collections', true), array('action' => 'index')); ?>
  </div>
 
  <div>
    <fieldset>
        <legend>Properties</legend>
        <label><?php __('Page Visibility');?></label>
 		<span class="hint">If you want to hide this collection from your clients, choose hidden.</span>
 		<br>
 		<?php 
        echo $this->Form->input('visible',array('options' => array('1'=>'Published', '0'=>'Hidden'), 'label' => false, 'selected' => $productGroup['ProductGroup']['visible'])); 
         ?>
        <?php //print ((bool)$productGroup['ProductGroup']['visible'] ? "Published" : "Hidden")?>
        <br>        
        
        
    </fieldset>
  </div>	
</div>
