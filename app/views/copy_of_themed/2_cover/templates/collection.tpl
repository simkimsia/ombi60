<!-- START EXCERPT -->
<div id="excerpt">
	<h1 class="title">{{ collection.title | escape }}</h1>{% if collection.description.size > 0 %}
	{{ collection.description }}{% endif %}
</div>
<!-- END EXCERPT -->
<!-- START PRODUCTS -->{% if collection.products|length > 0 %}
<ul id="products" class="clear">{% for key, product in slice(collection.products,2,1) %}
	<!-- START PRODUCT {{ forloop.index }} -->
	<li{{ cycle (['', '', ' class="end"'], key) }}>
		
		<!-- START IMAGE -->
		<div class="image">
			<div class="align">
				<div><a href="{{ product.url | within( collection) }}"><img src="{{ product.images[0] | product_img_url( "medium" )}}" alt="{{ product.title | escape }}" /></a></div>
			</div>
		</div>
		<!-- END IMAGE -->
		<h3><a href="{{ product.url | within( collection) }}">{{ product.title | escape | truncate( 25) }}</a></h3>
		<p>{{ product.price | money }}{% if product.compare_at_price_max > product.price %} <del>{{ product.compare_at_price_max | money }}</del>{% endif %}</p>
	</li>
	<!-- END PRODUCT {{ forloop.index }} -->{% endfor %}
</ul>{% else %}
<p id="empty">There are no products in this collection.</p>{% endif %}
<!-- END PRODUCTS -->