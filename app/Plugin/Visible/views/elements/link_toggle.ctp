<?php 
	if (1 == $product['Product']['visible']) {
	    $status = __('Published', true);
	} else {
	    $status = __('Hidden', true);    
	}        
?>	
		  
<?php echo $this->Html->link($status,
	array('action' => 'toggle', $product['Product']['id']),
	array('class' => 'product-status')); 
?>
