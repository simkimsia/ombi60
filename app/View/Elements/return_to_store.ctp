<?php
	echo $this->Html->link('return to store', $this->Session->read('CurrentShop.Domain.domain') . (empty($toAction) ? '' : '/' . $toAction));
?>