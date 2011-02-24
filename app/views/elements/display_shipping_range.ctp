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
        echo $this->Number->format($shippingRate['WeightBasedRate']['min_weight'], array('places' => 2, 'escape' => false, 'decimals' => '.',));
        echo "kg - ";
        echo $this->Number->format($shippingRate['WeightBasedRate']['max_weight'], array('places' => 2, 'escape' => false, 'decimals' => '.',)) . "kg";
}
?>
