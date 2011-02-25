<?php echo $this->Html->script('http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js');?>
<div>
    <?php $displayCountryTitle = ($this->data['Country']['name'] !== null) ? $this->data['Country']['printable_name'] : 'Rest of World'; ?>
    <div class="text_center"><h2><?php __('Shipping to '.$displayCountryTitle);?></h2>
        <a href="javascript: void(0)" onclick="toggleEditForm();return false;" id="view_edit"><?php __('Edit') ?></a>|
        <?php
        echo $html->link('All Shipping Rates', array(
                                                'controller' => 'shipping_rates',
                                                'action' => 'index',
                                                'admin'=>true));
        echo "|";
        ?>
        <?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->data['ShippingRate']['id']), null, sprintf(__('Are you sure you want to delete %s for %s?', true), $this->data['ShippingRate']['name'], $displayCountryTitle)); ?>
    </div>	
<?php echo $this->Form->create('ShippingRate', array('url'=>array('action'=>'edit',
								                      'controller'=>'shipping_rates',
								                      'admin'=>true,
								                      'based'=>$based,
								                    )));?>
	<?php
	if ($based == "weight-based-shipping") {
	    $legend_text = "weight-based shipping";
	} else {
	    $legend_text = "price-based shipping";
	}
	?>
		
	<div id="details">
	    <fieldset>
     		<legend><?php __('View this '.$legend_text.' rate'); ?></legend>
     		<ul class="shipping-view">
     		    <li>
     	        <?php
     		        echo $this->Form->label('Name');
     		        echo $this->data['ShippingRate']['name']; 
     	        ?>
     		    </li>
     		    <?php if (array_key_exists('WeightBasedRate', $this->data)) { ?>
     		        <li>
         		    <?php
         		        echo $this->Form->label('Weight Range');
          		        echo "From " . $this->Number->format($this->data['WeightBasedRate']['min_weight'], array('places' => 2, 'escape' => false, 'decimals' => '.',));
                        echo "kg - ";
                        echo $this->Number->format($this->data['WeightBasedRate']['max_weight'], array('places' => 2, 'escape' => false, 'decimals' => '.',)) . "kg";
                        
         		        //echo 'From ' . range($this->data['WeightBasedRate']['min_weight']) . 'kg to ' . $this->data['WeightBasedRate']['max_weight'] ."kg";
         	        ?>
         		    </li>
    		    <?php } ?>
		        <?php if (array_key_exists('PriceBasedRate', $this->data)) { ?>
		            <li>
		            <?php
		                echo $this->Form->label('Order Subtotal Range');
		            ?>
		            <?php if ( $this->data['PriceBasedRate']['max_price'] !== null) echo 'From $' . $this->data['PriceBasedRate']['min_price'] . ' SDG to $' . $this->data['PriceBasedRate']['max_price']."SGD"; ?>
			
			        <?php if ( $this->data['PriceBasedRate']['max_price'] == null) echo 'From ' . $this->Number->currency($this->data['PriceBasedRate']['min_price']) . ' SGD and more';?>
		            </li>
		        <?php } ?>
     		    <li>
     		    <?php
     		        echo $this->Form->label('Price to ship');
     		        echo $this->Number->currency($this->data['ShippingRate']['price']);
     	        ?>
     		    </li>
     		    
     		</ul>
		</fieldset>
	</div>
		
	<div id="editForm" style="display:none">
	    <fieldset>
     		<legend><?php __('Edit this '.$legend_text.' rate'); ?></legend>
     		<ul class="shipping-view">
     		    <li>
     	        <?php
     	            $id = $this->data['ShippingRate']['id'];		
		            echo $this->Form->input('ShippingRate.shipped_to_country_id', array('type'=>'hidden'));
		            echo $this->Form->input('ShippingRate.id', array('type'=>'hidden'));
		            ?>
		            <strong>Name</strong>&nbsp;&nbsp;<span class="hint">(e.g. FedEx Standard International, Royal Mail Airmail)</span>
		            <div>
		                <?php echo $this->Form->input('ShippingRate.name', array('label' => FALSE, 'div' => FALSE, 'style' => "width: auto;"));?>
		            </div>
     		    </li>
     		    <?php
     		    if (array_key_exists('WeightBasedRate', $this->data)) { 
		            ?>
		            <li>
		                <strong>Weight</strong>&nbsp;&nbsp;<span class="hint"> only applies to orders with a total weight</span>
		                <div>
		                    <?php 		                    
        			        echo $this->Form->input('WeightBasedRate.id', array('type'=>'hidden'));
		                    echo $this->Form->text('WeightBasedRate.min_weight', array('style' => 'width: auto', 'size' => 5 ));
		                    echo ' kg - ';
		                    echo $this->Form->text('WeightBasedRate.max_weight', array('style' => 'width: auto', 'size' => 5));
		                    echo ' kg';
		                    ?>
		                </div>
		            </li>
		            <?php
			        
		        }
     		    ?>
    
		        <?php if (array_key_exists('PriceBasedRate', $this->data)) { ?>
		            <li>
		                <strong>Purchase range</strong>&nbsp;&nbsp;<span class="hint"> (before discounts and taxes)</span>
		                <div>
		                    <?php 		                    
        			        echo $this->Form->input('PriceBasedRate.id', array('type'=>'hidden'));
			                echo '$';
			                echo $this->Form->text('PriceBasedRate.min_price', array('style' => 'width: auto', 'label' => FALSE));
			                echo 'SGD';
			                ?>&nbsp;<a href="#" id="max-purchase-link-<?php echo $id ?>" onclick="showMaxPurchase('<?php echo $id;?>');return false;">and more</a>
			                <?php			                
			                $style = 'style="display:none"';
			                echo '<span id="max-purchase-'.$id.'" '. $style .'>';
			                echo ' - $'.$this->Form->text('PriceBasedRate.max_price', array('id'=>'max-price-input-'.$id, 'label' => FALSE, 'style' => 'width: auto;'));
			                echo 'SGD';
			                echo '</span>';
		                    ?>
		                </div>
		            <?php
		                
		            ?>
		            </li>
		        <?php } ?>
     		    <li>
     		    <?php
     		        echo $this->Form->input('ShippingRate.price', array('label'=>'Price to ship', 'style' => 'width: auto;'));
     	        ?>
     		    </li>
     		</ul>
		</fieldset>
	<?php echo $this->Form->submit(__('Update', true), array('div' => FALSE));?>&nbsp;or&nbsp;<a href="javascript: void(0)" onclick="toggleEditForm();return false;"><?php __('Cancel') ?></a>
	</div>
    <?php echo $this->Form->end();?>
</div>

<script>

	function toggleEditForm() {
		$('#editForm').toggle();
		$('#details').toggle();
		if ($('#details').is(':hidden')) {
		    $('#view_edit').html('View');
		} else {
		    $('#view_edit').html('Edit');
		}
	}
	
	function showMaxPurchase(id) {
		var maxPurchase = '#max-purchase-'+id;
		var maxPurchaseLink = '#max-purchase-link-'+id;
		var maxPriceInput = '#max-price-input-'+id;
		$(maxPurchase).show();
		$(maxPurchaseLink).hide();
		$(maxPurchase + ' input').focus();
		$(maxPriceInput).blur(function() {
			if (!($(maxPriceInput).val().length)) {
				$(maxPurchase).hide();
				$(maxPurchaseLink).show();
			}
		});
	}
</script>
	
