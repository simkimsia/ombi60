<table cellpadding="0" cellspacing="0" class="items-table orders-table">
<tr>
		
		<th><?php echo $this->Paginator->sort('domain');?></th>
		
		<!-- <th><?php //echo $this->Paginator->sort('always_redirect_here');?></th> -->
		<th><?php echo $this->Paginator->sort('Working?');?></th>
		<th class="actions" style="text-align: center"><?php echo __('Actions');?></th>
</tr>
<?php
$i = 0;

// get the ip address of main url of shop
App::uses('HttpLib', 'UtilityLib.Lib');
$mainIP = HttpLib::getAddrByHost($mainUrl);
foreach ($domains as $domain):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
<tr<?php echo $class;?>>
	
	<td><?php echo $domain['Domain']['domain']; ?>&nbsp;</td>
	
	<!-- <td><?php //echo $domain['Domain']['always_redirect_here'] ? 'YES' : 'NO'; ?>&nbsp;</td> -->
	<td><?php echo (HttpLib::getAddrByHost($domain['Domain']['domain']) == $mainIP) ? 'YES' : 'NO'; ?>&nbsp;</td>
	<td class="actions">
		
		<?php
			if (!$domain['Domain']['primary']) {
				echo $this->Html->link(__('Make this primary domain'), array('action' => 'make_this_primary',
												   'controller' => 'domains',
												   'admin' => true,
												   'id' => $domain['Domain']['id'],
												   'shopId' => $domain['Domain']['shop_id']));
			}
		?>
		<?php
			if ($domain['Domain']['domain'] != $mainUrl OR !$domain['Domain']['shop_web_address']) {
				echo $this->Html->link(__('Delete'), array('action' => 'delete', $domain['Domain']['id']), array('confirm' => 'Are you sure you want to delete this domain?'));
			}
		?>
	</td>
</tr>
<?php endforeach; ?>
</table>
