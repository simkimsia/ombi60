<div class="merchants">
<h2><?php echo __('Merchants');?></h2>



Dashboard

<table id="recent-activity" class="table" cellpadding="0" cellspacing="0">
	<thead class="hide">
		<tr>
		  <td><?php echo __('Date'); ?></td>
			<td><?php echo __('Description'); ?></td>
		</tr>
	</thead>
	<tbody>
	
		<?php foreach ($logs as $a_log) : ?>
     	  <td class="frontpage-type">
					<?php echo $this->Log->logDate($a_log['Log']['created']); ?>
				</td>
				<td class="frontpage-owner">
				  <?php echo $a_log['Log']['model'] . ' ' . $this->Log->logTitle($a_log['Log'], array(
				  	'admin' => true
				  )); ?>

					<?php echo 'was ' . $this->Log->logAction($a_log['Log']); ?>
					<div style="color:#999999; font-size: 80%">
					<?php echo 'at ' . $this->Log->logAtWhatTime($a_log) . ' by ' . $this->Log->logByWhom($a_log); ?>
					</div>
					
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table> 