<?php

class CopyThemedWebrootShell extends Shell {
        
        var $uses = array();
        
        var $whitelist = array('alt', 'shopify-solo', '2_cover_1',
                               '2_cover_shopify', 'original_default',
                               'default', 'blue-white', 'orange');
        
        function main() {
                
                $this->out("We shall delete ALL GENERATED themed folders and product images in webroot.\n");
                
                $this->out("Before deleting, ensure ownership & files permission for the THEMED folder correct.");
                
                $this->out("\nAfter deleting, copy default set of themes and product images.");
                
                $this->out("\nAFTER running this,\n1.EMPTY database. \n2.RESTORE staging_copy_w_data.sql in docs/database folder.");
                
                $continue = $this->in("\n\nStart deleting current files and copy default files now?", array("yes", "no"), "yes");
               
                if ($continue == 'yes') {
                        $successfullyDeleted = $this->clean_themed();
                        if ($successfullyDeleted) {
                                $this->out("\n\nFiles Deleted.\nCopying default files ...");
                                $this->copy_files();
                        } else {
                                $this->error("\n\nSomething is wrong. Please ensure the ownership and files permission for the themed folder is correct.");
                        }
                } else {
                        $this->error("\n\nExiting the program");
                }
                
                $this->out("\n\nDefault theme files and product images copied. \n\nYou MUST NOW DO THIS: \n\n1.EMPTY database. \n2.RESTORE staging_copy_w_data.sql. \n3.Continue with development");
                
                
        }
        
        private function clean_themed() {
                
                $result = true;
                
                $path = VIEWS . 'themed';
                
                $themedFolder = new Folder($path);
                
                $themedFolderArray = $themedFolder->read();
                
                $this->out('now deleting the themed folders in APP');
                
                foreach($themedFolderArray[0] as $folderName) {
                        
                        if (!in_array($folderName, $this->whitelist)) {
                                $folder = new Folder($path . DS . $folderName);
                                
                                $result = $folder->delete($path . DS . $folderName);
                                $this->out($folderName . ' deleted');
                        }
                        
                }
                
                if (!$result) return false;
                
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
                $productImageFolder->delete($path);
                /*
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
                */
                return true;
        }
        
        private function copy_files() {
                
                $from   = VIEWS . 'copy_of_themed';
                $to     = VIEWS . 'themed';
                
                // copy themed
                $result = $this->copy_folder_recursively($to, $from);
                if (!$result) {
                        $this->error('copying of themed folders FAILED!');   
                }
                
                
                $from   = VIEWS . 'copy_of_webroot' ;
                $to     = ROOT . DS . 'app' . DS . 'webroot' . DS. 'uploads';
                
                // copy webroot/uploads/products
                $result = $this->copy_folder_recursively($to, $from);
                if (!$result) {
                        $this->error('copying of product webroot folders FAILED!');   
                }
                
                return $result;
        }
        
        private function copy_folder_recursively($to, $from) {
                
                $themedFolder = new Folder($from);
                
                $this->out('now copying folders/files from '.$from.' to ' .$to);
                $options = array('to'   => $to,
                                 'from' => $from,
                                 'mode'=> 0775,
                                 );
                return $themedFolder->copy($options);
        }
}

?>