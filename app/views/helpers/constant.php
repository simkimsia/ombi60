<?php
/* /app/views/helpers/constant.php */

class ConstantHelper extends AppHelper {
        function displayPayment($constantValue) {
                switch($constantValue) {
                        case PAYMENT_ABANDONED :
                        return 'abandoned';
        
                        case PAYMENT_AUTHORIZED :
                                return 'authorized';
        
                        case PAYMENT_PAID :
                                return 'paid';
                        case PAYMENT_PENDING :
                                return 'pending';
        
                        default :
                                return '';
                }
        }
        
        function displayFulfillment($constantValue) {
                switch($constantValue) {
                        case FULFILLMENT_FULFILLED :
                                return 'fulfilled';
        
                        case FULFILLMENT_NOT_FULFILLED :
                                return 'not fulfilled';
        
                        case FULFILLMENT_PARTIAL :
                                return 'partial';
                        default :
                                return '';
                }
        }
}

?>