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

	

<!-- DATA-TABLE JS PLUGIN -->
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
	
	
	</form>
</div><!-- /#table -->

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
			"bLengthChange" : false,
			"bInfo" : false,
			"bFilter" : false,
			'aoColumns': [ 
				null,
				{ "sClass" : "quad" },
				{ "bSortable": false,
				  "sClass" : "tenth center" },
			],
			// set the order no. as default sort desc
			"aaSorting": [[1,'desc']],
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