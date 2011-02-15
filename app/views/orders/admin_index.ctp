<div class="orders index products_index">
<h2><?php __('Orders');?></h2>
<?php echo $this->Form->create('Order', array('url' => array('controller' => 'orders', 'action' => 'index', 'admin' => 'true'), 'id'=>'filters')); ?>

  <table class="table_with_border table_without_bottom_border">
    <tr>
		    <th><?php __('Order');?></th>
		    <th><?php __('Placed by');?></th>
		    <th><?php __('Payment Status');?></th>
		    <th><?php __('Fullfillment Status');?></th>
		    <th><?php __('Amount');?></th>
		    <th class="actions" colspan="2">&nbsp;</th>
    </tr>
		<tr>
        <th><?php echo $this->Form->input('Order.order_no', array('label'=>false)); ?></th>
        <th><?php echo $this->Form->input('User.full_name', array('label'=>false)); ?></th>
        <th><?php echo $this->Form->input('Order.payment_status', array('options' => array('0'=>'Abandoned','1'=>'Authorized', '2'=>'Paid', '3'=>'Pending'),
										    'empty' => 'Any status',
										    'label' => false)); ?></th>
        <th><?php echo $this->Form->input('Order.fulfillment_status', array('options' => array('0'=>'Fulfilled','1'=>'NOT fulfilled', '2'=>'Partially fulfilled'),
										    'empty' => 'Any status',
										    'label' => false)); ?></th>
        <th><?php echo $this->Form->input('Order.amount', array('label'=>false)); ?></th>
        <th><button type="submit" name="data[filter]" value="filter">Filter</button></th>
        <th><button type="submit" name="data[reset]" value="reset">Reset</button></th>
        </th>
      </tr>
   </table>
   <div>
           <div style="float:left;clear:none;">
            <?php
              echo $paginator->counter(array(
              'format' => __('Page %page% of %pages%, showing %current% records out of %count% total', true)
              //'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
              ));
            ?>
          </div> 
           <div class="paging" style="float:right;clear:none;padding:0 40px 0 0;margin:0px;">
  <?php //if have pagination 
  if ($paginator->numbers()){ 
    echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'))." | ";
    if ($paginator->counter(array('format' => __('%pages%', true)))>2) echo $paginator->numbers()." | ";
    echo $paginator->next(__('next', true).' >>', array(), null, array('class' => 'disabled')); }?> 
          </div> 
  </div>          
<table cellpadding="0" cellspacing="0" class="table_with_border order_list">
	<tr>
		<th><?php echo $this->Paginator->sort('Order', 'order_no');?></th>
		<th><?php echo $this->Paginator->sort('Date', 'created');?></th>
		<th><?php echo $this->Paginator->sort('Placed by', 'User.full_name');?></th>
		<th><?php echo $this->Paginator->sort('payment_status');?></th>
		<th><?php echo $this->Paginator->sort('fulfillment_status');?></th>
		<th><?php echo $this->Paginator->sort('amount');?></th>
		
	</tr>
	<tr></tr>
<?php
$i = 0;
foreach ($orders as $order):
	$class = null;
	if ($i++ % 2 != 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $this->Html->link(__('#' . $order['Order']['order_no'], true), array('action' => 'view', $order['Order']['id'])); ?>
			
		</td>
		<td>
			<?php echo $this->Time->nice($order['Order']['created']); ?>
		</td>
		<td>
			<?php echo $order['User']['full_name']; ?>
		</td>
		
		<td>
			<?php echo $this->Constant->displayPayment($order['Order']['payment_status']);?>
		</td>
		<td>
			<?php echo $this->Constant->displayFulfillment($order['Order']['fulfillment_status']);?>
		</td>
		
		<td>
			<?php echo '$' . $order['Order']['amount']; ?>
		</td>
		
	</tr>
<?php endforeach; ?>
</table>

<?php echo $this->Form->end(); ?>
<div class="paging">
  <?php //if have pagination 
  if ($paginator->numbers()){ 
    echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'))." | ";
    if ($paginator->counter(array('format' => __('%pages%', true)))>2) echo $paginator->numbers()." | ";
    echo $paginator->next(__('next', true).' >>', array(), null, array('class' => 'disabled')); }?> 
</div>
 </div>