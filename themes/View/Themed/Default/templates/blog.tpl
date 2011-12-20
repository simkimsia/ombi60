{% paginate blog.articles by 10 %}{% for article in blog.articles %}<!-- START ENTRY {{ forloop.index }} -->
<div class="entry{% if forloop.first %} start{% endif %}{% if forloop.last %} end{% endif %}">
	<h2 class="title"><a href="{{ article.url }}">{{ article.title | escape }}</a></h2>
	<h5 class="posted">Posted by {{ article.author }} on {{ article.created_at | date: "%B %d, %Y" }} <span><a href="{{ article.url }}{% if blog.comments_enabled? %}#comments{% endif %}">{{ article.comments_count }} {{ article.comments_count | pluralize: "Comment", "Comments" }}</a></span></h5>
	{{ article.content }}
	<p><a href="{{ article.url }}">Read More</a></p>
</div>
<!-- END ENTRY {{ forloop.index }} -->
{% endfor %}{% if paginate.pages > 1 %}
<!-- START PAGINATE -->
<div id="paginate">
	<div>
		{{ paginate | default_pagination }}
	</div>
</div>
<!-- END PAGINATE -->{% endif %}{% endpaginate %}