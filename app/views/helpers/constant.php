<?php
/* /app/views/helpers/constant.php */

class ConstantHelper extends AppHelper {
        function displayPayment($constantValue) {
                switch($constantValue) {
                        case PAYMENT_ABANDONED :
                        return 'Abandoned';
        
                        case PAYMENT_AUTHORIZED :
                                return 'Authorized';
        
                        case PAYMENT_PAID :
                                return 'Paid';
                        case PAYMENT_PENDING :
                                return 'Pending';
        
                        default :
                                return '';
                }
        }
        
        function displayFulfillment($constantValue) {
                switch($constantValue) {
                        case FULFILLMENT_FULFILLED :
                                return 'Fulfilled';
        
                        case FULFILLMENT_NOT_FULFILLED :
                                return 'Not Fulfilled';
        
                        case FULFILLMENT_PARTIAL :
                                return 'Partial';
                        default :
                                return '';
                }
        }
}

?>
