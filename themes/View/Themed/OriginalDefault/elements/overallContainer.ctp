<div id="overallContainer" class="<?php if (!empty($classForContainer)) echo $classForContainer; ?>">

	<div id="header">
		<div id="headerContent">
			<h1><a href="#"><span>Service Name</span></a></h1>
			<h2>Username <input name="txtUsername" type="text" /> Password <input name="txtUsername" type="password" /></h2>
		</div>
	</div>

	<div id="menu">
		<ul id="menuItems">
			<li id="home" class="selectedMenuItem"><span>Home</span></li>
			<li id="about"><a href="about.html"><span>About Us</span></a></li>
			<li id="catalogue"><a href="catalogue.html"><span>Catalogue</span></a></li>
			<li id="blog"><a href="blog.html"><span>Blog</a></span></li>
			<li id="cart"><a href="cart.html"><span>Cart</span></a><div id="cartbadge">3</div></li>			
		</ul>
	</div>
	
	<?php
                if (!empty($content_for_layout)) {
                        echo $content_for_layout;
                }
                else if (!empty($contentElementInOverallContainer)) {
                        echo $this->element($contentElementInOverallContainer);
                }
        ?>

	<div id="footer">
		© Company Name 2010<br />
		<a href="#">Privacy Statement</a> | <a href="#">Disclaimer</a>
	</div>
</div>
