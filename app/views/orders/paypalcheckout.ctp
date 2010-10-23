<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html lang="en">
<head>
    <title><!-- Insert your title here --></title>
</head>
<body>
    <!-- Insert your content here -->
    <!-- required action url for form -->
    
    <!-- for sandbox https://www.sandbox.paypal.com/cgi-bin/webscr -->
    <!-- LIVE https://www.paypal.com/cgi-bin/webscr -->
    <?php
        $paypalSandboxUrl = "https://www.sandbox.paypal.com/cgi-bin/webscr";
        $paypalLiveUrl = "https://www.paypal.com/cgi-bin/webscr";
        
        $test = true;
        
        $paypalUrl = $paypalLiveUrl;
        
        if ($test) {
            $paypalUrl = $paypalSandboxUrl;
        }
    ?>
    
    <form action="<?php echo $paypalUrl; ?>" method="post">
        <!-- necessary inputs -->    
        <input type="hidden" name="cmd" value="_cart">
        <input type="hidden" name="upload" value="1">
        <!-- variable business email associated with paypal account -->
        <input type="hidden" name="business" value="merch_1277746388_biz@gmail.com">
            
        <!-- item 1 title -->
        <input type="hidden" name="item_name_1" value="Item Name 1">
        <!-- item 1 price -->
        <input type="hidden" name="amount_1" value="1.00">
        <!-- item 1 quantity -->
        <input type="hidden" name="quantity_1" value="2">
            
        <input type="hidden" name="item_name_2" value="Item Name 2">
        <input type="hidden" name="amount_2" value="2.00">
        <input type="hidden" name="quantity_2" value="1">
            
        <!-- submit button -->
        <input type="submit" value="PayPal">
    </form> 
</body>
</html>
