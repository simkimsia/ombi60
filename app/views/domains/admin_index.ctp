<div>
	<h2 class="text_center"><?php __('Domains');?></h2>
	<div id="domain_intro_text">
	    <strong>Domains</strong>
	    <br>
	    These are the domains used by your business.
	    <br>
	    <a href="#">Learn how to setup your domain from OMBI60.com</a>
	</div>
	<div id="domain_list_table">
    	<?php echo $this->render('admin_domain_list', false);?>	
    </div>
	
	<?php
	//echo $this->Paginator->counter(array(
	//'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	//));
	?>

	<!--<div class="paging">
		<?php echo $this->Paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true).' >>', array(), null, array('class' => 'disabled'));?>
	</div>-->
	<div class="background_gray">
    	<?php echo $this->Html->link(sprintf(__('Add a domain that you own', true)), "#", array('onclick' => 'showNewDomainForm();return false;', 'class' => 'link_class', 'id' => 'add_domain',)); ?>
	<?php
	echo $this->element('add_domain', array('shopId' => $shopId));
	?>
	</div>
</div>

<script>

function afterAddDomain(response) {
	var json_object = $.parseJSON(response);
	if (json_object.success) {
	    $('#show_error').hide();
	    $('#show_error').html();
		$('#domain_list_table').html(json_object.contents);
		$('#DomainDomain').val("");
	} else {
	    $('#show_error').show();
	    $('#show_error').html("<span class='redText'>"+json_object.message+"</span>");
	}
}
	
function showNewDomainForm() {	
    $('#add_domain').hide();
    $('#show_error').hide();
    $('#DomainDomain').val("");
	$('#add_domain_div').show();
}
</script>
