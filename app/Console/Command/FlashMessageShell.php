<?php

App::uses('Folder', 'Utility');
App::uses('File', 'Utility');

class FlashMessageShell extends Shell {
        
        var $uses = array();
        
        function main() {
                
                $path = APP . 'Controller' . DS;
                
                
                $controllerFolder = new Folder($path);
                
                $arrayOfControllerFiles = $controllerFolder->find('.*_controller\.php$');
                
                foreach($arrayOfControllerFiles as $file) {
        
                        $file = new File(APP . 'Controller' . DS . $file);
                        $this->out('Checking '. $file->name());
                        
                        $contents = $file->read();
                        $originalContents = $contents;
                
                
                        $contents = preg_replace("/^(.*Session->setFlash.*has been saved', true\))\);$/m",
                                         "$1, 'default', array('class'=>'flash_success'));", $contents);

                
                        $contents = preg_replace('/^(.*Session->setFlash.*, true\))\);$/m',
                                         "$1, 'default', array('class'=>'flash_failure'));", $contents);

                        if ($originalContents != $contents) {
                                $file->write($contents);
                                $this->out('Changed '.$file->name());
                        } 
                
                }
                
        }
}

?>