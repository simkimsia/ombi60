<?php echo $this->Javascript->link('jquery-collapsiblePanel.js', false); ?>
<script language="javascript" type="text/javascript">
    $(document).ready(function() {
      
        $('div.collapsable-container fieldset legend').hide();  
        $(".collapsable-container").collapse({ closed: true });
		    //$(".collapsable-container").collapse( { closed: true } );
		    $(".collapsable-container h3:first").removeClass('collapsed').addClass('collapsible');

    });
</script>    
<div class="themes form">
<?php echo $this->Form->create('Theme');?>
	<fieldset>
 		<legend><?php printf(__('Add %s', true), __('Theme', true)); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->Form->input('author');
		echo $this->Form->input('available_for_all');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Themes', true)), array('action' => 'index'));?></li>
		
		
	</ul>
</div>
<?php

$_allowedFormElements = array('input','select','textarea');
$_unallowedElements = array('form');
$_allowedHtmlElemnts = array('legend','table','tbody','tr','td','p','div','span');
 if (isset($HtmlArray['html']['body']['fieldset']) && is_array($HtmlArray['html']['body']['fieldset']) && !empty($HtmlArray['html']['body']['fieldset'])) {
      echo $this->Form->create('Theme',array('enctype' => 'multipart/form-data'));
      ?>
     
      <?php
      if (isset($HtmlArray['html']['body']['fieldset'][0]) && is_array($HtmlArray['html']['body']['fieldset'][0])) {
          foreach ($HtmlArray['html']['body']['fieldset'] as $fieldset) { 
            
               ?>
                 <div class="collapsable-container collapsed">
                       
                 <?php
                                  
                   if (isset($fieldset['legend'])) {
                     echo "<h3 class=\"section-header\">".$fieldset['legend']."</h3>";
                   }
                   
                   echo "<fieldset>";
                    echo $this->settingsform->buildTag(0,$fieldset,1);
                 ?>
               
                </fieldset> 
                 </div>
           <?php                        
          }
      } else {
        ?>
           <div class="collapsable-container">
              <?php
                              
               if (isset($HtmlArray['html']['body']['fieldset']['legend'])) {
                 echo "<h3 class=\"section-header\">".$HtmlArray['html']['body']['fieldset']['legend']."</h3>";
               }
               
               echo "<fieldset>";
                echo $this->settingsform->buildTag(0,$HtmlArray['html']['body']['fieldset'],1);
             ?>    
           </div>
      <?php            
             
      }
      echo $this->Form->end('Apply changes');
  
 }
?>
