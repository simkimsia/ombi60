<?php
	echo $this->Html->script('http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js');
	echo $this->Html->script('jquery/jquery.tools-1.2.ui-full.min');
?>
<div class="headingbg">
      <div class="imgcontainerhome">
        <div><img src="/nail-stickk/themes/default/images/cluedo-img.gif" alt="" width="143" height="140" /></div>
      </div>
      <div class="productrgtcontainer">
        <h2><?php echo $product['Product']['title']; ?><span> $<?php echo $product['Product']['price']; ?></span></h2>

        <p><strong>Description of polo shirt</strong></p>
        <div class="productformcontainer">
          <label>Title:</label>
          <select name="lsttittle" id="lsttittle">
            <option>Default Title</option>
          </select>
          <div class="clrbth"></div>

          <label>Something:</label>
          <select name="lstvalue" id="lstvalue">
            <option>Value</option>
          </select>
          <div class="clrbth"></div>
          <label>Color:</label>
          <select name="lstcolor" id="lstcolor">

            <option>Color</option>
          </select>
          <div class="clrbth"></div>
        </div>
        <div class="pricecontainer">$70.00 SGD</div>
        <input type="submit" name="btnadd" id="btnadd" class="cominput addcart" value="Add to cart" />
        <p class="clrbth">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed in magna sed dolor cursus mattis. Duis at nibh ac elit ultricies tristique. Vestibulum eleifend purus tempus nisl venenatis euismod. Sed ultrices ante quis ipsum porttitor vulputate. Duis vel turpis ut lorem elementum tristique eget nec nunc. Curabitur vel mi vel lectus congue sollicitudin nec eleifend massa. Curabitur h	endrerit mattis mauris sit amet convallis. Suspendisse suscipit lobortis mi, id convallis ipsum posuere at. </p>

        <p>Vivamus ultricies suscipit risus, nec ultrices justo semper id. Duis nunc sem, ornare quis varius vel, placerat id lectus. Proin id tortor non est tincidunt pellentesque in vitae nulla. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. </p>
      </div>
      <div class="clrbth"></div>
    </div>