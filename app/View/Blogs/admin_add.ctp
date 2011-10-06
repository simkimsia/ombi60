<div class="internal_forms">
    <div class="text_center">
        <h2><?php echo __('Add your New Blog');?></h2>
        <?php echo $this->Html->link(__('Cancel'), array('controller'=>'webpages','action' => 'index')); ?>
    </div>


<?php echo $this->Form->create('Blog');?>
	<fieldset>
 		<legend><?php echo __('New Blog'); ?></legend>
 		<label><?php echo __('Title');?></label>
 		<span class="hint">Examples: News, Behind the Scenes</span>
	<?php
		echo $this->Form->input('title', array('label' => FALSE, 'div' => FALSE,));
		
	?>
	</fieldset>
  <div class="submit">
    <?php echo $this->Form->submit(__('Create Blog'), array('div' => FALSE,));?>&nbsp;or&nbsp;
    <?php echo $this->Html->link(__('Cancel'), array('controller'=>'webpages','action' => 'index')); ?>
  </div>  
<?php echo $this->Form->end();?>
</div>
