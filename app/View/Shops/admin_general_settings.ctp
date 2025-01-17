<?php
	echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js');
?>

<div>
<div class="text_center"><h2><?php echo __('General Settings');?></h2>
    <?php //echo $this->Html->link(__('Cancel'), array('action' => 'index', 'admin' => true));?>
</div>
<?php
    if (empty($errors)) {
        $errors = null;
    }
    echo $this->element('errors', array('errors' => $errors));
	echo $this->Form->create('Shop');
	echo $this->Form->input('ShopSetting.id', array('type'=>'hidden', 'value'=>$shopSetting['ShopSetting']['id']));
	echo $this->Form->input('ShopSetting.shop_id', array('type'=>'hidden', 'value'=>$shopSetting['ShopSetting']['shop_id']));
?>
	<fieldset>
 		<!--<legend><?php echo __('Edit Settings');?></legend>-->
	<?php
        
                echo $this->Form->input('ShopSetting.timezone', array('type' => 'select',
                                                             'default' => $shopSetting['ShopSetting']['timezone'],
                                                             'options' => $this->TimeZone->timezones));
	
		echo $this->Form->input('ShopSetting.unit_system', array('type' => 'select',
                                                             'default' => $shopSetting['ShopSetting']['unit_system'],
                                                             'options' => array('metric' => 'Metric System(kilogram, cm)',
                                                                                'imperial'=> 'Imperial System(pound, inch)')));
                
                
                
            
		echo $this->Form->input('ShopSetting.currency', array('type' => 'select',
                                                             'default' => $shopSetting['ShopSetting']['currency'],
                                                             'label' => 'Money (<a href="#" id="formatting_link">formatting</a>)',
                                                             //'after' => '(<a href="#" id="formatting_link">formatting</a>)',
							     'options' => array('SGD' => 'Singapore dollar (SGD)',
                                                                                'MYR'=> 'Malaysian Ringgit (MYR)')));
                
        ?>
                
        
        
        <div id="money-format-div">
        <fieldset>
        <legend><?php echo __('Formatting');?></legend>
	
	<?php
    echo $this->Form->input('ShopSetting.money_in_html', array(
            'value'=>$shopSetting['ShopSetting']['money_in_html'],
            'label' => false,
            'after' => ' Money in Html' ,
           ));
		echo $this->Form->input('ShopSetting.money_in_html_with_currency', array(
		        'value' => $shopSetting['ShopSetting']['money_in_html_with_currency'],
	          'label' => false,
	          'after' => ' Money in Html With Currency',
		        ));
		echo $this->Form->input('ShopSetting.money_in_email', array(
		        'value'=>$shopSetting['ShopSetting']['money_in_email'],
		        'label' => false,
	          'after' => ' Money in Email',
		        ));
		echo $this->Form->input('ShopSetting.money_in_email_with_currency', array(
            'value'=>$shopSetting['ShopSetting']['money_in_email_with_currency'],
            'label' => false,
	          'after' => ' Money in Email With Currency',
            ));
		
	?>
		    </fieldset>  
        </div>
                
                
        <?php
                echo $this->Form->input('ShopSetting.checkout_language', array('type' => 'select',
                                                             'default' => $shopSetting['ShopSetting']['checkout_language'],
                                                             'options' => array('0' => 'English',
                                                                                '1'=> 'Bahasa Malaysia')));
                echo $this->Form->input('ShopSetting.users_accepted', array(
                	'type' => 'radio',
					'default' => $shopSetting['ShopSetting']['users_accepted'],
					'options' => array('guest'=> 'Only guest users',
					'registered'=> 'Only registered users', 'both' => 'Both',)));
	?>

	</fieldset>
	
	<?php echo $this->Form->end('Apply Settings'); ?>

</div>


<script type="text/javascript" language="javascript">

        $(document).ready(function (){
		$("#money-format-div").hide();
		$('#formatting_link').click(function () {
			
			$("#money-format-div").toggle();
			
		});
	});

</script>
