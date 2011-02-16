<div class="merchants index">
<h2><?php __('Merchants');?></h2>



Dashboard for Merchant
<table id="recent-activity" class="table" cellpadding="0" cellspacing="0">
	<thead class="hide">
		<tr>
		  <td><?php __('Date'); ?></td>
			<td><?php __('Description'); ?></td>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($logs as $a_log) : ?>
     	  <td class="frontpage-type">
					<?php echo $this->Log->logDate($a_log['Log']['created']); ?>
				</td>
				<td class="frontpage-owner">
				  <?php echo $a_log['Log']['model'] . ' ' . $this->Log->logTitle($a_log['Log']); ?>

					<?php echo $this->Log->logAction($a_log['Log']); ?>
					<div style="color:#999999; font-size: 80%">
					<?php echo $this->Log->logAt($a_log); ?>
					</div>
					
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>