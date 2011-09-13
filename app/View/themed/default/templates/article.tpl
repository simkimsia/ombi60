<!-- START ENTRY {{ forloop.index }} -->
<div class="entry">
	<h2 class="title">{{ article.title | escape }}</h2>
	<h5 class="posted">Posted by {{ article.author }} on {{ article.created | date( "F d Y") }} <span><a href="{{ article.url }}">Comments</a></span></h5>
	{{ article.content }}
</div>
<!-- END ENTRY -->
