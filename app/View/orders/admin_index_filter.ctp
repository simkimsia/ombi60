<?php echo $this->Form->create('Order', array('action' => 'index', 'id' => 'filters')); ?>
<table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?php echo $this->Paginator->sort('Order', 'order_no');?></th>
            <th class="actions">Actions</th>
        </tr>
        <tr>
            <th><?php echo $this->Form->input('order_no'); ?></th>
            <th>
                <button type="submit" name="data[filter]" value="filter">Filter</button>
                <button type="submit" name="data[reset]" value="reset">Reset</button>
            </th>
        </tr>
    </thead>
    <tbody>
        <?php
    $i = 0;
    foreach ($orders as $order):
            $class = null;
            if ($i++ % 2 == 0) {
                    $class = ' class="altrow"';
            }
    ?>
            <tr<?php echo $class;?>>
                    <td>
                            <?php echo $this->Html->link(__('#' . $order['Order']['order_no']), array('action' => 'view', $order['Order']['id'])); ?>
                            
                    </td>
            </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php echo $this->Form->end(); ?>
<div class="paging">
    <?php echo $this->Paginator->prev('<< '.__('previous'), array(), null, array('class' => 'disabled'));?>
    <?php echo $this->Paginator->numbers();?>
    <?php echo $this->Paginator->next(__('next').' >>', array(), null, array('class' =>' disabled'));?>
</div>
