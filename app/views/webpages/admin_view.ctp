<?php
echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js');
echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.7/jquery-ui.min.js');
?>
<div class="webpages">
    <div class="text_center">
        <h2>
          <?php echo $webpage['Webpage']['title']; ?>
        </h2>
        <?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $webpage['Webpage']['id'])); ?>
        &nbsp;|&nbsp;
          <?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $webpage['Webpage']['id']), null, sprintf(__('Are you sure you want to delete this page?', true), $webpage['Webpage']['id'])); ?>&nbsp;|&nbsp;
          <?php echo $this->Html->link(__('Back to Pages', true), array('action' => 'index')); ?>
  </div>
  <div class="view_textarea">
    <?php echo $webpage['Webpage']['content']; ?>
  </div>
  <div>
    <fieldset>
        <legend>Properties</legend>
        <label><?php __('Page Visibility');?></label>
 		<span class="hint">If you want to hide this page from your clients, choose hidden.</span>
 		<br>
 		<?php 
        echo $this->Form->input('Webpage.visible',array('options' => array('1'=>'Published', '0'=>'Hidden'), 'label' => false, 'selected' => $webpage['Webpage']['visible'])); 
         ?>
	 
	 <?php 
	    echo $this->Ajax->observeField( 'WebpageVisible', 
		array(
		    'url' => array( 'action' => 'toggle',
				   'controller' => 'webpages',
				   'admin' => true,
				   $webpage['Webpage']['id']),
		    //'complete' => 'alert(request.responseText)'
		) 
	    ); 
	?>
	 
        <br>        
        <?php 
        
  		echo $this->Form->input('Webpage.author', array('options' => $authors, 'selected' => $webpage['Author']['full_name']));
  		
        //print $webpage['Author']['full_name'];?>
        <br>
    </fieldset>
  </div>	
</div>
