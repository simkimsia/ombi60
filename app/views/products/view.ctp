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
				<div class="contentcategory">Item 2</div>
										
					<div class="contentitem">
						<div class="scroll">
							<div class="pictureframe pics">
								<?php
	
									foreach($product['ProductImages'] as $key => $image){
										echo $this->Html->image(UP_ONE_DIR_LEVEL . PRODUCT_IMAGES_THUMB_LARGE_URL . $image['ProductImage']['filename'],
													array('id'=>'full_'.$key));
									}
								?>
							</div>
						</div>
						
						
						<!-- HTML structures -->


						<?php
							$limit = 5;
							$count = count($product['ProductImages']);
							
							$leftRightButtonsNeeded = $count > $limit;
							$shortenScrollableLength = ($count > 0 AND $count < $limit);
							$hideScrollable = ($count == 0);
						
					
							echo '<!-- "previous page" action -->';
						
							if ($leftRightButtonsNeeded){
								echo '<a class="prevNav browse left"></a>';	
							}
							
							$style = '';
							if ($shortenScrollableLength) {
								$offset = $count - 1;
								$expectedLengthOfScrollableDiv = $count * 150 - ($offset * 18);
								$style = 'style="width:' . $expectedLengthOfScrollableDiv . 'px"';
							}
							
							if ($hideScrollable) {
								$style = 'style="display:none"';
							}
							
							
						?>
						
					
						<!-- root element for scrollable -->
						<div class="scrollable" <?php  echo $style; ?> >
					
						   <!-- root element for the items -->
						   <div class="items">
					
					
					
							<?php
								
					
								foreach ($product['ProductImages'] as $key => $image) {
									if ($key % $limit == 0) {
										echo '<div>';
									}
					
									echo $this->Html->image(UP_ONE_DIR_LEVEL . PRODUCT_IMAGES_THUMB_SMALL_URL . $image['ProductImage']['filename'],
												array('id'=>'small_'.$key));
					
									if (($key % $limit == 4) OR ($key == $count - 1)) {
										echo '</div>';
									}
					
								}
					
							?>
					
					
						   </div>
					
						</div>
					
						<?php
							if ($leftRightButtonsNeeded) {
								echo '<!-- "next page" action -->';
								echo '<a class="nextNav browse right"></a>';	
							}
							
						?>

						
						
						<div class="itempayment">
							<div class="instock">Always in stock.</div>
		
							<?php
	
								echo $this->Form->create('Product',
											 array('url' => array('action' => 'add_to_cart',
													      'controller' => 'products',
													      'product_id' => $product['Product']['id'])
											));
								
								echo $this->element('products_dropdown_quantity',
										    array('maximumQuantity' => 30,
											  'inputName' => 'quantity'));
								
								echo $this->Form->submit('Add To Cart', array('div'=>false));
								
								echo $this->Form->end();
							?>
							
						</div>
						

						<div class="detaileddescription">Proin mauris tortor, 
							ultricies interdum posuere eu, placerat vitae orci. 
							Duis non laoreet libero. Suspendisse aliquam congue 
							metus non elementum. Cras quis bibendum lorem. 
							Quisque cursus aliquam mattis. Sed id orci tortor. 
							Suspendisse potenti. Nulla luctus interdum massa in 
							malesuada. Fusce mi magna, gravida a pretium quis, 
							ultrices vel orci. <a href="#">Nullam sollicitudin</a> 
							nibh ac dolor tempor porttitor. Curabitur id lacus 
							vitae ipsum rhoncus varius. Class aptent taciti 
							sociosqu ad litora torquent per conubia nostra, per 
							inceptos himenaeos. Nunc pharetra eros et dui 
							adipiscing ultrices. Nunc eros lectus, bibendum eu 
							consequat id, <a href="#">cursus non quam</a>. Nam 
							vel dolor dolor. Pellentesque ante tortor, mattis 
							auctor condimentum ut, convallis a dui. Mauris 
							scelerisque dapibus libero, vitae facilisis tellus 
							mattis a. Pellentesque metus nulla, tristique at 
							venenatis et, egestas a diam.
						</div>
					</div>
					
				</div>
				
				<div class="categorybottom">					
				
					<div id="itemback"><a href="catalogueitem.html">&lt; Previous Item</a></div> <a href="catalogue.html">Back to Category 1</a> <div id="itemforward"><a href="catalogueitem3.html">Next Item &gt;</a></div></div>
				
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
