<div class="columns clear bt-space20">
	<!-- DASHBOARD - LEFT COLUMN -->
	<div class="col2-3">


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
	</div><!-- LEFT COLUMN -->
	
	<!-- DASHBOARD - RIGHT COLUMN -->
	<div class="col1-3 lastcol">

		<!-- DASHBOARD CHART -->
		<div class="dashboard_chart">
			<div class="chart-wrap">
					<table class="visualize_dashboard">
						<caption>Dashboard Chart Example</caption>
						<thead>
							<tr>
								<td></td>
								<th scope="col">March</th>
								<th scope="col">April</th>
								<th scope="col">May</th>
								<th scope="col">June</th>
								<th scope="col">July</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th scope="row">Visits</th>
								<td>175</td>
								<td>145</td>
								<td>212</td>
								<td>175</td>
								<td>182</td>
							</tr>
							<tr>
								<th scope="row">Sales</th>
								<td>94</td>
								<td>53</td>
								<td>124</td>
								<td>92</td>
								<td>105</td>
							</tr>
						</tbody>
					</table>				
			</div><!-- /.chart-wrap -->
		</div><!-- /.dashboard-chart -->
	</div><!-- RIGHT COLUMN -->
	
</div>

