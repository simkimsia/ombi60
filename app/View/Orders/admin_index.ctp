<h1 class="center">Orders</h1>
<div class="rule"></div>
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


	<?php
	echo $this->element('action_buttons_orders', array('modelName' => 'Order'));
	?>
	
		<table id="ordersTable" class="style1 datatable">
			<thead>
				<tr>
					<th ></th>
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