<?php
if ($shippingRate['PriceBasedRate']['id'] > 0) {
        $output = $this->Number->currency($shippingRate['PriceBasedRate']['min_price']);
        if ($shippingRate['PriceBasedRate']['max_price'] != null) {
                $output .= ' - ' . $this->Number->currency($shippingRate['PriceBasedRate']['max_price']);
        } else {
                $output = __('Minimum', true) . ' ' . $output;
        }
        echo $output;
} else if ($shippingRate['WeightBasedRate']['id'] > 0) {
        echo $this->Number->format($shippingRate['WeightBasedRate']['displayed_min_weight'], array('places' => 2, 'before' => FALSE, 'escape' => false, 'decimals' => '.',));
        echo $unitForWeight . " - ";
        echo $this->Number->format($shippingRate['WeightBasedRate']['displayed_max_weight'], array('places' => 2, 'before' => FALSE, 'escape' => false, 'decimals' => '.',)) . $unitForWeight;
}
?>
