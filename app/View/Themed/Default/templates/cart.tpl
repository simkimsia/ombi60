<h1>My Cart</h1>{% if cart.item_count > 0 %}
<form action="/cart" method="post" name="cartform">
	<!-- START TABLE -->
	<table cellpadding="0" cellspacing="0">
		<!-- START HEADERS -->
		<tr>
			<th colspan="2" class="start">Description</th>
			<th>Price</th>
			<th>Quantity</th>
			<th>Delete</th>
			<th>Total</th>
		</tr>
		<!-- END HEADERS -->
		{% for key, item in cart.items %}
		<!-- START PRODUCT {{ forloop.index }} -->
		<tr class="{{ cycle (['odd', 'even'], key) }}">
			<td class="pic">
				<div><a href="{{ item.product.url | within(collections.all) }}"><img src="{{ item.product.images[0] | product_img_url( "thumb") }}" alt="{{ item.title | escape }}" /></a></div>
			</td>
			<td class="title">
				<h3><a href="{{ item.product.url | within( collections.all) }}">{{ item.title | escape }}</a></h3>
			</td>
			<td>{{ item.price | money }}</td>
			<td><input type="text" class="field" name="updates[]" id="updates_{{ item.variant.id }}" value="{{ item.quantity }}" /></td>
			<td class="remove"><a href="/cart/change/{{ item.variant.id }}?quantity=0">Remove</a></td>
			<td><strong>{{ item.line_price | money }}</strong></td>
		</tr>
		<!-- END PRODUCT {{ forloop.index }} -->
		{% endfor %}
	</table>
	<!-- END TABLE -->
	<!-- START COMPLETE -->
	<div id="complete" class="clear">{% if settings.notes| length > 0 %}
		<!-- START NOTES -->
		<div id="notes">
			<label for="note">{% if settings.notes| length > 0 %}{{ settings.notes | escape }}{% else %}Tell us about any special instructions{% endif %}</label>
			<textarea name="note" id="note" rows="" cols="">{{ cart.note }}</textarea>
		</div>
		<!-- END NOTES -->{% endif %}
		<!-- START TOTAL -->
		<div id="total">
			<h3>Total <span>{{ cart.total_price | money }}</span></h3>
			<!-- START CHECKOUT -->
			<div id="checkout" class="clear">
				<input type="image" src="{{ "checkout.png" | asset_url }}" alt="CHECKOUT" name="checkout" class="checkout" />
				<input type="image" src="{{ "update.png" | asset_url }}" alt="UPDATE" name="update" class="update" />
			</div>
			<!-- END CHECKOUT -->
		</div>
		<!-- END TOTAL -->
	</div>
	<!-- END COMPLETE -->
</form>{% else %}
<p id="empty">Your shopping cart is empty. <a href="/collections/all">Continue shopping...</a></p>{% endif %}