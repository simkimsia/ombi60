{{ html.script('http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js') }}

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
				<div id="resultsetbar"><div id="resultsettext">
                        {{ paginator.counter(['format':'Showing %start% - %end% of %count% items', true]) }}
                </div>
					
		{% set optionSelected = 'created' %}
		
			
		{% if sort == 'price'and order == 'asc' %}
			{% set optionSelected = 'price' %}
		{% endif %}
			
		{% if sort == 'price'and order == 'desc' %}
			{% set optionSelected = 'price-' %}
		{% endif %}
			
		
					
		<div id="sortby">Sort By: 
			<select name="SortBy" id="sortBySelect">
				<option value="created" {% if optionSelected == 'created' %} selected {% endif %}>Date: Latest</option>
				<option value="price" {% if optionSelected == 'price' %} selected {% endif %}>Price: Low to High</option>
				<option value="price-" {% if optionSelected == 'price-' %} selected {% endif %}>Price: High to Low</option>
			</select>
		</div>
	</div>
				{% set i = 0 %}
					
                                {% for product in products %}
					
					{% set class = none %}
                                        {% set i = i + 1 %}
                                        {% if i is even %}
                                                {% set class = ' class="altrow"' %}
                                        {% endif %}
				
				
					<div class="contentitem">
						<div class="contentleftbar">
							<div class="itemimage">
								
								<a href="/products/view/{{product.id}}" class="itemlink" ><img src="{{ product.cover_image | product_img_url("small") }}" alt="{{ product.title }}" /></a>
								
								
							</div>
							<div class="itemname">
								
								<a href="/products/view/{{product.id}}" class="itemlink" >{{product.title}}</a>
							</div>
							<div class="itemprice">
								<a href="/products/view/{{product.id}}" class="itemlink" >{{ product.price | money_with_currency }}</a>
							</div>
						</div>
						<div class="itemdescription">
							<p>{{product.description}}</p>
						</div>
					</div>
					
				{% endfor %}

			</div>
				
			<div class="categorybottom">
			
				<div class="paging">
					{{ paginator.prev(['<< ','previous']|join, [], none, ['class':'disabled']) }}
				 | 	{{ paginator.numbers() }}
					{{ paginator.next(['next',' >>']|join, [], none, ['class':'disabled']) }}
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
	
	var domainPagePath = '{{ domainPagePath }}';

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