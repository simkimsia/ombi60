<div class="login-box">
<div class="login-border">
<div class="login-style">
	<div class="login-header">
		<div class="logo clear">
			<?php echo $this->Html->image('themeforest/terminator/logo_earth_bw.png', array('class' => 'picture')); ?>
			<span class="textlogo">
				<span class="title">LOGIN</span>
			</span>
		</div>
	</div>
	<?php
		echo $this->Form->create('Merchant', array('action' => 'login'));
	?>

		
		<div class="login-inside">
			<div class="login-data">
				<div class="row clear">
    					<?php echo $this->Form->input('User.email'); ?>
    				</div>
 				<div class="row clear">
					<?php echo $this->Form->input('User.password'); ?>
				</div>
				<input type="submit" class="button" value="Login" />
			</div>
			<p>Just press login to go to the demo. </p>
		</div>
		<div class="login-footer clear">
			<span class="remember">
				<?php echo $this->Form->input('User.remember_me', array('label' => 'Remember me', 'type' => 'checkbox', 'checked' =>'checked')); ?>
			</span>
			<a href="#" class="button green fr-space">Back to Page</a>
		</div>
	<?php echo $this->Form->end();?>

</div>
</div>
</div>

<div class="login-links">
	<p><strong>&copy; 2012 Copyright by <a href="http://www.openmybusinessin60seconds.com">SpreeToShop Pte Ltd</a></strong> All rights reserved.</p> 
</div>


