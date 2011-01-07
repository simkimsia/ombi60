<?php

	if ($link['Link']['id'] != null) {
		
?>
	
        <tr>
		
		<td><?php echo $link['Link']['name']; ?>&nbsp;</td>
		<td><?php echo $this->Html->link($link['Link']['route'],
						 $link['Link']['route']); ?>&nbsp;</td>
	    
	</tr>
	
<?php
	}
?>
	
