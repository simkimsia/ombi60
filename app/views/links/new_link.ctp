<?php


	
	if ($link['Link']['id'] != null) {
			
	
		
?>
	
        <tr>
		
		<td><?php echo $link['Link']['name']; ?>&nbsp;</td>
		<td><?php echo $this->Html->link($link['Link']['route'],
						 $link['Link']['route']); ?>&nbsp;</td>
		
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $link['Link']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $link['Link']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $link['Link']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $link['Link']['id'])); ?>
		</td>
	</tr>
        
	
	
<?php
	}
?>
	
