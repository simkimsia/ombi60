<?php
        echo '<tr id="weight-form-'.$id.'" style="display:none;"><td colspan="4">';
        echo $this->Form->create('ShippingRate', array('url'=>array('action'=>'add_weight_based',
                                                       'country_id'=>$country)
                                                       ));
        echo '<table class="new-rate-table">';
        
        echo '<tr><td class="new-rate rate-name">';
        echo $this->Form->input('ShippingRate.name', array('div'=>false,
                                                           'style'=>'width:100%;'));
        echo '</td>';
        
        echo '<td class="new-rate rate-weight">';
        echo $this->Form->label('Weight');
        echo $this->Form->text('WeightBasedRate.min_weight', array('value'=>'0.0', 'size'=>'3'));
        echo 'kg - ';
        echo $this->Form->text('WeightBasedRate.max_weight', array('value'=>'25.0', 'size'=>'3'));
        echo 'kg';
        echo '</td>';
        
        echo '<td class="new-rate rate-price">';
        echo $this->Form->label('Shipping Price');
        echo $this->Form->text('ShippingRate.price', array('value'=>'0.00'));
        echo '</td></tr>';
        
        echo '<tr><td>';
        echo '<div class="submit">';
        echo $this->Form->input('ShippingRate.shipped_to_country_id', array('type'=>'hidden','value'=>$id));
        echo $this->Ajax->submit('Add Shipping Rate', array('url'=>array('action'=>'add_weight_based',
                                                       'country_id'=>$country),
                                                       'complete' => "afterAddRate($id, request.responseText);",
                                                       'div'=>false));

        
        echo '&nbsp;or&nbsp;<a href="#" onclick="$(\'#weight-form-'.$id.'\').hide();return false;">Cancel</a>';
        echo '</div>';
        
        echo '</td></tr>';
        echo '</table>';
        echo $this->Form->end();
        echo '</td></tr>';
?>