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
                echo (float)$shippingRate['WeightBasedRate']['min_weight'] . ' - ' . (float)$shippingRate['WeightBasedRate']['max_weight'];
        }

?>