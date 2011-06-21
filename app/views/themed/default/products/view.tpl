{{ html.script('http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js') }}
{{ html.script('jquery/jquery.tools-1.2.ui-full.min') }}
	
	<div id="cataloguetop"></div>
	<div id="cataloguebody">
		
		<div id="sidebar">
			<div class="barcategory" id="selectedbarcategory">
				<a href="catalogue.html" id="selectedCategory">Category 1</a>
			</div>
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
				<div class="contentcategory">
					{{ product.title }} - {{ product.price | money_with_currency }}
				</div>
										
				<div class="contentitem">
					<div class="scroll">
						<div class="pics">
							{% for key, image in product.images %}

								<img src="{{ image | product_img_url("large") }}" id="full_{{ key }}" />
								
								
							{% endfor %}
						</div>
					</div>
					
					<!-- HTML structures -->
					<div class="minimg">
						
					{% set limit = 5 %}
							
					{% set imagesCount = product.images | length %}
					
					{% set leftRightButtonsNeeded = imagesCount > limit %}
					
					{% set shortenScrollableLength = (imagesCount > 0 and imagesCount < limit) %}
					
					{% set hideScrollable = (imagesCount == 0) %}

					{% if imagesCount > 0 %}
						<!-- "previous page" action -->
						<a class="prevNav browse left"></a>
						
					{% endif %}
					
					{% set style = '' %}
					
					{% if shortenScrollableLength %}
					
						{% set offset = imagesCount - 1 %}
						{% set expectedLengthOfScrollableDiv = imagesCount * 150 - (offset * 18) %}
						{% set style = ['style="width:',expectedLengthOfScrollableDiv,'px"'] | join %}
						
					{% endif %}
							
					{% set style='style="width:300px"' %}
							
					{% if hideScrollable %}
						{% set style = 'style="display:none"' %}
					{% endif %}
							
					
					{% if imagesCount > 0 %}
						<!-- root element for scrollable -->
						<div class="scrollable"  {{ style }}>
							
							<!-- root element for the items -->
							<div class="items">
					
					{% endif %}
					
					{% for key, image in  product.images %}
						
								<div>
									<img src="{{ image | product_img_url("small") }}" id="small_{{ key }}" />
		
								</div>
					{% endfor %}
					
					{% if imagesCount > 0 %}
				
							</div>
							
						</div>
						
						<!-- "next page" action -->
						<a class="nextNav browse right"></a>
					{% endif %}
	
					</div>
						
				
					<div class="itempayment">
						<div class="instock">Always in stock.</div>
						
						
						<form action="/cart/add" method="post">
						<!-- Starting to render - products_dropdown_quantity -->
						{% set qtyArray = [1:1, 2:2, 3:3, 4:4, 5:5] %}
						
						
							<input type="hidden" name="id" value="{{ product.variants.0.id }}" />
						
							<select name="quantity">
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
							</select>
						<!-- Finished - products_dropdown_quantity -->
							
						
							<input type="submit" value="Add To Cart" />
						
						</form>
		
					</div>
	
					<div class="detaileddescription">
						{{ product.description }}
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

	var limit = 5;

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
