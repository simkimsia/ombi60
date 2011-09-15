<?php

class CleanThemedShell extends Shell {
        
        var $uses = array();
        
        var $whitelist = array('alt', 'shopify-solo', '2_cover_1',
                               '2_cover_shopify', 'original_default',
                               'default', 'blue-white', 'orange');
        
        function main() {
                
                $path = APP . 'View' . DS . 'Themed';
                
                $themedFolder = new Folder($path);
                
                $themedFolderArray = $themedFolder->read();
                
                $this->out('now deleting the themed folders in APP');
                
                foreach($themedFolderArray[0] as $folderName) {
                        
                        if (!in_array($folderName, $this->whitelist)) {
                                $folder = new Folder($path . DS . $folderName);
                                
                                $folder->delete($path . DS . $folderName);
                                $this->out($folderName . ' deleted');
                        }
                        
                }
                
                // now we clear the product images in mainsite
                
                $this->out('now deleting the product images in MAINSITE');
                $path = ROOT . DS . 'mainsite' . DS . 'webroot' . DS. 'uploads' . DS . 'products' . DS;
       
                $productImageFolder = new Folder($path);
                $arrayOfProductImages = $productImageFolder->find('^default-.*');
                
                foreach($arrayOfProductImages as $fileName) {
                        $file = new File($path . $fileName);
                        $file->delete();
                        $this->out($fileName . ' deleted');
                }
                
                $this->out('now deleting the product images in APP');
                $path = ROOT . DS . 'app' . DS . 'webroot' . DS. 'uploads' . DS . 'products' . DS;
       
                $productImageFolder = new Folder($path);
                //$arrayOfProductImages = $productImageFolder->find('^default-.*');
                $arrayOfProductImages = $productImageFolder->find('.*');
                
                $arrayAllowedFiles = array('default.jpg',
                                           'empty',
                                           '.gitignore');
                
                foreach($arrayOfProductImages as $fileName) {
                        // we delete everything except default.jpg
                        if (!in_array($fileName, $arrayAllowedFiles)) {
                                $file = new File($path . $fileName);
                                $file->delete();
                                $this->out($fileName . ' deleted');        
                        }
                }
                
                
                
                $this->out('now deleting the thumbs in APP');
                $arrayOfThumbs = array('thumb',
                       'icon',
                       'small',
                       'medium',
                       'large');
                
                $path = ROOT . DS . 'app' . DS . 'webroot' . DS. 'uploads' . DS . 'products' . DS . 'thumb' . DS;
       
                foreach ($arrayOfThumbs as $folderName) {
                        $newPath = $path . $folderName;
                        $productImageFolder = new Folder($newPath);
                        //$arrayOfProductImages = $productImageFolder->find('^default-.*');
                        $arrayOfProductImages = $productImageFolder->find('.*');
                        
                        $this->out('now deleting the thumbs in ' . $folderName);
                        
                        foreach($arrayOfProductImages as $fileName) {
                                // we delete everything except default.jpg
                                if (!in_array($fileName, $arrayAllowedFiles)) {
                                        $file = new File($newPath . DS . $fileName);
                                        $file->delete();
                                        $this->out($fileName . ' deleted');
                                }
                        }
                        
                }
               
                
        }
}

?>