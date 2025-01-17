<h1>{{ product.title | escape }}</h1>
<!-- START SUMMARY -->
<div id="summary" class="clear">
	<!-- START IMAGES -->
	<div id="images">
		<!-- START IMAGE -->
		<div id="image" class="clear">
			<img src="{{ product.images[0] | product_img_url("large") }}" alt="{{ product.title | escape }}" />
		</div>
		<!-- END IMAGE -->
		<!-- START THUMBS -->
		<div id="thumbs">{% if product.images.size > 1 %}{% for image in product.images %}
			<p{% if forloop.first %} class="active"{% endif %}><a href="{{ image | product_img_url( "large") }}" rel="lightbox-images">{% if forloop.first %}More Images{% else %}{{ forloop.index }}{% endif %}</a></p>{% endfor %}{% endif %}
		</div>
		<!-- END THUMBS -->
	</div>
	<!-- END IMAGES -->
	<!-- START DETAILS -->
	<div id="details">
		<!-- START DESC -->
		<div id="desc">
			{{ product.description }}
		</div>
		<!-- END DESC -->
		<!-- START OPTIONS -->
		<div id="options">
			<form method="post" action="/cart/add">{% if product.variants.size > 1 %}
				<!-- START VARIANTS -->
				<div id="variants">
					<div class="border">
						<select name="id" id="id">{% for variant in product.variants %}{% if variant.available %}
							<option value="{{ variant.id }}">{{ variant.title | escape }} ({{ variant.price | money }})</option>{% else %}
							<option value="{{ variant.id }}" disabled="disabled">{{ variant.title | escape }} ({{ variant.price | money }}) - SOLD OUT</option>{% endif %}{% endfor %}
						</select>
					</div>
				</div>
				<!-- END VARIANTS -->{% else %}{% for variant in product.variants %}
				<input type="hidden" name="id" value="{{ variant.id }}" />{% endfor %}{% endif %}
				<!-- START BUY -->
				<div id="buy" class="clear">{% if product.available %}
					<h2 id="price"><span>{{ product.price | money }}</span>{% if product.compare_at_price_max > product.price %} <del>{{ product.compare_at_price_max | money }}</del>{% endif %}</h2>
					<input type="image" src="{{ "add.png" | asset_url }}" alt="BUY THIS" id="add" />{% else %}
					<h6>Sold Out</h6>{% endif %}
				</div>
				<!-- END BUY -->
			</form>
		</div>
		<!-- END OPTIONS -->
	</div>
	<!-- END DETAILS -->
</div>
<!-- END SUMMARY -->{% include "related" | snippets_url %}