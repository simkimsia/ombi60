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
			{% if ( (mainMenu.Link is defined)) %}
                                {% set count = 0 %}
				{% for key, link in mainMenu.Link %}
					{% set class = '' %}
					{% if (count == 0) %}
						{% set class = ' class="home"' %}
					{% endif %}
                                        <li {{class}} >{{ html.link(link.name, link.route) }}
                                        
					<!-- cater for the badge in cart -->
					{% if ('/cart' in link.route)  %}
						{% if (cartItemsCount > 0) %}
                                                <div id="cartbadge">{{ cartItemsCount }}</div>
						{% endif %}
						
					{% endif %}
					
					</li>
					
					
					
					{% set count = count + 1 %}
			
				{% endfor %}
			{% endif %}
			
			
			
			
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
		{% if ( (footerMenu.Link is defined)) %}
                        {% set totalFooterLinksCount = footerMenu.Link | length %}
			{% set count = 1 %}
			{% for key, link in footerMenu.Link %}
					
				{{ html.link(link.name, link.route) }}
					
				{% if ( count < totalFooterLinksCount) %}
					{{ ' | ' }}
				{% endif %}
				{% set count = count + 1 %}
			{% endfor %}
		{% endif %}
		
	</div>
</div>
</body>

</html>
