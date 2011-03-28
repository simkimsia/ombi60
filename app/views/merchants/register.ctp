<?php
	echo $this->Html->script('http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js');

?>


<?php
	echo $this->element('errors', array('errors' => $errors));
	echo $this->Form->create('Merchant', array('action' => 'register'));
	echo $this->Form->input('Shop.name', array('label'=>'Shop name'));
	echo $this->Form->input('Shop.primary_domain', array('value'=>'', 'type'=>'hidden') );
	echo 'http://' . $this->Form->input('Shop.subdomain', array('label'=>'Web Address')) . '.myspree2shop.com' ;
	echo $this->Form->input('User.full_name');
	echo $this->Form->input('User.name_to_call');
	echo $this->Form->input('User.email');
	echo $this->Form->input('User.password');
	echo $this->Form->input('User.password_confirm', array('type' => 'password'));
	echo $this->Form->submit();
	echo $this->Form->end();
?>

<script type="text/javascript">

	function getFullDomain(subdomain){
		return 'http://' + subdomain + '.myspree2shop.com';
	}

	$(document).ready(function() {

		$('#ShopWebAddress').val( getFullDomain($('#ShopSubdomain').val()) );

		$('#ShopSubdomain').keyup( function () {
			$('#ShopWebAddress').val( getFullDomain($('#ShopSubdomain').val()) );
		});


	});

</script>