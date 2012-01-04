<!-- STYLE1 TABLE -->

<table class="style1">
	<caption>Recent Activity</caption>
	<thead>
		<tr>
			<td><?php echo __('Date'); ?></td>
			<th><?php echo __('Description'); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($logs as $a_log) : ?>
		<tr>
			<th><?php echo $this->Log->logDate($a_log['Log']['created']); ?></th>
			<td><?php echo $a_log['Log']['model'] . ' ' . $this->Log->logTitle($a_log['Log'], array(
			  	'admin' => true
			  )); ?>

				<?php echo 'was ' . $this->Log->logAction($a_log['Log']); ?>
				<div style="color:#999999; font-size: 80%">
				<?php echo 'at ' . $this->Log->logAtWhatTime($a_log) . ' by ' . $this->Log->logByWhom($a_log); ?>
				</div></td>
		</tr>
		
		<?php endforeach; ?>
	</tbody>
</table>