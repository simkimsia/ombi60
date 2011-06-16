<?php   
    //echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js');
  
  // include uploadify specific js files
  //echo $this->Html->script('/uploadify/js/jquery.uploadify.v2.1.0.min');
  //echo $this->Html->script('/uploadify/js/swfobject');
  
  //echo $this->element('jquery_uploadify_js', array('plugin' => 'uploadify'));
  
  echo $this->Html->script('ajaxupload', array('inline' => false));
  ?>

<style>
  #properties label{
    background: #e4e4e4;
    float: left;
    text-align: right;
    width: 50%;
    border: 1px solid #CCC;
    padding: 5px;
    margin-right: 2px;
    margin-bottom: 1px;
  }

  .property-info {
    padding: 5px;
  }
</style>
<div class="products view">
  <div class="text_center">
        <h2>
          <?php echo $product['Product']['title']; ?>
        </h2>
        <?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $product['Product']['id'])); ?>
        &nbsp;|&nbsp;
          <?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $product['Product']['id']), null, sprintf(__('Are you sure you want to delete this product?', true), $product['Product']['id'])); ?>&nbsp;|&nbsp;
          <?php echo $this->Html->link(__('Back to Products', true), array('action' => 'index')); ?>
  </div>
  <div style="float:left; margin-right: 10px; width: 60%;">
    <div id="description">
      <fieldset>
        <legend><?php __('Description');?></legend>
        
          <?php echo $product['Product']['description']; ?>
      </fieldset>
     </div>
     <div id="properties">
      <fieldset>
          <legend>Properties</legend>

            <label><?php __('SKU Code', false);?></label>
            <div class="property-info"><?php echo (($product['Product']['code']!="") ? $product['Product']['code'] : '');?></div>
            <div class="clear"></div>
            <label><?php __('Price', false);?></label>
            <div class="property-info"><?php echo (($product['Product']['price']!="") ? $product['Product']['price'] : '');?></div>
            <div class="clear"></div>
            <label><?php __('Weight', false);?></label>
            <div class="property-info"><?php echo (($product['Product']['weight']!="") ? $product['Product']['weight'] : '');?></div>
            <div class="clear"></div>
      </fieldset>
     </div>
     <div id="collection">
        <fieldset>
          <legend><?php __('Collection', false);?></legend>
            <ul>
              <?php
              $i = 0;
              foreach ($smartCollections as $smartCollectionName => $smartCollectionInfo):  
              ?>
                <?php 
                  $collection = explode('::', $smartCollectionName);
//debug($smartCollectionInfo);
?>               
                <li>
                    <?php echo $this->Html->link($collection[0], array('controller' => 'smart_collections', 'action' => 'view', $collection[1])); 
                          if (!empty($smartCollectionInfo['condition'])) {                  
                            echo "<br />";
                            foreach ($smartCollectionInfo['condition'] as $smartCondition) {
                              echo "<span class='hint'>";
                              echo Inflector::camelize($smartCondition['field']) . " is ".$smartCondition['relation'] . " '". $smartCondition['condition']."'";
                              echo "</span>";
                              echo "<br />";
                            }
                          }
                          ?>
                </li>      
              <?php endforeach; ?>

              <?php
              foreach ($customCollections as $collection):
              ?>
              <li>
                <?php echo $this->Html->link(__($collection['ProductGroup']['title'], true), array('action' => 'view_custom', $collection['ProductGroup']['id'])); ?>
              </li>
              
            <?php endforeach; ?>
          </ul>
        </fieldset>
     </div>
  </div>
  <div style="float:left;width: 35%;">
    <div id="product-image">
      <?php //echo $this->element('product_images_add_form_uploadify'); ?>
      <?php echo $this->Form->create('Product');?>
        <fieldset>
          <legend><?php __('Product Images');?></legend>
      <!--<form action="scripts/ajaxupload.php?filename=name&maxSize=9999999999&maxW=200&fullPath=http://www.atwebresults.com/php_ajax_image_upload/uploads/&relPath=../uploads/&colorR=255&colorG=255&colorB=255&maxH=300" method="post">-->
        <p><input type="file" name="name" onchange="ajaxUpload(this.form,'scripts/ajaxupload.php?filename=name&maxSize=9999999999&maxW=200&fullPath=http://www.atwebresults.com/php_ajax_image_upload/uploads/&relPath=../uploads/&colorR=255&colorG=255&colorB=255&maxH=300','upload_area','File Uploading Please Wait...&lt;br /&gt;&lt;img src=\'images/loader_light_blue.gif\' width=\'128\' height=\'15\' border=\'0\' /&gt;','&lt;img src=\'images/error.gif\' width=\'16\' height=\'16\' border=\'0\' /&gt; Error in Upload, check settings and path info in source code.'); return false;" /></p>
          </fieldset>
        <?php echo $this->Form->end();?>
      <!--</form>-->
    </div>
    <div class="clear"></div>
    <div id="visibility">
      <fieldset>
        <legend><?php __('Product Visibility');?></legend>
        <?php 
            echo $this->Form->input('Product.visible',array('options' => array('1'=>'Published', '0'=>'Hidden'), 'label' => false, 'selected' => $product['Product']['visible'])); 
            ?>
      
      <?php 
          echo $this->Ajax->observeField( 'ProductVisible', 
        array(
            'url' => array( 'action' => 'toggle',
              'controller' => 'products',
              'admin' => true,
              $product['Product']['id']),
            //'complete' => 'alert(request.responseText)'
        ) 
          ); 
      ?>
      </fieldset>
    </div>
  </div>
  <div class="clear"></div>

  <div id="varients">
    Varients Here
  </div>


<script type="text/javascript" language="javascript">
  
  var newAltId = 0;

  function handlesUploadifyAllComplete(event, data) {
    $('#alt_id').attr('value', newAltId);
    
    document.forms["ProductAdminAddForm"].submit();
  }

  
  function ajaxCompleteFunction(response) {
    
    var json_object = $.parseJSON(response);
    
    if (json_object.success) {
      
      var contents = $.parseJSON(json_object.contents);
      
      var script = '<?php echo $uploadifySettings['script']; ?>';
      $('#fileInput').uploadifySettings('script', script + '/' + contents.id + '<?php echo "?sess=".$this->Session->id();?>');
      newAltId = contents.id;
      
      
      
      $('#fileInput').uploadifyUpload();
      
      
    } else {
      var contents = $.parseJSON(json_object.contents);
      var errors = contents.reason;
      
      if (errors['title'].length > 0 ) {
        
        if ($('#title-error-msg').length == 0) {
          $('#ProductTitle').before('<div id="title-error-msg" class="error-message">' + errors['title'] + '</div>'); 
        } else {
          $('#title-error-msg').text(errors['title']);
        }
        
        
      } 
      
    }
    
  }
  
  
  function ajaxConditionFunction() {
    
    queueSize = $('#fileInput').uploadifySettings('queueSize');
    if (queueSize == 0) {
      document.forms["ProductAdminAddForm"].submit();
      return false;
    } else {
      return true;
    }
    
  }


</script>
