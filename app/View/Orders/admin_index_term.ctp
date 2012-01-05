<h1 class="center">Orders</h1>
<div class="rule"></div>
<div id="action-links">
	<ul>
	    <li id="email"><a href="https://donnelly-lockman2285.myshopify.com/admin/orders/54131562/contact" title="Contact Customer">Contact customer</a></li>
		<li id="note"><a href="#" onclick="$(&quot;order-note&quot;).hide();$(&quot;note-form&quot;).show();$(&quot;order_note&quot;).focus(); return false;">Attach note</a></li>
		<li class="csv"><a href="https://donnelly-lockman2285.myshopify.com/admin/orders/54131562.csv">Export</a></li>
		<li id="print"><a href="#" onclick="window.print();; return false;">Print</a></li>
		<li id="lock"><a href="https://donnelly-lockman2285.myshopify.com/admin/orders/54131562/close" data-method="post" rel="nofollow">Close this order</a></li>


	</ul>

</div>

<div class="col1-3 online-user">
	<div class="mark clear">
		<div class="avatar">
		
		<?php
		$email = 'kimcity@gmail.com';
		$email = trim(strtolower($email));
		$gravatar_id = md5($email);
		$defaultPic = Router::url('/img/themeforest/terminator/avatar.jpg'); 
		$gravatarLink = 'https://secure.gravatar.com/avatar.php?gravatar_id=' . $gravatar_id;
		$gravatarLink .= '&size=50&default='. $defaultPic;
		
		echo $this->Html->image($gravatarLink, array('id' => 'gravatar'));
		?>
			<p class="status admin">admin</p>
		</div>
		<div class="desc">
			<ul class="links">
				<li><a href="#" class="graph" title="view stats">stats </a></li>
				<li><a href="#" class="cart" title="view shopping cart">shopping cart</a></li>
				<li><a href="#" class="hist" title="view user history">history</a></li>
				<li><a href="#" class="mesg" title="send message">send message</a></li>
				<li><span class="male" title="male">male</span></li>
			</ul>
			<h4><strong>Terminator</strong></h4>
			<p><small>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed in porta lectus.</small></p>
			<p class="info"><small>registered: 01/05/2009</small></p>
		</div>
	</div>
</div>