{% for article in blog.articles %}<!-- START ENTRY {{ forloop.index }} -->
<div class="entry{% if forloop.first %} start{% endif %}{% if forloop.last %} end{% endif %}">
	<h2 class="title"><a href="{{ article.url }}">{{ article.title | escape }}</a></h2>
	<h5 class="posted">Posted by {{ article.author }} on {{ article.created | date( "F d Y") }} </h5>
	{{ article.content }}
	<p><a href="{{ article.url }}">Read More</a></p>
</div>
<!-- END ENTRY {{ forloop.index }} -->
{% endfor %}
