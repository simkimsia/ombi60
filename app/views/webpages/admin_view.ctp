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
    <?php echo $webpage['Webpage']['text']; ?>
  </div>
  <div>
    <fieldset>
        <legend>Properties</legend>
        <label><?php __('Page Visibility');?></label>
 		<span class="hint">If you want to hide this page from your clients, choose hidden.</span>
 		<br>
 		<?php 
        echo $this->Form->input('visible',array('options' => array('1'=>'Published', '0'=>'Hidden'), 'label' => false, 'selected' => $webpage['Webpage']['visible'])); 
         ?>
        <?php //print ((bool)$webpage['Webpage']['visible'] ? "Published" : "Hidden")?>
        <br>        
        <?php 
        
  		echo $this->Form->input('Webpage.author', array('options' => $authors, 'selected' => $webpage['Author']['full_name']));
  		
        //print $webpage['Author']['full_name'];?>
        <br>
    </fieldset>
  </div>	
</div>
