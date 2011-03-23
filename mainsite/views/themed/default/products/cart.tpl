	<div id="cataloguetop"></div>	
	<div id="cataloguebody">
		
		<div id="checkouttop">
			<div id="cartupdate">
				
				{% set count = items|length %}
					
				{% if (count == 0) %}
                                        You have not selected any products. You should view our products <a href="/products">here</a>.
				
					
				{% elseif (count > 0) %}
						
					{{ form.create('Product', ['action':'edit_quantities_in_cart']) }}
					{{ form.submit('Refresh Cart', ['name':'btnRefresh','id':'cartbutton']) }}
						
				
			</div>
		</div>
		<table cellpadding="0" cellspacing="0">
			<tr id="headerbar">
				<td colspan="2" class="cartitemname">Item</td>
				<td class="cartquantity">Quantity</td>
				<td class="cartprice">Price</td>
				<td class="cartremove">X</td>
			</tr>
			{% set i = 0 %}
                        {% set paymentAmount = 0 %}
				
			{% for item in items %}
				{% set class = none %}
                                {% set i = i + 1 %}
				{% if (i is even) %}
                                        {% set class = ' class="evenCartLine"' %}
				{% else %}
					{% set class = ' class="oddCartLine"' %}
				{% endif %}
			
			<tr {{class}}>
				<td class="cartitemimg">
                                        <img src="{{ item.product.cover_image | product_img_url("small") }}" height="100" width="120" alt="{{item.title}}" />
					
				</td>
				
				<td class="cartitemname">
					<div class="itemtitle">
                                                
                                                {{ html.link( item.title, ['controller':'products','action':'view',item.product.id]) }}
						
					</div>
					<div class="itemstock">Item is in stock.</div>
					<div class="itemdesc">Proin mauris tortor, ultricies interdum posuere eu, placerat vitae orci.</div>
				</td>
				<td class="cartquantity">
					
					{{ form.text(['CartItem.',item.id,'.product_quantity']|join,['value':item.quantity,'maxlength':3,'class':'textbox'] ) }}
						
					{{ form.input(['CartItem.',item.id,'.id']|join, ['value':item.id,'type':'hidden'] ) }}
						
					<!-- calculate subtotal -->
					{% set paymentAmount = paymentAmount + (item.price * item.quantity) %}
					
				</td>
				<td class="cartprice">{{ item.price }}</td>
				<td class="cartremove">
					{{ html.link('R', ['controller':'products','action':'delete_from_cart','id':item.id,'cart_id':item.cart_id]) }}
					<a href="#"><span class="removeitem">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></a></td>
			</tr>
			
			{% endfor %}
			
			
			<tr id="amounttotal">
				<td class="cartitemimg">
				&nbsp;</td>
				<td class="cartitemname">
					&nbsp;</td>
				<td class="cartquantity">
				&nbsp;</td>
				<td class="cartprice">{{ paymentAmount }}</td>
				<td class="cartremove">&nbsp;</td>
			</tr>
		</table>
		
		
		
		<div id="checkout">
			<div id="cartupdate">
			{{ form.input('Cart.id', ['type':'hidden','value':cart.id]) }}
					
			{{ form.submit('Refresh Cart', ['name':'btnRefresh','id':'cartbutton']) }}
			{{ form.end() }}
				
                        <!-- end if not empty cart -->	
			{% endif %}
			
			</div>
			{% if (count > 0) %}
                                {{ form.create('Product', ['url':'/products/checkout']) }}
                                        <div id="cartcheckout">
                                                {{ form.submit('Checkout', ['name':'checkoutBtn', 'value':'proceed', 'id':'cartbutton']) }}
                                        </div>
					{{ form.hidden('products_count', ['value':count]) }}
	
					{% if paypalExpressOn %}
		
						<div id="cartpaypal">
						
						<input type="image" src="https://www.paypal.com/en_US/i/btn/btn_xpressCheckout.gif" name="checkout" value="paypalExpressCheckout" />
						
						</div>
				
					{% endif %}
				{{ form.end() }}
			{% endif %}
			
		</div>
	</div>
	<div id="cataloguebottom"></div>
