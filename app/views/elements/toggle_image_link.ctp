<?php

	if ($currentStatus) {
		echo $this->Html->image('tick.gif',
					array('url'=>$toggleUrl));
	} else {
		echo $this->Html->image('x_solid_red_25.gif',
					array('url'=>$toggleUrl));
	}

?>