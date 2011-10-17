<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">

<head>
	<title>{{ shop.name | escape }} &mdash; {% if template == "404" %}Page Not Found{% else %}{{ page_title | escape }}{% endif %}</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="copyright" content="{{ shop.name | escape }}" />
	{{ content_for_header }}
	{{ "reset.css" | asset_url | css_tag }}
	{{ "screen.css" | asset_url | css_tag }}
	{{ "theme.css" | asset_url | css_tag }}
	<!--[if lte IE 6]>{{ "ie6.css" | asset_url | css_tag }}<![endif]-->{% if template == "product" %}{% if product.available %}{% if product.variants.size > 1 %}
	{{ "option_selection.js" | asset_url | script_tag }}{% endif %}{% endif %}{% endif %}
	{{ "jquery-1-3-1.js" | asset_url | script_tag }}
	{{ "jquery-ui-1-7-1.js" | asset_url | script_tag }}{% if template == "product" %}
	{{ "jquery-slimbox-2-02.js" | asset_url | script_tag }}{% endif %}
	{{ "jquery-theme-1-0.js" | asset_url | script_tag }}
</head>

<body>
	<!-- START CONTAINER -->
	<div id="container">
		<!-- START HEADER -->
		<div id="header" class="clear">
			<!-- START LOGO -->{% if settings.logo == "enabled" %}
			<div id="logo">
				<a href="/"><img src="{{ "logo.png" | asset_url }}" alt="{{ shop.name | escape }}" /></a>
			</div>{% else %}
			<h2><a href="/">{{ shop.name | escape }}</a></h2>{% endif %}
			<!-- END LOGO -->{% if settings.phone.size > 0 or settings.email.size > 0 %}
			<!-- START HELLO -->
			<div id="hello">
				<div>{% if settings.phone.size > 0 %}
					<p><strong>t:</strong> {{ settings.phone | escape }}</p>{% endif %}{% if settings.email.size > 0 %}
					<p><strong>e:</strong> <a href="mailto:{{ settings.email }}">{{ settings.email | escape }}</a></p>{% endif %}
				</div>
			</div>
			<!-- END HELLO -->{% endif %}
		</div>
		<!-- END HEADER -->
		<!-- START NAVIGATE -->
		<div id="navigate">
			<!-- START NAV -->
			<div id="nav">&nbsp;</div>
			<!-- START LINKS -->{% set active_url %}{% if template == "index" %}/{% elseif template == "collection" %}/collections/{{ collection.handle }}{% elseif template == "product" %}{% if collection %}/collections/{{ collection.handle }}{% endif %}/products/{{ product.handle }}{% elseif template == "page" %}/pages/{{ page.handle }}{% elseif template == "blog" %}/blogs/{{ blog.handle }}{% elseif template == "cart" %}/cart{% elseif template == "search" %}/search{% endif %}{% endset %}
			<ul id="links">{% for link in linklists.main_menu.links %}
				<li class="link-{{ forloop.index }}"><a href="{{ link.url }}"{% if link.url == active_url %} class="active"{% endif %}>{{ link.title | escape }}</a></li>{% endfor %}
			</ul>
			<!-- END LINKS -->
			<!-- START GOCART -->
			<div id="gocart">
				<p><a href="/cart"{% if template == "cart" %} class="active"{% endif %}>{{ cart.item_count | pluralize( "Item", "Items") }}</a></p>
			</div>
			<!-- END GOCART -->
			<!-- END NAV -->
		</div>
		<!-- END NAVIGATE -->
		<!-- START CONTENT -->
		<div id="shadow">&nbsp;</div>
		<div id="{% if template == "404" %}missing{% else %}{{ template }}{% endif %}" class="content">
			<!-- START BG -->
			<div id="bg" class="clear">{% if template == "page" or template == "blog" or template == "article" %}
				<h1 class="title">{{ page.title | escape }}{{ blog.title | escape }}</h1>
				<!-- START MAIN -->
				<div id="main">
					{{ content_for_layout }}
				</div>
				<!-- END MAIN -->
				<!-- START SIDEBAR -->
				<div id="sidebar">
					<h3>Recent Articles</h3>
						{% if template == "page" %}
							{% set blog_handle ='news' %}
						{% else %}
							{% set blog_handle = blog.handle %}
						{% endif %}
						
						{% if ((blogs[blog_handle].articles | length) > 0) %}
							{% for article in blogs.news.articles %}
					<!-- START POST {{ forloop.index }} -->
					<div class="post{% if forloop.last %} end{% endif %}">
						<h5><a href="{{ article.url }}">{{ article.title | escape }}</a></h5>
						<p>{{ article.content | strip_html | strip_newlines | truncate( 80) }}</p>
					</div>
					<!-- END POST {{ forloop.index }} -->{% endfor %}{% else %}
					<p>No articles.</p>{% endif %}
					<p id="feed"><a href="{{ shop.url }}/blogs/{{ blog_handle }}.atom">{{ blog.title | escape }} Feed Subscription</a></p>
				</div>
				<!-- END SIDEBAR -->{% else %}
				{{ content_for_layout }}{% endif %}
			</div>
			<!-- END BG -->
		</div>
		<div id="roundup">&nbsp;</div>
		<!-- END CONTENT -->
		<!-- START OVERVIEW -->
		<div id="overview">
			<ul class="clear">
				<li>
					<h3>{{ pages.frontpage.title | escape }}</h3>
					<p>{{ pages.frontpage.content | strip_html | strip_newlines | truncate( 200 )}}</p>
					<p><a href="/pages/frontpage">Read More</a></p>
				</li>
				<li>
					<h3>From Our Blog</h3>{% for article in blogs.news.articles %}
					<h5>{{ article.title | escape }}</h5>
					<p>{{ article.content | strip_html | strip_newlines | truncate(150) }}</p>
					<p><a href="{{ article.url }}">Read More</a></p>{% endfor %}
				</li>
				<li>
					<h3>{{ pages.about_us.title | escape }}</h3>
					<p>{{ pages.about_us.content | strip_html | strip_newlines | truncate( 200 ) }}</p>
					<p><a href="/pages/about-us">Read More</a></p>
				</li>
			</ul>
		</div>
		<!-- END OVERVIEW -->
		<!-- START FOOTER -->
		<div id="footer" class="clear">
			<p>&copy; {{ "now" | date( "%Y" ) }} {{ shop.name | escape }}. Powered by <a href="http://www.shopify.com">Shopify</a>.</p>{% if linklists.footer_menu.links | length > 0 %}
			<p class="links">{% for link in linklists.footer.links %}<a href="{{ link.url }}">{{ link.title | escape }}</a>{% if not forloop.last %} <span>&#124;</span> {% endif %}{% endfor %}</p>{% endif %}
		</div>
		<!-- END FOOTER -->
	</div>
	<!-- END CONTAINER -->{% if template == "product" %}{% if product.available %}{% if product.variants.size > 1 %}
	<script type="text/javascript">
		// <![CDATA[
		var selectCallback = function(variant, selector) {
			if (variant && variant.available == true) {
				$("input#add").removeClass("disabled").removeAttr("disabled");
				$("h2#price span").html(Shopify.formatMoney(variant.price, "{{ shop.money_format }}"));
				if ($("h2#price del").length > 0) {
					$("h2#price del").html(Shopify.formatMoney(variant.compare_at_price, "{{ shop.money_format }}"));
				};
			} else {
				$("input#add").addClass("disabled").attr("disabled", "disabled");
				var message = variant ? "Sold Out" : "Unavailable";
				$("h2#price span").text(message);
				if ($("h2#price del").length > 0) { $("h2#price del").text(""); };
			}
		};
		$(function() {
			//new Shopify.OptionSelectors("id", { product: {{ product | json }}, onVariantSelected: selectCallback });
		});
		// ]]>
	</script>{% endif %}{% endif %}{% endif %}
</body>
</html>
