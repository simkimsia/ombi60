<!-- START SHOWCASE -->
<div id="showcase">
{% if collections.frontpage.products| length > 0 %}
	{% for product in collections.frontpage.products %}
	<h1>{{ product.title | escape }}</h1>
	<div id="image" class="clear">
		<a href="{{ product.url | within( collections.all ) }}"><img src="{{ product.images[0] | product_img_url( "large") }}" alt="{{ product.title | escape }}" /></a>
	</div>
	<h3>Index</h3>
	<div id="buy" class="clear">
		<div id="button">
			<p><a href="{{ product.url | within( collections.all) }}">BUY THIS</a></p>
		</div>
		<h2>{{ product.price | money }}</h2>
	</div>{% endfor %}
{% endif %}
</div>
<!-- END SHOWCASE -->{% include "related" | snippets_url %}
