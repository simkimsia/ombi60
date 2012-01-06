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

<!-- DATA-TABLE JS PLUGIN -->
<div id="data-table">
	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed in porta lectus. Maecenas dignissim enim quis ipsum mattis aliquet. Maecenas id velit et elit gravida bibendum. Duis nec rutrum lorem.</p> 

	<form method="post" action="">
	
	<table class="style1 datatable">
	<thead>
		<tr>
			<th class="bSortable"><input type="checkbox" class="checkbox select-all" /></th>
			<th>Column 1</th>
			<th>Column 2</th>
			<th>Column 3</th>
			<th>Column 4</th>
			<th>Column 5</th>
			<th>Column 6</th>
		</tr>
	</thead>
	<tbody>
		<?php
		
			foreach ($orders as $order):

		
		?>
	
		<tr>
			<td><input type="checkbox" class="checkbox" /></td>

			<td>
				<?php echo $this->Html->link(__('#' . $order['Order']['order_no']), array('action' => 'view', $order['Order']['id'])); ?>

			</td>
			<td>
				<?php echo $this->Time->niceShort($order['Order']['created']); ?>
			</td>
			<td>
				<?php echo $order['User']['full_name']; ?>
			</td>

			<td>
				<?php echo $this->Constant->displayPayment($order['Order']['payment_status']);?>
			</td>
			<td>
				<?php echo $this->Constant->displayFulfillment($order['Order']['fulfillment_status']);?>
			</td>

			<td>
				<?php echo $this->Number->currency($order['Order']['amount'], '$'); ?>
			</td>


		</tr>
		
		<?php endforeach; ?>
                                    

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