<h1 class="center">Blogs &amp; Pages</h1>
<div class="rule"></div>
<div id="action-links">
	<ul>
		<li id="create-page"><?php echo $this->Html->link(__('Create new Page'), array('action' => 'add')); ?></li>
		<li id="create-blog"><?php echo $this->Html->link(__('Create new Blog'), array('controller'=>'blogs','action' => 'add')); ?></li>
		<li id="create-article"><?php echo $this->Html->link(__('Create new Page'), array('action' => 'add')); ?></li>

	</ul>

</div>
<?php $currentUrl = $_SERVER['REQUEST_URI']; ?>

	

<!-- PAGES -->
<h2 >Pages</h1>
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
<h2 >Blogs</h1>
<div class="rule" />

<p>A blog is a series of articles for content that changes frequently such as news and updates about your shop.</p>

<?php foreach ($blogs as $blog): ?>
	
<div>
	<table id="blogTable<?php echo $blog['Blog']['id']; ?>" class="style1 datatable">
		<thead>
			<tr>
				<?php $articlesCol = $blog['Blog']['title'] . ' articles'; ?>
				<th ><?php echo $articlesCol; ?></th>
				<th >Author & Date</th>
				<th ></th>
			</tr>
		</thead>
		<tbody>
	<?php foreach ($blog['Post'] as $post): ?>
			<tr>
			
				<?php
				$visible 		= $post['visible'];

				$statusClass = '';
				if (!$visible) {
					$statusClass 	= '<span class="status-hidden">Hidden</span>';
				}
				
				?>
				
				<td><?php echo $post['title'] . $statusClass; ?></td>
				
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
		</tbody>
	</table>
	
	
</div><!-- PAGES -->

	
<?php endforeach; ?>


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
		
		blogTable = $('#blogsTable').dataTable( {
			"bProcessing": true,
			"bServerSide": true,
			"sAjaxSource": "<?php echo $currentUrl; ?>",
			"bLengthChange": true,
			"bPaginate": true,
			"sPaginationType": "full_numbers",
			"iDisplayLength" : "<?php echo $currentPageLength; ?>",
			"bLengthChange" : false,
			"bInfo" : false,
			"bFilter" : false,
			'aoColumns': [ 
				{ "bSortable": false },
				null,
				null,
				null,
				null,
				null,
				null
			],
			// set the order no. as default sort desc
			"aaSorting": [[2,'desc']],
			"oLanguage": {
				"sProcessing": '<div id="overlay_modal"><?php echo $this->Html->image('ajax-loader.gif', array('alt' => 'Processing...', 'class'=>'bt-space15')); ?><p class="center bt-space0">Processing...</p></div>'
			},
		    "fnDrawCallback": function( oSettings ) {
				if (oSettings._iRecordsTotal == 0) {
					// hide the table
					$('#data-table').hide();
				}


		    }



		} );
		
	});

</script>