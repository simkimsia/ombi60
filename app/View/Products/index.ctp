<?php
	echo $this->Html->script('http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js');
	
?>

	<div id="cataloguetop"></div>
	<div id="cataloguebody">
		
		<div id="sidebar">
			<div class="barcategory" id="selectedbarcategory">Category 1</div>
				<div class="baritem"><a href="catalogueitem.html">Item 1</a></div>
				<div class="baritem"><a href="catalogueitem2.html">Item 2</a></div>
				<div class="baritem"><a href="catalogueitem3.html">Item 3</a></div>
				<div class="baritem"><a href="#">Item 4</a></div>
				<div class="baritem"><a href="#">Item 5</a></div>
				<div class="baritem"><a href="#">Item 6</a></div>
				<div class="baritem"><a href="#">Item 7</a></div>
				<div class="baritem"><a href="#">Item 8</a></div>
				<div class="baritem"><a href="#">Item 9</a></div>
				<div class="baritem"><a href="#">Item 10</a></div>
			<div class="barcategory"><a href="#">Category 2</a></div>
			<div class="barcategory"><a href="#">Category 3</a></div>
			<div class="barcategory"><a href="#">Category 4</a></div>
		</div>
		<div id="cataloguewrapper">
			<div class="categorywrapper">
			<div class="categorytop"></div>
				<div class="contentcategory">Category 1</div>
				<div id="resultsetbar"><div id="resultsettext"><?php
			echo $this->Paginator->counter(array(
			'format' => __('Showing %start% - %end% of %count% items')
			));
		?></div>
					
		<?php
		
			
			$sort = isset($this->request->params['named']['sort']) ? $this->request->params['named']['sort'] : 'created';
			$order = isset($this->request->params['named']['direction']) ? $this->request->params['named']['direction'] : 'desc';
			
			
			$optionSelected = 'created';
			
			
			
			if ($sort == 'price' && $order == 'asc') {
				$optionSelected = 'price';
			}
			
			if ($sort == 'price' && $order == 'desc') {
				$optionSelected = 'price-';
			}
			
			
		?>
					
		<div id="sortby">Sort By: 
			<select name="SortBy" id="sortBySelect">
				<option value="created" <?php if ($optionSelected == 'created') echo ' selected'; ?>>Date: Latest</option>
				<option value="price" <?php if ($optionSelected == 'price') echo ' selected'; ?>>Price: Low to High</option>
				<option value="price-" <?php if ($optionSelected == 'price-') echo ' selected'; ?>>Price: High to Low</option>
			</select>
		</div>
	</div>
				<?php
					$i = 0;
					
					foreach ($products as $product):
						$class = null;
						if ($i++ % 2 == 0) {
							$class = ' class="altrow"';
						}
				?>
				
					<div class="contentitem">
						<div class="contentleftbar">
							<div class="itemimage">
								
									<?php
									$image = $this->Html->image(UP_ONE_DIR_LEVEL . PRODUCT_IMAGES_THUMB_SMALL_URL . $product['ProductImage']['filename'],
												      array('alt'=>$product['Product']['title'],
													    ));
									echo $this->Html->link($image, array('controller'=>'products',
													     'action'=>'view',
													     $product['Product']['id']),
													array('class'=>'itemlink',
													      'escape' => false));
									
									$itemViewUrl = array('controller'=>'products',
											     'action'=>'view',
											     $product['Product']['id']);
									
									?>
								
							</div>
							<div class="itemname">
								
								<?php echo $this->Html->link($product['Product']['title'], $itemViewUrl,
													array('class'=>'itemlink',
													      'escape' => false));
								?>
							</div>
							<div class="itemprice">
								<?php echo $this->Html->link($product['Product']['price'], $itemViewUrl,
													array('class'=>'itemlink',
													      'escape' => false));
								?>
							</div>
						</div>
						<div class="itemdescription">
							<p><?php echo $product['Product']['description']; ?></p>
						</div>
					</div>
					
				<?php endforeach; ?>

			</div>
				
			<div class="categorybottom">
			
				<div class="paging">
					<?php echo $this->Paginator->prev('<< '.__('previous'), array(), null, array('class'=>'disabled'));?>
				 | 	<?php echo $this->Paginator->numbers();?>
					<?php echo $this->Paginator->next(__('next').' >>', array(), null, array('class' => 'disabled'));?>
				</div>
				
				<!--				
				<table cellpadding="0" cellspacing="0">
					<tr>
						<td id="selected">1</td>
						<td><a href="#">2</a></td>
						<td><a href="#">3</a></td>
						<td><a href="#">4</a></td>
						<td><a href="#">5</a></td>
					</tr>
				</table>
				-->
					
				
			</div>
				
		</div>
			
	</div>
	<div id="cataloguebottom"></div>
	
	
	
<script type="text/javascript">//<![CDATA[

	var selectSort = $("#sortBySelect");
	
	var domainPagePath = '<?php echo Router::url('/products/index/', true); ?>';

	$(document).ready(function (){
		
		selectSort.change(function() {
			
			var valueOfSelectSort = selectSort.val();
			
			if (valueOfSelectSort == 'created') {
				window.location.href = domainPagePath + "sort:created/direction:desc";
			}
			
			if (valueOfSelectSort == 'price') {
				window.location.href = domainPagePath + "sort:price/direction:asc";
			}
			
			if (valueOfSelectSort == 'price-') {
				window.location.href = domainPagePath + "sort:price/direction:desc";
			}
		});
		
	});
	
	

//]]></script>