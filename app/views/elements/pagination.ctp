<?php 
if ($paginator->params['paging'][$modelName]['pageCount'] > 1) {
?>
    
        <div>
            <?php
        echo $this->Paginator->counter(array(
        'format' => __('%page%-%pages% of %count%', true)
        ));
        ?>
        
            <?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>		            &nbsp;|&nbsp;<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
        </div>
<?php
}
?>
