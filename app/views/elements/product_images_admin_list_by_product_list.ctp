<div id="productImages-index"> <!-- ajax paginate update this div ONLY -->
<div class="productImages index" >
<h2><?php __('ProductImages');?></h2>
<p>
<?php


$this->Paginator->options(array(
				'url' => array('controller' => 'product_images',
					 'action' => 'list_by_product',
					 'product_id' => $product_id,
					),
				'update' => '#productImages-index', // we want to update just the div in this page.
				'evalScripts' => true,
				'before' => $this->Js->get('#busy-indicator')->effect('fadeIn', array('buffer' => false)),
				'complete' => $this->Js->get('#busy-indicator')->effect('fadeOut', array('buffer' => false)),

			  ));

?>


<?php

echo $this->Paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?>

</p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $this->Paginator->sort('id');?></th>
	<th><?php echo $this->Paginator->sort('product_id');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($productImages as $productImage):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $productImage['ProductImage']['id']; ?>
		</td>
		<td>
			<?php echo $productImage['ProductImage']['product_id']; ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Cover', true), array('controller' => 'product_images', 'action' => 'make_this_cover', 'id'=>$productImage['ProductImage']['id'], 'product_id'=>$productImage['ProductImage']['product_id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('controller' => 'product_images', 'action' => 'delete', 'id'=>$productImage['ProductImage']['id'], 'product_id'=>$productImage['ProductImage']['product_id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $productImage['ProductImage']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>

<div class="paging">
	<?php echo $this->Paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $this->Paginator->numbers();?>
	<?php echo $this->Paginator->next(__('next', true).' >>', array(), null, array('class' => 'disabled'));?>
</div>

</div>
</div>




<?php
	echo $this->Js->writeBuffer();
?>