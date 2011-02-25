<?php
	$i = 0;
	foreach ($productImages as $key=>$productImage):
		
		$id = $productImage['ProductImage']['id'];
		if ($i % 2 == 0) {
			$liClass = 'left';
		} else {
			$liClass = 'right';
		}
	?>
	
		<li id="product_image-<?php echo $id; ?>" class="<?php echo $liClass; ?>">
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
				echo '<span class="make_cover">' . __('Cover Image', true) . '</span>'; //$this->Html->image('tick.gif');
				
			} else {
				echo $this->Html->link(__('Make Cover', true),
						array('controller' => 'product_images', 'action' => 'make_this_cover', 'admin' => true, 'id'=>$id, 'product_id' => $productImage['ProductImage']['product_id']),
						array('escape' => false, 'class' => 'make_cover'));	
			}
			
			?>&nbsp;
			
							   
		</li>
	    <?php
		if ($i++ % 2 == 1) {
		    echo "<div style='clear: both;'></div>";
		}
		?>
<?php endforeach; ?>
	
