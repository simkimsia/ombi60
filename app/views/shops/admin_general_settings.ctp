<?php
	echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js');
?>

<div>
<div class="text_center"><h2><?php __('General Settings');?></h2>
    <?php echo $this->Html->link(__('Cancel', true), array('action' => 'index', 'admin' => true));?>
</div>
<?php
	echo $this->element('errors', array('errors' => $errors));
	echo $this->Form->create('Shop');
	echo $this->Form->input('ShopSetting.id', array('type'=>'hidden', 'value'=>$shopSetting['ShopSetting']['id']));
	echo $this->Form->input('ShopSetting.shop_id', array('type'=>'hidden', 'value'=>$shopSetting['ShopSetting']['shop_id']));
?>
	<fieldset>
 		<legend><?php __('Edit Settings');?></legend>
	<?php
        
                echo $this->Form->input('ShopSetting.timezone', array('type' => 'select',
                                                             'default' => $shopSetting['ShopSetting']['timezone'],
                                                             'options' => array('Singapore' => 'GMT +8 Singapore',
                                                                                'Malaysia'=> 'GMT +8 Malaysia')));
	
		echo $this->Form->input('ShopSetting.unit_system', array('type' => 'select',
                                                             'default' => $shopSetting['ShopSetting']['unit_system'],
                                                             'options' => array('metric' => 'Metric System(kilogram, cm)',
                                                                                'imperial'=> 'Imperial System(pound, inch)')));
                
                
                
                
		echo $this->Form->input('ShopSetting.currency', array('type' => 'select',
                                                             'default' => $shopSetting['ShopSetting']['currency'],
							     'options' => array('SGD' => 'Singapore dollar (SGD)',
                                                                                'MYR'=> 'Malaysian Ringgit (MYR)')));
                
        ?>
                
        <a href="#" id="formatting_link">Change Money Format</a>
        
        <div id="money-format-div">
	
	<?php
                echo $this->Form->input('ShopSetting.money_html', array('value'=>$shopSetting['ShopSetting']['money_html']));
		echo $this->Form->input('ShopSetting.money_html_currency', array('value'=>$shopSetting['ShopSetting']['money_html_currency']));
		echo $this->Form->input('ShopSetting.money_email', array('value'=>$shopSetting['ShopSetting']['money_email']));
		echo $this->Form->input('ShopSetting.money_email_currency', array('value'=>$shopSetting['ShopSetting']['money_email_currency']));
	?>
		      
        </div>
                
                
        <?php
                echo $this->Form->input('ShopSetting.checkout_language', array('type' => 'select',
                                                             'default' => $shopSetting['ShopSetting']['checkout_language'],
                                                             'options' => array('0' => 'English',
                                                                                '1'=> 'Bahasa Malaysia')));
	?>

	</fieldset>
	
	<?php echo $this->Form->end('Submit'); ?>

</div>


<script type="text/javascript" language="javascript">

        $(document).ready(function (){
		$("#money-format-div").hide();
		$('#formatting_link').click(function () {
			
			$("#money-format-div").toggle();
			
		});
	});

</script>
