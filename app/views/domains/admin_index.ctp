<div class="domains index">
	<h2><?php __('Domains');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('domain');?></th>
			
			<th><?php echo $this->Paginator->sort('primary');?></th>
			<th><?php echo $this->Paginator->sort('always_redirect_here');?></th>
			<th><?php echo $this->Paginator->sort('status');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	
	function getAddrByHost($host, $timeout = 3) {
		$host = str_replace('http://', '', $host);
		
		$query = `nslookup -timeout=$timeout -retry=1 $host`;
		if(preg_match('/\nAddress: (.*)\n/', $query, $matches))
		   return trim($matches[1]);
		return $host;
	}
	
	
	foreach ($domains as $domain):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $domain['Domain']['id']; ?>&nbsp;</td>
		<td><?php echo $domain['Domain']['domain']; ?>&nbsp;</td>
		
		<td><?php echo $domain['Domain']['primary'] ? 'YES' : 'NO'; ?>&nbsp;</td>
		<td><?php echo $domain['Domain']['always_redirect_here'] ? 'YES' : 'NO'; ?>&nbsp;</td>
		<td><?php echo getAddrByHost($domain['Domain']['domain']); ?>&nbsp;</td>
		<td class="actions">
			
			<?php
				if (!$domain['Domain']['primary']) {
					echo $this->Html->link(__('Make this primary domain', true), array('action' => 'make_this_primary',
													   'controller' => 'domains',
													   'admin' => true,
													   'id' => $domain['Domain']['id'],
													   'shopId' => $domain['Domain']['shop_id']));
				}
			?>
			<?php
				if ($domain['Domain']['allow_delete']) {
					echo $this->Html->link(__('Delete', true), array('action' => 'delete', $domain['Domain']['id']));
				}
			?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true).' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Domain', true)), array('action' => 'add')); ?></li>
		
		
	</ul>
</div>