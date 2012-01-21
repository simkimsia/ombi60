<h1 class="center">Blogs &amp; Pages</h1>
<div class="rule"></div>
<div id="action-links">
	<ul>
		<li id="create-page"><?php echo $this->Html->link(__('Create new Page'), array('action' => 'add')); ?></li>
		<li id="create-blog"><?php echo $this->Html->link(__('Create new Blog'), array('controller'=>'blogs','action' => 'add')); ?></li>
		<li id="create-article"><?php echo $this->Html->link(__('Create new Article'), array('controller' => 'posts', 'action' => 'add')); ?></li>

	</ul>

</div>
<?php $currentUrl = $_SERVER['REQUEST_URI']; ?>

	

<!-- PAGES -->
<h2>Pages</h2>
<div class="rule" />

<p>A page is a standalone part of your shop informing your customers about your business or products.</p>
<p>Examples: "About Us" section, Warranty, Terms of Service</p>


<div id="pages-data-table">

		<table id="webpagesTable" class="style1 datatable">
			<thead>
				<tr>
					<th >Title</th>
					<th >Updated</th>
					<th ></th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	
	
</div><!-- PAGES -->

<!-- Blogs -->
<h2>Blogs</h2>
<div class="rule" />

<div id="blogs">
	<p>A blog is a series of articles for content that changes frequently such as news and updates about your shop.</p>

	<?php foreach ($blogs as $blog): ?>
	<?php 
		$blogTitle	= $blog['Blog']['title'];
		$blogId		= $blog['Blog']['id'];
		
	?>
	<div>
	
		<table id="blogTable<?php echo $blogId; ?>" class="style1 datatable">
			<thead>
				<tr>
					<?php $articlesCol = $blogTitle . ' articles'; ?>
					<th ><?php echo $articlesCol; ?></th>
					<th class="quad">Author & Date</th>
					<th class="tenth center"></th>
				</tr>
			</thead>
			<tbody>
			
			
		<?php if (empty($blog['Post'])) : ?>
				<tr>
					<?php 
				

					$blogHtml = $this->Html->link(__($blogTitle), array(
						'controller' => 'blogs',
						'action'	 => 'view',
						'admin' 	 => true,
						$blogId));

					$writeFirstArticleHtml = $this->Html->link(__('write the first article'), array(
						'controller' => 'posts', 
						'action' => 'add_to_blog', 
						'blog_id'=>$blogId
					)); 
				
					$emptyBlogHtml = $blogHtml . ' has no articles, ' . $writeFirstArticleHtml; 

					?>
					<td class="center" colspan="5"><?php echo $emptyBlogHtml; ?></td>
				</tr>
		<?php else : ?>
		
			<?php foreach ($blog['Post'] as $post): ?>
				<tr>
			
					<?php
					$visible 		= $post['visible'];

					$statusClass = '';
					if (!$visible) {
						$statusClass 	= '<span class="status-hidden">Hidden</span>';
					}
					
					$postUrl = Router::url(array(
						'controller'	=> 'posts',
						'action'		=> 'view',
						'admin'			=> true,
						'id'			=> $post['id']));
					
					$postLink = $this->Html->link($post['title'], $postUrl);
				
					?>
				
					<td><?php echo $postLink . $statusClass; ?></td>
				
					<?php 
					// prepare the author and updated datetime
					$author = isset($post['Author']['full_name']) ? $post['Author']['full_name'] : '';
					$modified = $this->Time->niceShort($post['modified']);
					$authorDate = $author . '<br /><span class="note">' . $modified . '</span>';
					?>
				
					<td class="quad"><?php echo $authorDate; ?></td>
					<td class="tenth center"><?php echo $this->element('trash_delete_icon', array(
													'controllerName' => 'posts',
													'id'				=> $post['id'],
													'singularName' => 'article'
									));?></td>				
				</tr>
			<?php endforeach; ?>
				<tr>
					<td colspan="5"><?php echo $this->element('manage_blog_link', $blog['Blog']); ?></td>
				</tr>
		
		
		<?php endif; ?>
		
			</tbody>
		</table>
	
	
	</div>

	
	<?php endforeach; ?>

</div><!-- BLOGS -->

<script type="text/javascript">

	$(document).ready(function(){
		
		oTable = $('#webpagesTable').dataTable( {
			"bProcessing": true,
			"bServerSide": true,
			"sAjaxSource": "<?php echo $currentUrl; ?>",
			"bLengthChange": true,
			"bPaginate": true,
			"sPaginationType": "full_numbers",
			"iDisplayLength" : "<?php echo $currentPageLength; ?>",
			"bInfo" : false,
			"bFilter" : false,
			'aoColumns': [ 
				null,
				{ "sClass" : "quad" },
				{ "bSortable": false,
				  "sClass" : "tenth center" },
			],
			// set the order no. as default sort desc
			"aaSorting": [[0,'asc']],
			"oLanguage": {
				"sProcessing": '<div id="overlay_modal"><?php echo $this->Html->image('ajax-loader.gif', array('alt' => 'Processing...', 'class'=>'bt-space15')); ?><p class="center bt-space0">Processing...</p></div>'
			},
		    "fnDrawCallback": function( oSettings ) {
				if (oSettings._iRecordsTotal == 0) {
					// hide the table
					$('#pages-data-table').hide();
				}


		    }



		} );
		

	});

</script>