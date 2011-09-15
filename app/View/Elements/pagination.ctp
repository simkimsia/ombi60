<?php 
if ($this->Paginator->params['paging'][$modelName]['pageCount'] > 1) {
?>
    
        <div>
            <?php
        echo $this->Paginator->counter(array(
        'format' => __('%page%-%pages% of %count%')
        ));
        ?>
        
            <?php echo $this->Paginator->prev('<< ' . __('previous'), array(), null, array('class'=>'disabled'));?>		            &nbsp;|&nbsp;<?php echo $this->Paginator->next(__('next') . ' >>', array(), null, array('class' => 'disabled'));?>
        </div>
<?php
}
?>
