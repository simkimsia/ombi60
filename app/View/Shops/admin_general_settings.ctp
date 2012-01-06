<h1><?php echo __('General Settings');?></h1>

<div class="content-box">
	<div class="box-body">
		<div class="box-header clear">
			<h2>About Your Store</h2>
		</div>
	
		<div class="box-wrap clear">
		
		<?php

			echo $this->Form->create('Shop', array(
				'class' => 'validate-form form bt-space15', 
				'inputDefaults' => array(
					'label' => array(
						'class' => 'form-label size-120 fl-space2'
					),
					'div'	=> array(
						'class' => 'form-field clear'
					),
					'error' => array(
						'attributes' => array(
							'wrap' => 'label', 
							'class' => 'error', 
							//'for' wait for Graham reply on this code
						)
					)
				)
			));
			
		echo $this->Form->input('ShopSetting.id', array(
			'type'=>'hidden', 
			'value'=>$shopSetting['ShopSetting']['id']
		));
		
		echo $this->Form->input('ShopSetting.shop_id', array(
			'type'=>'hidden', 
			'value'=>$shopSetting['ShopSetting']['shop_id']
		));

		echo $this->Form->input('Shop.id', array(
			'type'=>'hidden', 
			'value'=>$shopSetting['Shop']['id']
		));

			
		echo $this->Form->input('Shop.name', array(
			'value' => $shopSetting['Shop']['name'],
		));	
			
		echo $this->Form->input('ShopSetting.timezone', array(
			'type' => 'select',
			'default' => $shopSetting['ShopSetting']['timezone'],
			'options' => $this->TimeZone->timezones
		));

		echo $this->Form->input('ShopSetting.unit_system', array(
			'type' => 'select',
			'default' => $shopSetting['ShopSetting']['unit_system'],
			'options' => array(
				'metric' => 'Metric System(kilogram, cm)',
				'imperial'=> 'Imperial System(pound, inch)'
			)
		));

		echo $this->Form->label(
			'ShopSetting.currency', 
			'Money (<a href="#" id="formatting_link">formatting</a>)', 
			array('class' => 'form-label size-120 fl-space2'
		));
		
		echo $this->Form->input('ShopSetting.currency', array(
			'type' => 'select',
			'default' => $shopSetting['ShopSetting']['currency'],
			'label' => false, 
			
			//'after' => '(<a href="#" id="formatting_link">formatting</a>)',
			'options' => array(
				'SGD' => 'Singapore dollar (SGD)',
				'MYR'=> 'Malaysian Ringgit (MYR)'
			)
		));

	   ?>

	        <div id="money-format-div" class="mark_blue">
	        <h4><?php echo __('Formatting');?></h4>

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
	        </div>


	        <?php
	                
		echo $this->Form->input('ShopSetting.checkout_language', array(
			'type' => 'select',
			'default' => $shopSetting['ShopSetting']['checkout_language'],
			'options' => array(
				'0' => 'English',
				'1'=> 'Bahasa Malaysia'
			)
		));
	                
		echo $this->Form->input('ShopSetting.users_accepted', array(
			'type' => 'radio',
			'default' => $shopSetting['ShopSetting']['users_accepted'],
			'options' => array(
				'guest'=> 'Only guest users',
				'registered'=> 'Only registered users', 
				'both' => 'Both',
			)
		));
		
		?>

		<input type="submit" class="button" value="Apply Settings" />

		<?php echo $this->Form->end(); ?>
		
		</div>
	</div>
</div>

<script type="text/javascript" language="javascript">

	$(document).ready(function (){
		$("#money-format-div").hide();
		$('#formatting_link').click(function () {
			
			$("#money-format-div").toggle();
			
		});
	});

</script>
