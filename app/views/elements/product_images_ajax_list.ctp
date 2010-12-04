
	<?php
	
	foreach ($productImages as $key=>$productImage):
		
		$id = $productImage['ProductImage']['id'];
	?>
	
		<li id="product_image-<?php echo $id; ?>">
			<div class="product_image-preview">
			<?php echo $this->Html->image('../uploads/products/thumb/small/' .$productImage['ProductImage']['filename']); ?>&nbsp;
			</div>
			<?php
			$trashPic = $this->Html->image('trash.gif');
			
			echo $this->Ajax->link($trashPic,
						     array('controller' => 'product_images', 'action' => 'delete', 'id'=>$id, 'product_id'=>$productImage['ProductImage']['product_id']),
						     array('complete' => "afterDelete(request.responseText);",
							   'escape' => false,
							   'indicator' => 'busy-indicator',
							   'confirm' => sprintf(__('Are you sure you want to delete %s?', true), $productImage['ProductImage']['filename'])));
			
			if ($productImage['ProductImage']['cover']) {
				echo $this->Html->image('tick.gif');
				
			} else {
				echo $this->Html->link($this->Html->image('x_solid_red_25.gif'),
						array('controller' => 'product_images', 'action' => 'make_this_cover', 'admin' => true, 'id'=>$id, 'product_id' => $productImage['ProductImage']['product_id']),
						array('escape' => false));	
			}
			
			?>&nbsp;
							   
							   
		</li>
	
<?php endforeach; ?>
	