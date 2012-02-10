<?php
class CsvHelper extends AppHelper { 
	
	var $delimiter = ','; 
    var $enclosure = '"'; 
    var $filename = 'Export.csv'; 
    var $line = array(); 
    var $buffer;
     

	public function CsvHelper() {
		$this->clear(); 
	} 
	
	public function clear() {
		$this->line = array();
		$this->buffer = fopen("php://output",'w+');
	}

    public function addField($value) { 
        $this->line[] = $value; 
    } 
     
    public function endRow() { 
        $this->addRow($this->line); 
        $this->line = array(); 
    } 
     
    public function addRow($row) { 
        fputcsv($this->buffer, $row, $this->delimiter, $this->enclosure); 
    } 
     
    public function renderHeaders() { 
		header("Content-type: text/csv");
		header("Cache-Control: no-store, no-cache");
        header("Content-disposition:attachment;filename=".$this->filename); 


    } 
     
    public function setFilename($filename) { 
        $this->filename = $filename; 
        if (strtolower(substr($this->filename, -4)) != '.csv') { 
            $this->filename .= '.csv'; 
        } 
    } 

	public function display() {
		$this->renderHeaders(); 
		ob_flush();
		fclose($this->buffer);
		
	}

}

?>
