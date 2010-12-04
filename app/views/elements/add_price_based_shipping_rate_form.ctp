<?php
        echo '<tr id="price-form-'.$id.'" style="display:none;"><td colspan="4">';
        echo $this->Form->create('ShippingRate', array('url'=>array('action'=>'add_price_based',
                                                       'country_id'=>$country)));
        echo '<table class="new-rate-table">';
        
        echo '<tr><td class="new-rate rate-name">';
        echo $this->Form->input('ShippingRate.name', array('div'=>false,
                                                           'style'=>'width:100%;'));
        echo '</td>';
        
        echo '<td class="new-rate rate-weight">';
        echo $this->Form->label('Purchase range');
        echo '$';
        echo $this->Form->text('PriceBasedRate.min_price', array('value'=>'50.00'));
        echo 'SGD';
        
        echo '&nbsp;<a href="#" id="max-purchase-link-'.$id.'" onclick="showMaxPurchase('.$id.');return false;">and more</a>';
        echo '<span id="max-purchase-'.$id.'" style="display:none;">';
        echo $this->Form->text('PriceBasedRate.max_price', array('id'=>'max-price-input-'.$id));
        echo 'SGD';
        echo '</span>';
        echo '</td>';
        
        echo '<td class="new-rate rate-price">';
        echo $this->Form->label('Shipping Price');
        echo $this->Form->text('ShippingRate.price', array('value'=>'0.00'));
        echo '</td></tr>';
        
        echo '<tr><td>';
        echo '<div class="submit">';
        echo $this->Form->input('ShippingRate.shipped_to_country_id', array('type'=>'hidden','value'=>$id));
        echo $this->Ajax->submit('Add Shipping Rate', array('url'=>array('action'=>'add_price_based',
                                                       'country_id'=>$country),
                                                       'complete' => "afterAddRate($id, request.responseText);",
                                                       'div'=>false));
        
        echo '&nbsp;or&nbsp;<a href="#" onclick="$(\'#price-form-'.$id.'\').hide();return false;">Cancel</a>';
        echo '</div>';
        
        echo '</td></tr>';
        echo '</table>';
        echo $this->Form->end();
        echo '</td></tr>';
?>