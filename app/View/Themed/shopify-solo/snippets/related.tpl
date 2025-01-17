{% if collections.related.products.size > 0 %}
<!-- START RELATED -->
<div id="related">
	<h6>{% if settings.related.size > 0 %}{{ settings.related | escape }}{% else %}Take a look at these great accessories:{% endif %}</h6>
	<!-- START SLIDER -->
	<div id="slider" class="clear">
		<!-- START PREV -->
		<div id="prev">
			<p><a href="/collections/all" class="inactive">Previous</a></p>
		</div>
		<!-- END PREV -->
		<!-- START WINDOW -->
		<div id="window">
			<ul class="clear">{% for product in collections.related.products %}
				<li>
					<div class="image clear">
						<a href="{{ product.url | within( collections.all) }}"><img src="{{ product.images[0] | product_img_url( "small" )}}" alt="{{ product.title | escape }}" /></a>
					</div>
					<h4><a href="{{ product.url | within( collections.all) }}">{{ product.title | escape }}</a></h4>
					<p>{{ product.price | money }}</p>
				</li>{% endfor %}
			</ul>
		</div>
		<!-- END WINDOW -->
		<!-- START NEXT -->
		<div id="next">
			<p><a href="/collections/all">Next</a></p>
		</div>
		<!-- END NEXT -->
	</div>
	<!-- END SLIDER -->
</div>
<!-- END RELATED -->{% else %}
<p id="unrelated"><a href="/admin/custom_collections">Create a collection</a> with the handle of <strong>related</strong> and add some products to it for them to be displayed here.</p>{% endif %}