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
						<div class="pictureframe">
							<img alt="Item Image" src="user_generated_content/images/itemmainimage.png" />
						</div>
						<div class="itempayment">
							<div class="instock">Always in stock.</div>
							<form method="post">
								Specify amount:
								<input name="amount" class="textbox" type="text" maxlength="3" /> 
								<a href="#">[ Add To Cart ]</a>
							</form>
						</div>
						<div class="pictureselection">
							<div class="imgwrapper">
								<span class="imgholder"><img id="selecteditemimage" alt="Image Thumbnail" height="152" src="user_generated_content/images/sidethumbnail1.png" width="242" /></span>
								<span class="imgholder"><img alt="Image Thumbnail" height="152" src="user_generated_content/images/sidethumbnail3.png" width="242" /></span>
								<span class="imgholder"><img alt="Image Thumbnail" height="152" src="user_generated_content/images/sidethumbnail2.png" width="242" /></span>
							</div>
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
	
	