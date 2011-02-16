<?php
	echo $this->Html->script('http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js');
	echo $this->Html->script('jquery/jquery.tools-1.2.ui-full.min');
?>
	
	<div id="cataloguetop"></div>
	<div id="cataloguebody">
		
		<div id="sidebar">
			<div class="barcategory" id="selectedbarcategory"><?php echo $blog['Blog']['name']; ?></div>
				
		</div>
		<div id="cataloguewrapper">
			<div class="categorywrapper">
			<div class="categorytop"></div>
			
			<?php foreach($posts as $post): ?>
				<div class="contentcategory">
					<div class="blogtitle"><?php echo $this->Html->link($post['Post']['title'],
											    array(
												'action'=>'view',
												'short_name'=>$blog['Blog']['short_name'],
												'id'=>$post['Post']['id'],
												'slug'=>$post['Post']['slug'])); ?></div>
					<div class="blogdatetime"><?php echo $post['Post']['created']; ?></div>
				</div>
				
				
					<div class="contentitem">
						<?php 
                                                $body = $this->Text->stripLinks($post['Post']['body']);
                                                echo trim($this->Text->truncate($body));
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
					<?php
					
					echo $this->Paginator->numbers();
					
					
					/*
					echo $this->Paginator->counter();
					echo $paginator->prev('<< Newer ', null, null, array('class' => 'disabled'));
					echo $paginator->next(' Older >>', null, null, array('class' => 'disabled'));
					*/
					?>
				
				</div>
				
			</div>
			
		</div>
		<div id="cataloguebottom"></div>
