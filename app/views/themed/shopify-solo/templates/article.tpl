<!-- START ENTRY {{ forloop.index }} -->
<div class="entry">
	<h2 class="title">{{ article.title | escape }}</h2>
	<h5 class="posted">Posted by {{ article.author }} on {{ article.created_at | date: "%B %d, %Y" }} <span><a href="{{ article.url }}{% if blog.comments_enabled? %}#comments{% endif %}">{{ article.comments_count }} {{ article.comments_count | pluralize: "Comment", "Comments" }}</a></span></h5>
	{{ article.content }}
</div>
<!-- END ENTRY -->{% if blog.comments_enabled? or article.comments.size > 0 %}
<!-- START COMMENTS -->
<div id="comments">
	<h3>Comments <span>({{ article.comments_count }} {{ article.comments_count | pluralize: "Comment", "Comments" }})</span></h3>{% if article.comments.size == 0 %}
	<p id="empty">There are no comments.</p>{% else %}{% for comment in article.comments %}
	<!-- START COMMENT {{ forloop.index }} -->
	<div class="comment{% if forloop.first %} start{% endif %}{% if forloop.last %} end{% endif %}">
		{{ comment.content }}
		<h6 class="author">Posted by {{ comment.author }} on {{ comment.created_at | date: "%B %d, %Y" }}</h6>
	</div>
	<!-- END COMMENT {{ forloop.index }} -->{% endfor %}{% endif %}{% if blog.comments_enabled? %}
	<h3>Post Comment</h3>
	<!-- START COMMENT FORM -->
	{% form article %}{% if form.posted_successfully? %}{% if blog.moderated? %}
		<p id="posted">Successfully posted and awaiting approval by moderator.</p>{% endif %}{% endif %}{% if form.errors %}
		<p id="error">Not all the fields have been filled out correctly!</p>{% endif %}
		<label for="comment_author"{% if form.errors contains "author" %} class="error"{% endif %}>Name</label>
		<input type="text" id="comment_author" name="comment[author]" value="{{ form.author }}" class="field{% if form.errors contains "author" %} error{% endif %}" /><br />
		<label for="comment_email"{% if form.errors contains "email" %} class="error"{% endif %}>Email Address <span>(we never show this)</span></label>
		<input type="text" id="comment_email" name="comment[email]" value="{{ form.email }}" class="field{% if form.errors contains "email" %} error{% endif %}" /><br />
		<label for="comment_body"{% if form.errors contains "body" %} class="error"{% endif %}>Comment</label>
		<textarea id="comment_body" name="comment[body]" cols="" rows=""{% if form.errors contains "body" %} class="error"{% endif %}>{{ form.body }}</textarea><br />
		<input type="image" src="{{ "comment.png" | asset_url }}" alt="POST COMMENT" class="submit" />
	{% endform %}
	<!-- END COMMENT FORM -->{% endif %}
</div>
<!-- END COMMENTS -->{% endif %}{% if blog.comments_enabled? %}{% else %}
<p id="closed">Comments are closed for this article.</p>{% endif %}