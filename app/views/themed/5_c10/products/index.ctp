	<p>
		<?php
			echo $paginator->counter(array(
			'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
			));
		?>
	</p>
		
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
				<div id="resultsetbar"><div id="resultsettext">Showing 1 - 10 of 50 items.</div><div id="sortby">Sort By: 
					<select name="SortBy">
				<option>Sort By Option 1</option>
				<option>Sort By Option 2</option>
				<option>Sort By Option 3</option>
			</select></div></div>
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
								<a class="itemlink" href="catalogueitem.html">
									<?php
									echo $this->Html->image(UP_ONE_DIR_LEVEL . PRODUCT_IMAGES_THUMB_SMALL_URL . $product['ProductImage']['filename'],
												      array('alt'=>$product['Product']['title']));
									?>
								</a>
							</div>
							<div class="itemname"><a class="itemlink" href="catalogueitem.html"><?php echo $product['Product']['title']; ?></a></div>
							<div class="itemprice"><a class="itemlink" href="catalogueitem.html"><?php echo $product['Product']['price']; ?></a></div>
						</div>
						<div class="itemdescription">
							<p><?php echo $product['Product']['description']; ?></p>
						</div>
					</div>
					
				<?php endforeach; ?>

			</div>
				
			<div class="categorybottom">
			
				<div class="paging">
					<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
				 | 	<?php echo $paginator->numbers();?>
					<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class' => 'disabled'));?>
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