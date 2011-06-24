<?php echo $this->Html->script(array('jquery/jquery-1.4.2.min', 'ajaxupload'), array('inline' => false)); ?>
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
  <div style="float:left; margin-right: 10px; width: 58%;">
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
            <?php 

                if (!empty($product['Product']['options'])) {
                        foreach ($product['Product']['options'] as $field => $optionValues) :
	    ?>
				<label><?php __($field, false);?></label>
				<div class="property-info"><?php echo $optionValues;?></div>
				<div class="clear"></div>                    
            <?php
                                
                        endforeach;
                }
            ?>
            
            
      </fieldset>
     </div>
     <div id="collection">
        <fieldset>
          <legend><?php __('Collection', false);?></legend>
            <ul>
              
              <?php
              if (isset($product['ProductsInGroup']) && !empty($product['ProductsInGroup'])) :
                foreach ($product['ProductsInGroup'] as $collection):
                ?>
                <li>
                  <?php
		  $collection = $collection['ProductGroup'];
		  $action = ($collection['type'] == SMART_COLLECTION) ? 'view_smart' : 'view_custom';
		  echo $this->Html->link(__($collection['title'], true), array('action' => $action, $collection['id'])); ?>
                </li>
                
              <?php endforeach; endif;?>
	      
          </ul>
        </fieldset>
     </div>
  </div>
  <div style="float:left;width: 41%;">
    <fieldset>
          <legend><?php __('Product Images');?></legend>
    <div id="product-image">
        <ul id="product_images-list" class="product_image-thumbs">    
            <?php echo $this->element('product_images_ajax_list');?>
        </ul>
        <div class="clear"></div>
      <?php //echo $this->element('product_images_add_form_uploadify'); ?>
        
          <?php echo $this->Form->create('Product');?>
          <?php echo $this->Form->input('id', array('value' => $product['Product']['id']))?>
      <!--<form action="scripts/ajaxupload.php?filename=name&maxSize=9999999999&maxW=200&fullPath=http://www.atwebresults.com/php_ajax_image_upload/uploads/&relPath=../uploads/&colorR=255&colorG=255&colorB=255&maxH=300" method="post">-->
        <!--<input name="product_images" type="file" onchange = "ajaxUpload(this.form,'/products/save_image/'); return false;" />-->
        <?php
          if (count($product['ProductImage']) < 4) {
              $max = 4 - count($product['ProductImage']);
          ?>
              <input type="file" maxlength="4" class="multi max-<?php echo $max;?>" name="product_images[]" accept="gif|jpg|jpeg|png|ico|bmp" onchange= "ajaxUpload(this.form,'/admin/product_images/ajax_product_image_upload/'); return false;"/>
          <?php
          }
          ?>
        <?php 
          //echo $this->Form->input('ProductImage.0.filename', array('type' => 'file', 'class'=>'multi', 'onchange' => ));
          echo $this->Form->input('ProductImage.imagesCount', array('type'=>'hidden', 'value'=>count($product['ProductImage'])));
          //echo $this->Form->input('product_images', array('type' => 'file', 'onchange' => return false;", 'label' => false));
          ?>

        <input type="hidden" name="maxSize" id="maxSize" value="9999999999" />
        <input type="hidden" name="divToUpdate" id="divToUpdate" value="product_images-list" />
        <input type="hidden" name="loadMsg" id="loadMsg" value="File Uploading Please Wait..." />
        <input type="hidden" name="errMsg" id="errMsg" value="Error in Upload, check settings and path info in source code." />
        
        <?php echo $this->Form->end();?>
      <!--</form>-->
    </div>
</fieldset>
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

  var product_id = '<?php echo $product_id; ?>';
  
  
  function afterDelete(response) {
    var json_object = $.parseJSON(response);
  
    if (json_object.success) {
      var contents = $.parseJSON(json_object.contents);
      var id = '#product_image-' + contents.id;
      
      $(id).remove();
      
    } else {
      var contents = $.parseJSON(json_object.contents);
      var errors = contents.reason;
      
      alert(errors);
    } 
  }

  function makeThumbnail(filename) {
    var thumb = '<?php echo $this->Html->image("../uploads/products/thumb/small/dummy.jpg"); ?>&nbsp;';
    return thumb.replace('dummy.jpg',filename);
  }
  
  function makeActionLinks(id, filename, cover) {
    
    var deleteLink = $('div#dummyTrashLinkDiv').html();
    deleteLink = deleteLink.replace('fakefilename', filename);
    deleteLink = deleteLink.replace('dummy', id+'_elt');
    deleteLink = deleteLink.replace('0-' + product_id,  id + '-' + product_id);
    
    var featureLink = '';
    if (cover == 0) {
      featureLink = '<?php echo $this->Html->link($this->Html->image('x_solid_red_25.gif'),
            array('controller' => 'product_images', 'action' => 'make_this_cover', 'admin' => true, 'id' => 0, 'product_id' => $product_id),
            array('escape' => false));
          ?>';
      featureLink = featureLink.replace('0/cover', id +'/cover');
    } else {
      featureLink = '<?php echo $this->Html->image('tick.gif'); ?>';
    } 
    
    
    return deleteLink + featureLink;
    
  }
  
  function bindNewCallback(id, filename) {
  
    
    postUrl = "<?php echo Router::url(array('controller' => 'product_images', 'action' => 'delete', 'id'=>0, 'product_id'=>$product_id)); ?>";
    postUrl = postUrl.replace('0-' + product_id,  id + '-' + product_id);
    
    id = '#' + id+'_elt';

    $(id).bind('click', function() {
      if (confirm('Are you sure you want to delete '+filename+'?')) {
        $.ajax({
            async: true,
            type: 'post',
            beforeSend: function(request) {
          $('#busy-indicator').show();
            },
            complete: function(request, json) {
          afterDelete(request.responseText);
          $('#busy-indicator').hide()
            },
            url: postUrl
        });
      } else {
        return false;
      }
    });

  }
  
  function handlesUploadifyComplete(event, queueID, fileObj, response, data) {
  
  
    var json_object = $.parseJSON(response);
    
    var imageID = 0;
    var imageName = '';
    var cover = 0;
    
    if (json_object.success) {
      var contents = $.parseJSON(json_object.contents);
      imageID = contents.id;
      imageName = contents.filename;
      cover = contents.cover;
    } else {
      return false;
    }
  
  
    imageItem = '<li id="product_image-' + imageID + '"><div class="product_image-preview">';
    imageItem += makeThumbnail(imageName) + '</div>';
    imageItem += makeActionLinks(imageID, imageName, cover);
    imageItem += '</li>';
    
    
    $('#product_images-list').append(imageItem);
  
    bindNewCallback(imageID, imageName);
    
    return true;
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
      document.forms["ProductAdminEditForm"].submit();
      return false;
    } else {
      return true;
    }
    
  }

</script>

