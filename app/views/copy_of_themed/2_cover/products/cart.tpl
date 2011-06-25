	<div id="cataloguetop"></div>	
	<div id="cataloguebody">
		
		<div id="checkouttop">
			<div id="cartupdate">
				
				{% set count = cart.items|length %}
					
				{% if (count == 0) %}
                                        You have not selected any products. You should view our products <a href="/products">here</a>.
				
					
				{% elseif (count > 0) %}
						
					<form action="/cart" method="post">
					<input type="submit" id="cartbutton" name="update" value="Refresh Cart" />
						
				
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
				
			{% for item in cart.items %}
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
					
					<input type="text" class="textbox" name="updates[]" maxlength="3" value="{{ item.quantity }}" />
						
					
						
					<!-- calculate subtotal -->
					{% set paymentAmount = paymentAmount + (item.price * item.quantity) %}
					
				</td>
				<td class="cartprice">{{ item.price }}</td>
				<td class="cartremove">
					<a href="/cart/change/{{item.variants.id}}?quantity=0" >R</a>
					
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
			
				<input type="submit" id="cartbutton" name="update" value="Refresh Cart" />
			
			</form>
				
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
