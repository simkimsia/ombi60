<?php
        $checkoutLink = Configure::read('currentCheckoutLink');
        echo $this->Html->link(__('Checkout'), $checkoutLink);
?>