<?php
	echo $this->Html->script('http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js');
	echo $this->Html->script('jquery/jquery.tools-1.2.ui-full.min');
?>

<div class="merchants index">
<h2><?php __('Merchants');?></h2>



Dashboard for Merchant

<?php echo $this->Html->link(__('Products'), array('controller'=>'products', 'action'=>'index', 'admin'=>true)); ?>
<?php echo $this->Html->link(__('Settings'), '/admin/settings'); ?>