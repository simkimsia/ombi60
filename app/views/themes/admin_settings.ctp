<?php echo $this->Javascript->link('jquery-collapsiblePanel.js', false); ?>
<script language="javascript" type="text/javascript">
    $(document).ready(function() {
       // $(".collapsable-container").collapsiblePanel();
    /*  $('div.collapsable-container fieldset legend').hide();
      $(".collapsable-container").collapsiblePanel(); */
      $("fieldset").collapse();
		$("fieldset.startClosed").collapse( { closed: true } );

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

/*function buildTag($key,$element,$html='',&$counter) {
    $counter++;
    if (!is_numeric($key) && !is_array($element) && in_array($key,$_allowedHtmlElemnts)) {
        $html .= '<'.$key.'>'.$element.'</'.$key.'>';                    
    }elseif(!is_numeric($key) && is_array($element) && in_array($key,$_allowedHtmlElemnts)) {
       if (isset($element[0]) && !is_array($element)) {
          $tag = '<'.$key." ";
          foreach($element as $attrKey => $attrVal) {
             if (substr($attrKey,0,1) == '@') {
                  $tag .= "$attrKey=$attrVal ";
             }
          }
          $tag .= ">".$element[0]."</".$key.">";
          $html .= $tag;
       } elseif(isset($element[0]) && is_array($element[0]) ) {
           //buildTag();
           $html .= '<'.$key.'>';
           foreach ($element as $innerTag => $innerHtml) {
                $html .= buildTag($innerTag,$innerHtml);
           }
       }
    } elseif (is_numeric($key) && is_array($element)) {
            foreach ($element as $innerTag => $innerHtml) {
                $html .= buildTag($innerTag,$innerHtml);
            }
    }
    if ($counter > 50) {
      echo "<br>in infinite loop "; exit;
    }
    return $html;
} */

function buildTag($key,$element,$counter,$html='') {
    //$html='';
    //echo "<br>here ";
    //global $Settingsform; echo "<br>SETTINGS FORM"; print_r($Settingsform); exit;
    $_allowedFormElements = array('input','select','textarea');
    $_unallowedElements = array('form');
    $_allowedHtmlElemnts = array('legend','table','tbody','tr','td','p','div','span');
    $counter++;
    //echo "<br> ";
    /*if ($key == 'select') {
       //$html .= $this->Settingsform->select($element);
    } else { */
    if ($key == 'select') {
       $html .= $Settingsform->select($element); 
    } elseif (!is_numeric($key) && !is_array($element) ) {
        echo "<br>FIRST IF ";
        $html .= '<'.$key.'>'.$element.'</'.$key.'>';   
        
       // echo $html;                 
    }elseif(!is_numeric($key) && is_array($element) ) {
        //echo "<br>2 IF ";
       if (isset($element[0]) && !is_array($element[0])) {
          $tag = '<'.$key." ";
          foreach($element as $attrKey => $attrVal) {
             if (substr($attrKey,0,1) == '@') {
                  $tag .= "$attrKey=$attrVal ";
             }
          }
          $tag .= ">".$element[0]."</".$key.">";
          $html .= $tag;
       } elseif(isset($element[0]) && is_array($element[0]) ) {
           //buildTag();
           $html .= '<'.$key.'>';
           foreach ($element as $innerTag => $innerHtml) {
                $html .= buildTag($innerTag,$innerHtml,$counter);
           }
           $html .= '</'.$key.'>';
       } elseif (!isset($element[0]) && is_array($element)) {
           $html .= '<'.$key.' ';
           $attr = '';
           $newhtml = '';
           foreach ($element as $innerTag => $innerHtml) {
                if (substr($innerTag,0,1) == '@') {
                   $attr .= substr($innerTag,1) ."=" .$innerHtml ." ";
                } else {
                   $newhtml .= buildTag($innerTag,$innerHtml,$counter);
                }
           }
           $html .= $attr. '>'.$newhtml;
           $html .= '</'.$key.'>';
       }
       //echo $html;
    } elseif (is_numeric($key) && is_array($element)) {
       // echo "<br>3 IF ";print_r($element);
            foreach ($element as $innerTag => $innerHtml) {
                 //echo "<br>innerhtml in 3rd";print_r($innerHtml);
                 
                $html .= buildTag($innerTag,$innerHtml,$counter);
                //echo "<br>build html----------------- innerTag :: ".$innerTag."<br><br>".$html;
               // ;
               
                
            }
        //echo $html;    
    }
    //}
    //echo "<br>COUNTER :: $counter";
    if ($counter > 50) {
      echo "<br>in infinite loop "; exit;
    }
    return $html;
}

echo "<br>HERE ";
//print_r($HtmlArray); exit;
$_allowedFormElements = array('input','select','textarea');
$_unallowedElements = array('form');
$_allowedHtmlElemnts = array('legend','table','tbody','tr','td','p','div','span');
 if (isset($HtmlArray['html']['body']['fieldset']) && is_array($HtmlArray['html']['body']['fieldset']) && !empty($HtmlArray['html']['body']['fieldset'])) {
      echo $this->Form->create('Theme',array('enctype' => 'multipart/form-data'));
      ?>
      <!--<form id="ThemeAdminSettingsForm" accept-charset="utf-8" action="/admin/themes/settings" method="post">-->
      <?php
      foreach ($HtmlArray['html']['body']['fieldset'] as $fieldset) { 
         //foreach($fieldsets as $fieldset) {
         
          // echo "<br>FIELD SET";
           ?>
             <div class="collapsable-container">
         
          
             <?php
               /*foreach ($fieldset as $key => $element) {
                  $tag = "";
                  if (!is_numeric($key) && !is_array($element) && in_array($key,$_allowedHtmlElemnts)) {
                    $tag .= '<'.$key.'>'.$element.'</'.$key.'>';
                    
                  } elseif() {
                  
                  }
                  
               }*/
               
               if (isset($fieldset['legend'])) {
                 echo "<h3 class=\"section-header\">".$fieldset['legend']."</h3>";
               }
               
               echo "<fieldset>";
                echo $this->settingsform->buildTag(0,$fieldset,1);
             ?>
           
           </fieldset> 
             </div>
       <?php 
         //}
       
      }
      
      echo $this->Form->end('Apply changes');
      ?>
      <!--<input type="submit" value="submit" name="submit">
      </form> -->
      <?php
 }
?>
