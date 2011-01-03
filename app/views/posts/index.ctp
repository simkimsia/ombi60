<?php
	echo $this->Html->script('http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js');
	echo $this->Html->script('jquery/jquery.tools-1.2.ui-full.min');
?>
	
	<div id="cataloguetop"></div>
	<div id="cataloguebody">
		
		<div id="sidebar">
			<div class="barcategory" id="selectedbarcategory">Blog Title</div>
				<div class="baritem">Blog Post Title 1</div>
				<div class="baritem"><a href="blog2.html">Blog Post Title 2</a></div>
				<div class="baritem"><a href="blog3.html">Blog Post Title 3</a></div>
				<div class="baritem"><a href="blog4.html">Blog Post Title 4</a></div>
				<div class="baritem"><a href="blog5.html">Blog Post Title 5</a></div>
		</div>
		<div id="cataloguewrapper">
			<div class="categorywrapper">
			<div class="categorytop"></div>
			
			<?php foreach($posts as $post): ?>
				<div class="contentcategory">
					<div class="blogtitle"><?php echo $post['Post']['title']; ?></div>
					<div class="blogdatetime"><?php echo $post['Post']['created']; ?></div>
				</div>
				
				
					<div class="contentitem">
						<?php echo
                                                $body = $this->Text->stripLinks($post['Post']['body']);
                                                echo $this->Text->truncate($body);
                                                ?>
						
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
			
			<?php endforeach; ?>
				
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
