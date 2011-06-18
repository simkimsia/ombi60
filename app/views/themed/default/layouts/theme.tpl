<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=iso-8859-1" http-equiv="Content-Type" />
<title>
    
	{% set companyName = '' %}
		
	{% if (shopName_for_layout is defined) %}
		{{ shopName_for_layout }}
		{% set companyName = shopName_for_layout %}
	{% endif %}
	{% if ( (shopName_for_layout is defined) and (title_for_layout is defined)) %}
		{{ ' - ' }}
	{% endif %}
	{% if ((title_for_layout is defined)) %}
		{{ title_for_layout }}
	{% endif %}
</title>
	{{ html.meta('icon') }}
        
        {{ html.css('style') }}
        
        {{ html.css('spree2shop.jquery.tools') }}
		
	{{ scripts_for_layout }}
</head>

<body>
	
<div id="overallContainer" class="{% if ((classForContainer is defined)) %} {{classForContainer}} {% endif %}">
	<div id="header">
		<div id="headerContent">
			<h1><a href="#"><span>Service Name</span></a></h1>
			<h2>Username <input name="txtUsername" type="text" /> Password <input name="txtUsername" type="password" /></h2>
		</div>
	</div>

	<div id="menu">
		<ul id="menuItems">
			
			
			
			<!-- there is a class called selectedMenuItem. to be added later -->
			
			
			{% for key, link in linklists.main_menu.links %}
				{% set class = '' %}
				{% if (loop.first) %}
					{% set class = ' class="home"' %}
				{% endif %}
				<li {{class}} >{{ html.link(link.title, link.url) }}
				
				<!-- cater for the badge in cart -->
				{% if ('/cart/view' in link.url)  %}
					{% if (cartItemsCount > 0) %}
					<div id="cartbadge">{{ cartItemsCount }}</div>
					{% endif %}
					
				{% endif %}
				
				</li>
				
				
		
			{% endfor %}
			
			
			
			
			
		</ul>
	</div>
	
	<div id="contentInOverallContainer" class="{% if ((classForContentContainer is defined)) %} {{ classForContentContainer }} {% endif %}">
	{% if ( (content_for_layout is defined)) %}
		{{ session.flash() }}
                {{ content_for_layout }}
        {% endif %}
	</div>

	<div id="footer">
		Copyright &copy; {{ companyName }} {{ "now"|date("Y") }}<br />
		
                
			
		{% for key, link in linklists.footer_menu.links %}
				
			{{ html.link(link.title, link.url) }}
				
			{% if ( not (loop.last)) %}
				{{ ' | ' }}
			{% endif %}
			
		{% endfor %}
	
		
	</div>
</div>
</body>

</html>
