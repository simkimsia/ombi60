<?php
	echo $this->Html->script('http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js');
	echo $this->Html->script('jquery/jquery.tools-1.2.ui-full.min');
?>
	<div id="cataloguetop"></div>
	<div id="cataloguebody">
		
		<div id="sidebar">
			<div class="barcategory" id="selectedbarcategory">
				<a href="catalogue.html" id="selectedCategory">Category 1</a></div>
				<div class="baritem"><a href="catalogueitem.html">Item 1</a></div>
				<div class="baritem" id="selectedbaritem">Item 2</div>
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
				<div class="contentcategory"><?php echo $product['title']; ?></div>
										
					<div class="contentitem">
						<div class="scroll">
							<div class="pics">
								<?php
	
									foreach($product['images'] as $key => $image){
										echo $this->Html->image(UP_ONE_DIR_LEVEL . PRODUCT_IMAGES_THUMB_LARGE_URL . $image,
													array('id'=>'full_'.$key));
									}
								?>
							</div>
						</div>
						
						
						<!-- HTML structures -->
						<div class="minimg">

						<?php
							$limit = 5;
							$count = count($product['images']);
							
							$leftRightButtonsNeeded = $count > $limit;
							$shortenScrollableLength = ($count > 0 AND $count < $limit);
							$hideScrollable = ($count == 0);
						
							if ($count > 0) {
								echo '<!-- "previous page" action -->';
								echo '<a class="prevNav browse left"></a>';	
							}
							
							
							$style = '';
							if ($shortenScrollableLength) {
								$offset = $count - 1;
								$expectedLengthOfScrollableDiv = $count * 150 - ($offset * 18);
								$style = 'style="width:' . $expectedLengthOfScrollableDiv . 'px"';
							}
							
							$style='style="width:300px"';
							
							if ($hideScrollable) {
								$style = 'style="display:none"';
							}
							
							
						?>
						
						
						<?php
							
									     
							if ($count > 0) {
								echo '
							<!-- root element for scrollable -->
							<div class="scrollable" ' . $style . '  >';
								echo '
								<!-- root element for the items -->
								<div class="items">';
						
					
							}
						
					
							foreach ($product['ProductImages'] as $key => $image) {
								
								echo '<div>';
				
								echo $this->Html->image(UP_ONE_DIR_LEVEL . PRODUCT_IMAGES_THUMB_SMALL_URL . $image['ProductImage']['filename'],
											array('id'=>'small_'.$key));
				
								echo '</div>';
									
					
							}
							
							if ($count > 0) {
								echo '
								</div>';
								
								echo '
							</div>';
							
								echo '<!-- "next page" action -->';
								echo '<a class="nextNav browse right"></a>';	
					
							}
					
						
						?>

						</div>
						
						<div class="itempayment">
							<div class="instock">Always in stock.</div>
		
							<?php
	
								echo $this->Form->create('Product',
											 array('url' => array('action' => 'add_to_cart',
													      'controller' => 'products',
													      'product_id' => $product['id'])
											));
								
								echo $this->element('products_dropdown_quantity',
										    array('maximumQuantity' => 30,
											  'inputName' => 'quantity'));
								
								echo $this->Form->submit('Add To Cart', array('div'=>false));
								
								echo $this->Form->end();
							?>
							
						</div>
						

						<div class="detaileddescription">
							<?php echo $product['Product']['description']; ?>
						</div>
					</div>
					
				</div>
				
				<div class="categorybottom">					
				
					<div id="itemback"><a href="catalogueitem.html">&lt; Previous Item</a></div>
					<a href="catalogue.html">Back to Category 1</a>
					<div id="itemforward"><a href="catalogueitem3.html">Next Item &gt;</a></div>
				</div>
				
			</div>
			
	</div>
	<div id="cataloguebottom"></div>
	
	
<script type="text/javascript">//<![CDATA[

	var limit = <?php echo $limit; ?>;

	var navi = $(".scrollable").scrollable({

					prev: ".prevNav",
					next: ".nextNav",
					keyboard: false,

				    });

	// highlight the given thumb object in the navigation scrollable
	function makeThisThumbActive(thumb) {
		$(".items img").removeClass("active");
		thumb.addClass("active");
	}

	// move the navigation scrollable forward or backward depending on new image displayed in mainScrollable
	function moveNaviScroll(newIndexOfImage) {

		var page = navi.data("scrollable").getIndex();

		var remainder = newIndexOfImage % limit;
		var newPage = ( newIndexOfImage - remainder ) / limit;

		if (page != newPage) {
			navi.data("scrollable").seekTo(newPage, 0);
		}
	}

	// enable scrollables with a click handler
	var mainScrollable = $(".scroll").scrollable({

					// enable it to be scrollable
					circular: true,

					// onSeek is fired AFTER item is scrolled
					onSeek: function(event, i) {
						// find out the current image index of the scrollable
						var currentImageIndex = i;
						var idOfThumbToActivate = "#small_" + currentImageIndex;
						makeThisThumbActive($(idOfThumbToActivate));
						moveNaviScroll(currentImageIndex);

					},

					keyboard: 'static',

				// enable the scrollable with a click handler
				}).click(function() {

					// rotate the circular scrollable when click event is fired
					$(this).data("scrollable").next();


	});




	$(".items img").click(function() {

		// see if same thumb is being clicked
		if ($(this).hasClass("active")) { return; }


		// activate item
		makeThisThumbActive($(this));

		// move the mainScrollable to reflect the correct image
		moveMainImage();


	// when page loads simulate a "click" on the first image
	}).filter(":first").addClass("active");

	// retrieve current active thumb in navigation scrollable
	function getIndexOfNaviScroll() {
		var imageId = $(".items img").filter(".active").attr("id");
		return +imageId.replace("small_", "");
	}


	function moveMainImage() {
		var newIndex = getIndexOfNaviScroll();
		mainScrollable.data("scrollable").seekTo(newIndex, 0);
	}


//]]></script>
