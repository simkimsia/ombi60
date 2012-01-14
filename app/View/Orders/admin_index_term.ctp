<h1 class="center">Orders</h1>
<div class="rule"></div>
<div id="action-links">
	<ul>
	    <li id="email"><a href="https://donnelly-lockman2285.myshopify.com/admin/orders/54131562/contact" title="Contact Customer">Contact customer</a></li>
		<li id="note"><a href="#" onclick="$(&quot;order-note&quot;).hide();$(&quot;note-form&quot;).show();$(&quot;order_note&quot;).focus(); return false;">Attach note</a></li>
		<li class="csv"><a href="https://donnelly-lockman2285.myshopify.com/admin/orders/54131562.csv">Export</a></li>
		<li id="print"><a href="#" onclick="window.print();; return false;">Print</a></li>
		<li id="lock"><a href="https://donnelly-lockman2285.myshopify.com/admin/orders/54131562/close" data-method="post" rel="nofollow">Close this order</a></li>


	</ul>

</div>

<?php 

	echo $currentUrl = $_SERVER[ 'REQUEST_URI' ]; 
	$requestParams = $this->request->query;
	
?>

<a href="<?php echo $this->Html->addQueryToCurrentUrl(array('f_status'=>PAYMENT_AUTHORIZED)); ?>" >All Authorized</a>
<a href="<?php echo $this->Html->addQueryToCurrentUrl(array('f_status'=>PAYMENT_ABANDONED)); ?>" >All Abandoned</a>

<a href="<?php echo $this->Html->addQueryToCurrentUrl(array('status'=>ORDER_CREATED)); ?>" >All CREATED</a>
<a href="<?php echo $this->Html->addQueryToCurrentUrl(array('status'=>ORDER_OPENED)); ?>" >All OPENED</a>

<!-- DATA-TABLE JS PLUGIN -->
<div id="data-table">
	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed in porta lectus. Maecenas dignissim enim quis ipsum mattis aliquet. Maecenas id velit et elit gravida bibendum. Duis nec rutrum lorem.</p> 

	<form method="post" action="">
	
	<table id="ordersTable" class="style1 datatable">
	<thead>
		<tr>
			<th ><input type="checkbox" class="checkbox select-all" /></th>
			<th >Order #</th>
			<th >Date Created</th>
			<th >Customer Full Name</th>
			<th >Payment</th>
			<th >Fulfillment</th>
			<th >Total</th>
		</tr>
	</thead>
	<tbody>
	</tbody>
	</table>
	
	
	<div class="tab-footer clear fl">
		<div class="fl">
			<select name="dropdown" class="fl-space">
				<option value="option1">choose action...</option>
				<option value="option2">Edit</option>
				<option value="option3">Delete</option>
			</select>
			<input type="submit" value="Apply" id="submit1" class="button fl-space" />
		</div>
	</div>
	</form>
</div><!-- /#table -->

<script type="text/javascript">

	$(document).ready(function(){
		
		oTable = $('#ordersTable').dataTable( {
			"bProcessing": true,
			"bServerSide": true,
			"sAjaxSource": "<?php echo $currentUrl; ?>",
			"bLengthChange": true,
			"bPaginate": true,
			"sPaginationType": "full_numbers",
			"iDisplayLength" : 5,
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
				//"sProcessing" : 'Processing...'
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