<div class="internal_forms main-container-div">
    <div class="text_center">
        <h2><?php __('Add your New Blog');?></h2>
        <?php echo $this->Html->link(__('Cancel', true), array('controller'=>'webpages','action' => 'index')); ?>
    </div>


<?php echo $this->Form->create('Blog');?>
	<fieldset>
 		<legend><?php __('New Blog'); ?></legend>
 		<label><?php __('Title');?></label>
 		<span class="hint">Examples: News, Behind the Scenes</span>
	<?php
		echo $this->Form->input('name', array('label' => FALSE, 'div' => FALSE,));
		
	?>
	</fieldset>
  <div class="submit">
    <?php echo $this->Form->submit(__('Create Blog', true), array('div' => FALSE,));?>&nbsp;or&nbsp;
    <?php echo $this->Html->link(__('Cancel', true), array('controller'=>'webpages','action' => 'index')); ?>
  </div>  
<?php echo $this->Form->end();?>
</div>
