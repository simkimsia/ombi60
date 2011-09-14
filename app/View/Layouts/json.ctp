<?php
Configure::write('debug', 0);


echo json_encode(array('success'=> $successJSON,
                       'contents' => $content_for_layout));

?>
