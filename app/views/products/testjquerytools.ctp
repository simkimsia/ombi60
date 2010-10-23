<?php
	echo $this->Html->script('http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js');
	echo $this->Html->script('jquery/jquery.tools-1.2.ui-full.min');

?>



	<div class="scroll">
		<div class="pics">

			<img src="http://farm1.static.flickr.com/143/321464099_a7cfcb95cf.jpg" id="full_0" />
			<img src="http://farm4.static.flickr.com/3089/2796719087_c3ee89a730.jpg" id="full_1" />
			<img src="http://farm1.static.flickr.com/79/244441862_08ec9b6b49.jpg" id="full_2" />
			<img src="http://farm1.static.flickr.com/28/66523124_b468cf4978.jpg" id="full_3" />
			<img src="http://farm1.static.flickr.com/164/399223606_b875ddf797.jpg" id="full_4" />



			<img src="http://farm1.static.flickr.com/163/399223609_db47d35b7c.jpg" id="full_5"/>
			<img src="http://farm1.static.flickr.com/135/321464104_c010dbf34c.jpg" id="full_6" />
			<img src="http://farm1.static.flickr.com/40/117346184_9760f3aabc.jpg" id="full_7" />
			<img src="http://farm1.static.flickr.com/153/399232237_6928a527c1.jpg" id="full_8" />

			<img src="http://farm1.static.flickr.com/50/117346182_1fded507fa.jpg" id="full_9" />

			<img src="http://farm4.static.flickr.com/3629/3323896446_3b87a8bf75.jpg" id="full_10" />
			<img src="http://farm4.static.flickr.com/3023/3323897466_e61624f6de.jpg" id="full_11" />
			<img src="http://farm4.static.flickr.com/3650/3323058611_d35c894fab.jpg" id="full_12" />
			<img src="http://farm4.static.flickr.com/3635/3323893254_3183671257.jpg" id="full_13" />
			<img src="http://farm4.static.flickr.com/3624/3323893148_8318838fbd.jpg" id="full_14" />




		</div>

	</div>




	<!-- HTML structures -->


	<!-- "previous page" action -->

	<a class="prevNav browse left"></a>


	<!-- root element for scrollable -->
	<div class="scrollable">

	   <!-- root element for the items -->
	   <div class="items">



		<?php
			$limit = 5;
		?>
			<div>
				<img src="http://farm1.static.flickr.com/143/321464099_a7cfcb95cf_t.jpg" id="small_0" />
				<img src="http://farm4.static.flickr.com/3089/2796719087_c3ee89a730_t.jpg" id="small_1" />
				<img src="http://farm1.static.flickr.com/79/244441862_08ec9b6b49_t.jpg" id="small_2" />

				<img src="http://farm1.static.flickr.com/28/66523124_b468cf4978_t.jpg" id="small_3" />
				<img src="http://farm1.static.flickr.com/164/399223606_b875ddf797_t.jpg" id="small_4" />
			</div>

			<!-- 5-10 -->
			<div>
				<img src="http://farm1.static.flickr.com/163/399223609_db47d35b7c_t.jpg" id="small_5" />
				<img src="http://farm1.static.flickr.com/135/321464104_c010dbf34c_t.jpg" id="small_6" />
				<img src="http://farm1.static.flickr.com/40/117346184_9760f3aabc_t.jpg" id="small_7" />
				<img src="http://farm1.static.flickr.com/153/399232237_6928a527c1_t.jpg" id="small_8" />

				<img src="http://farm1.static.flickr.com/50/117346182_1fded507fa_t.jpg" id="small_9" />
			</div>

			<!-- 10-15 -->
			<div>
				<img src="http://farm4.static.flickr.com/3629/3323896446_3b87a8bf75_t.jpg" id="small_10" />
				<img src="http://farm4.static.flickr.com/3023/3323897466_e61624f6de_t.jpg" id="small_11" />
				<img src="http://farm4.static.flickr.com/3650/3323058611_d35c894fab_t.jpg" id="small_12" />
				<img src="http://farm4.static.flickr.com/3635/3323893254_3183671257_t.jpg" id="small_13" />
				<img src="http://farm4.static.flickr.com/3624/3323893148_8318838fbd_t.jpg" id="small_14" />

			</div>



	   </div>

	</div>

	<!-- "next page" action -->
	<a class="nextNav browse right"></a>




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
		var newPage = newIndexOfImage / limit;
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

		
					alert($(this).data("scrollable").getIndex());

					// rotate the circular scrollable when click event is fired
					$(this).data("scrollable").next();
					alert($(this).data("scrollable").getIndex());

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
		return imageId.replace("small_", "");
	}


	function moveMainImage() {
		var newIndex = getIndexOfNaviScroll();
		mainScrollable.data("scrollable").seekTo(newIndex, 0);

	}


//]]></script>
