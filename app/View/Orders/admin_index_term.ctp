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

<?php $currentUrl = $_SERVER['REQUEST_URI']; ?>

	<?php 
	
	$filters = 'Showing ';

	$displayValues = array(
		'open' => ORDER_OPENED,
		'closed' => ORDER_CLOSED,
		'cancelled' => ORDER_CANCELLED
	); 
	$fieldName = 'status';
	$filters .= $this->element('single_filter', compact('modelName', 'displayValues', 'fieldName'));
	
	$filters .= ' orders that are ';
	
	$displayValues = array(
		'paid' => PAYMENT_PAID,
		'pending' => PAYMENT_PENDING,
		'authorized' => PAYMENT_AUTHORIZED,
		'abandoned' => PAYMENT_ABANDONED
	); 
	$fieldName = 'p_status';
	$displayNameForAny = 'any payment status';
	$filters .= $this->element('single_filter', compact('modelName', 'displayValues', 'fieldName', 'displayNameForAny'));
	
	$filters .= ' and ';
	
	$displayValues = array(
		'not fulfilled' => FULFILLMENT_NOT_FULFILLED,
		'partial' => FULFILLMENT_PARTIAL,
		'fulfilled' => FULFILLMENT_FULFILLED,
	); 
	$fieldName = 'f_status';
	$displayNameForAny = 'any fulfillment status';
	$filters .= $this->element('single_filter', compact('modelName', 'displayValues', 'fieldName', 'displayNameForAny'));
	
	echo $this->element('table_filters', array('modelName' => 'Order', 'showingFilters' => $filters));?>


<!-- DATA-TABLE JS PLUGIN -->
<div id="data-table">


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