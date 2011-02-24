<div class="internal_forms">
    <div class="text_center">
        <h1><?php __($this->Form->value('Blog.name'));?></h1>
        <?php echo $this->Html->link(__('View', true), array('controller'=>'blogs','action' => 'view', $this->Form->value('Blog.id'))); ?>|
        <?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Blog.id')), null, sprintf(__('Are you sure you want to delete this blog?', true), $this->Form->value('Blog.id'))); ?>|
        <?php echo $this->Html->link(__('Back to Blogs', true), array('controller'=>'webpages','action' => 'index')); ?>
    </div>


<?php echo $this->Form->create('Blog', array(
                                        'inputDefaults' => array(
                                                            'div' => FALSE,
                                                            'label' => FALSE,
                                                           )
                                        ));?>
<?php echo $this->Form->input('id');?>
	<fieldset>
 		<legend><?php __('Edit this Blog'); ?></legend>
 		<label><?php __('Title');?></label>
    	<?php echo $this->Form->input('name', array('label' => FALSE, 'div' => FALSE,));?>
    	<br />
	    <?php
	    $label = $this->Form->label('handle', 'Permalink/handle');
	    $textbox = $this->Form->text('Blog.short_name');
	    $prefix = Router::url('/blogs/', true);
	    $whats_this = "&nbsp;( ".$this->Html->link("Whats this?", '#', array())." )";
	    echo $this->Html->div('slug_text', $label.$prefix.$textbox.$whats_this ,array(), true);

	    ?>
	</fieldset>
<?php echo $this->Form->submit(__('Update', true), array('div' => FALSE,));?>&nbsp;OR&nbsp;
<?php echo $this->Html->link(__('Cancel', true), array('controller'=>'webpages','action' => 'index')); ?>
<?php echo $this->Form->end();?>
</div>

