

<div class="products index">
<h2><?php __('Products');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>

<?php echo $this->Form->create('Product', array('url' => array('controller' => 'products', 'action' => 'index', 'admin' => 'true'), 'id'=>'filters')); ?>
<table cellpadding="0" cellspacing="0">
	<tr>
		<th class="photo"><?php __('Photo');?></th>
		<th><?php echo $paginator->sort('title');?></th>
		<th><?php echo $paginator->sort('price');?></th>
		<th><?php echo $paginator->sort('status');?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>

	<tr>
                
		<th>--</th>
		<th><?php echo $this->Form->input('Product.title', array('label'=>false)); ?></th>
		<th><?php echo $this->Form->input('Product.price', array('label'=>false)); ?></th>
		<th><?php echo $this->Form->input('Product.status', array('options' => array('0'=>'Disabled','1'=>'Enabled'),
									  'empty' => 'Any status',
									  'label' => false)); ?></th>
                <th>
                    <button type="submit" name="data[filter]" value="filter">Filter</button>
                    <button type="submit" name="data[reset]" value="reset">Reset</button>
                </th>
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
			<?php
			if (isset($product['ProductImage']['filename']))
			
				echo $this->Html->image(UP_ONE_DIR_LEVEL . PRODUCT_IMAGES_THUMB_SMALL_URL . $product['ProductImage']['filename']); ?>
		</td>
		<td>
			<?php echo $product['Product']['title']; ?>
		</td>
		<td>
			<?php echo $product['Product']['price']; ?>
		</td>
		<td>
			<?php echo $this->element('toggle_image_link', array('currentStatus' => $product['Product']['status'],
									     'toggleUrl' => array('action'=>'toggle', $product['Product']['id']))); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $product['Product']['id'], 'admin' => false)); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $product['Product']['id'])); ?>
			<?php echo $this->Html->link(__('Duplicate', true), array('action' => 'duplicate', $product['Product']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $product['Product']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $product['Product']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<?php echo $this->Form->end(); ?>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class' => 'disabled'));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('New Product', true), array('action' => 'add')); ?></li>
	</ul>
</div>

<script>

	$(document).ready(function() {
		// to remove the auto required class added
		$('#ProductTitle').parent().removeClass('required');
	});

</script>

