

<div class="products index">
<h2 align="center" class="product-heading"><?php __('Products');?></h2>
<div class="product-add">
    <?php echo $this->Html->link(__('Add New Product', true), array('action' => 'add')); ?></li>
</div>
<br />
<?php echo $this->Form->create('Product', array('url' => array('controller' => 'products', 'action' => 'index', 'admin' => 'true'), 'id'=>'filters')); ?>
<table cellpadding="0" cellspacing="0" class="product-search">
    <tr>                
        <th><?php __('Title')?></th>
        <th><?php __('Price'); ?></th>
        <th><?php __('Status'); ?></th>
        <th></th>
    </tr>
    <tr>                
        <td><?php echo $this->Form->input('Product.title', array('label'=>false)); ?></td>
        <td><?php echo $this->Form->input('Product.price', array('label'=>false)); ?></td>
        <td><?php echo $this->Form->input('Product.status', array('options' => array('1'=>'Published', '0'=>'Hidden'),
                                      'empty' => 'Any status',
                                      'label' => false)); ?></td>
                <td>
                    <button type="submit" name="data[filter]" value="filter">Filter</button>
                    <button type="submit" name="data[reset]" value="reset">Reset</button>
                </td>
        </tr>
</table>        
<span class='paginator-top'>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?>
</span>
<?php
if ($paginator->params['paging']['Product']['pageCount'] > 1) {
?> 
<span class="top-paging">
    <?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 |  <?php echo $paginator->numbers();?>
    <?php echo $paginator->next(__('next', true).' >>', array(), null, array('class' => 'disabled'));?>
</span>
<?php 
} 
?>
<br/>
<br/>
<table cellpadding="0" cellspacing="0" class="products-table">
	<tr>
		<th class="product-header"><?php echo $paginator->sort(__('Product', true), 'title'); ?></th>
		<th style="text-align: center;"><?php echo $paginator->sort('status');?></th>
		<th class="actions" style="text-align: center;"><?php __('Actions');?></th>
	</tr>

<?php
$i = 0;
foreach ($products as $product):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>		
		<td>
		  <span class="photo">
		    <?php
            if (isset($product['ProductImage']['filename']))            
                echo $this->Html->image(UP_ONE_DIR_LEVEL . PRODUCT_IMAGES_THUMB_SMALL_URL . $product['ProductImage']['filename']); ?>
		  </span>
		  <span class="product-details">
            <?php echo $product['Product']['title']; ?> <br>
            <?php echo '$', $product['Product']['price']; ?>		  
		  </span>
		</td>
		<td align="center" style="text-align: center;">
		<?php 
			if (1 == $product['Product']['status']) {
			    $status = __('Published', true);
			} else {
			    $status = __('Hidden', true);    
			}        
		?>	
		  <a href="#" class="product-status"><?php echo $status; ?></a>
		</td>
		<td class="actions" style="text-align: center;">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $product['Product']['id'], 'admin' => false)); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $product['Product']['id'])); ?>
			<?php echo $this->Html->link(__('Duplicate', true), array('action' => 'duplicate', $product['Product']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $product['Product']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $product['Product']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>     
</table>
<div class="bottom-paging">
<?php
if ($paginator->params['paging']['Product']['pageCount'] > 1) {
?> 
    <?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 |  <?php echo $paginator->numbers();?>
    <?php echo $paginator->next(__('next', true).' >>', array(), null, array('class' => 'disabled'));?>
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

