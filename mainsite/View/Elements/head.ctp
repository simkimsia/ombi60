	<div class="bg-top-centre">
		<div class="bg-top">
			<!--header -->
			<div id="header">
				<div class="main">
					<div class="wrapper">
						<div class="data">
							Monday, April 05, 2000 12:00
						</div>
						<div class="help">
							Help Centre Toll free number <span>+1 000 226 6220</span>
						</div>
					</div>
					<div class="wrapper">
						<div class="logo">
							<a href="index.html"><img src="../images/logo.png" alt="" /></a>
						</div>
					</div>
				</div>
				<div class="menu-bg">
					<div class="main">
						<div class="wrapper">
							<div class="menu">
								<ul>
								<?php 
								function displayClass($href, $class) {


									$currentUrl = Router::url();

									if ($currentUrl === $href) {
										return 'class="' . $class . '"';
									}
									return '';
								}
									
								?>
									<li><a href="/" <?php echo displayClass('/', 'active'); ?><span><span>Home</span></span></a></li>
									<li><a href="/pricing-signup" <?php echo displayClass('/pricing-signup', 'active'); ?>><span><span>Pricing & Sign Up</span></span></a></li>
									<li><a href="/support"><span><span>Support</span></span></a></li>
									<li><a href="/faq"><span><span>FAQ</span></span></a></li>
									<li><a href="/login"><span><span>Login</span></span></a></li>
									<li class="last"><a href="contact"><span><span>Contact Us</span></span></a></li>
								</ul>
							</div>
						</div>
					</div>
					
			</div>
			<!--header end-->