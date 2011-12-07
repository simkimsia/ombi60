
<div class="products index">
<h2 align="center" class="product-heading"><?php echo __('Products');?></h2>
<div align="center">
    <?php echo $this->Html->link(__('Add New Product'), array('action' => 'add')); ?></li>
</div>
<br />

<span class='paginator-top'>
<?php
echo $this->Paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%')
));
?>
</span>
<?php
if ($this->Paginator->params['paging']['Product']['pageCount'] > 1) {
?> 
<span class="top-paging">
    <?php echo $this->Paginator->prev('<< '.__('previous'), array(), null, array('class'=>'disabled'));?>
 |  <?php echo $this->Paginator->numbers();?>
    <?php echo $this->Paginator->next(__('next').' >>', array(), null, array('class' => 'disabled'));?>
</span>
<?php 
} 
?>
<br/>
<br/>
<?php
echo $this->element('action_buttons', array('modelName' => 'Product'));
?>

<table cellpadding="0" cellspacing="0" class="products-table" id="products-table">
	<tr>
		<th>&nbsp;</th>
		<th class="product-header"><?php echo $this->Paginator->sort(__('Product'), 'title'); ?></th>
		<th style="text-align: center;"><?php echo $this->Paginator->sort('visible');?></th>
		<th class="actions" style="text-align: center;"><?php echo __('Actions');?></th>
	</tr>

<?php
$i = 0;
foreach ($products as $key=>$product):
	$hidden = (!$product['Product']['visible']) ;
	$hiddenCheckboxClass = '';
	if ($hidden) {
	        $hiddenCheckboxClass = ' hidden';
	}
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td width="5%" align="center"><?php echo $this->Form->checkbox('Product.selected.'.$key, array('value' => $product['Product']['id'], 'class' => 'checkbox_check' . $hiddenCheckboxClass, 'label' => FALSE, 'div' => FALSE, 'style' => 'margin: 5px 6px 7px 20px;'));?></td>
		<td>
		  <span class="photo">
		    <?php
            if (isset($product['ProductImage']['filename']))            
                echo $this->Html->image(UP_ONE_DIR_LEVEL . PRODUCT_IMAGES_THUMB_SMALL_URL . $product['ProductImage']['filename']); 
			else 
				echo $this->Html->image('/img/admin/no-image-small.gif'); 
			?>
		  </span>
		  <span class="product-details">
            <?php echo $this->Html->link($product['Product']['title'], array('action' => 'view', $product['Product']['id'])); ?> <br>
            <?php echo '$', $product['Product']['price']; ?>		  
		  </span>
		</td>
		<td align="center" style="text-align: center;">
		<?php 
			if (1 == $product['Product']['visible']) {
			    $status = __('Published');
			} else {
			    $status = __('Hidden');    
			}        
		?>	
		  
		  <?php echo $this->Html->link($status,
					       array('action' => 'toggle', $product['Product']['id']),
					       array('class' => 'product-status')); ?>
		</td>
		<td class="actions" style="text-align: center;">	
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $product['Product']['id'])); ?>
			<?php echo $this->Html->link(__('Duplicate'), array('action' => 'duplicate', $product['Product']['id'])); ?>
			<?php echo $this->Html->link(__('Delete'), array('action' => 'delete', $product['Product']['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $product['Product']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>     
</table>
<div class="bottom-paging">
<?php
if ($this->Paginator->params['paging']['Product']['pageCount'] > 1) {
?> 
    <?php echo $this->Paginator->prev('<< '.__('previous'), array(), null, array('class'=>'disabled'));?>
 |  <?php echo $this->Paginator->numbers();?>
    <?php echo $this->Paginator->next(__('next').' >>', array(), null, array('class' => 'disabled'));?>
</div>
<?php
}
?>
</div>

<script>

	$(document).ready(function() {
		// to remove the auto required class added
		$('#ProductTitle').parent().removeClass('required');
	});

</script>

