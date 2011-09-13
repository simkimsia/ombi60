<?php
	echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js');
	echo $this->Html->script('jquery/jquery.tools-1.2.ui-full.min');
	echo $this->Html->script('jquery/jquery.MultiFile-1.47.pack');
?>

<!-- tabs -->
<ul class="css-tabs">
	<li><?php echo $this->Html->link('Details', array('controller' => 'products',
					 'action' => 'edit',
                                         'admin' => true,
					 $product_id,

					)); ?></li>

	<li><?php echo $this->Html->link('Images', array('controller' => 'product_images',
					 'action' => 'list_by_product',
					 'product_id' => $product_id,

					)); ?></li>

</ul>

<!-- single pane. it is always visible 
<div class="css-panes">
	<div style="display:block"></div>
</div>
-->

<!-- activate tabs with JavaScript -->
<script>

/*
$(function() {

	$("ul.css-tabs").tabs("div.css-panes > div", {effect: 'ajax'});

});
*/
</script>

<?php echo $this->element('product_images_admin_list_by_product_list'); ?>