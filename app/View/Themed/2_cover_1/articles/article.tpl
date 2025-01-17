{{ html.script('http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js') }}
{{ html.script('jquery/jquery.tools-1.2.ui-full.min') }}
	
	<div id="cataloguetop"></div>
	<div id="cataloguebody">
		
		<div id="sidebar">
			<div class="barcategory" id="selectedbarcategory">
			{{ html.link(blog.title, ['action':'index','short_name':blog.short_name]) }}
			</div>
				
		</div>
		<div id="cataloguewrapper">
			<div class="categorywrapper">
			<div class="categorytop"></div>
			
			
				<div class="contentcategory">
					<div class="blogtitle">{{ html.link(post.title, post.url) }}</div>
					<div class="blogdatetime">{{ post.created | date('Y-m-d H:i:s')}}</div>
				</div>
				
				
					<div class="contentitem">
						{% set article_content = text.stripLinks(post.content) %}
                                                {{ text.truncate(article_content) }}
						
					</div>
					<!--
					<div class="blogcommentcount">
						3 Comments
					</div>
					
					
					<div class="blogcomment">This is the first comment.</div>
					<div class="blogcomment">This is the second comment.</div>
					<div class="blogcomment">This is the third comment.</div>
					-->
				</div>
			
			
				
				<div class="categorybottom">
				
					
	<!--				
					<table cellpadding="0" cellspacing="0">
						<tr>
							<td id="selected">1</td>
							<td><a href="blog2.html">2</a></td>
							<td><a href="blog3.html">3</a></td>
							<td><a href="blog4.html">4</a></td>
							<td><a href="blog5.html">5</a></td>
						</tr>
					</table>
	-->			
					
				
				</div>
				
			</div>
			
		</div>
		<div id="cataloguebottom"></div>
