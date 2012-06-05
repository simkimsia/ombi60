<?php
App::uses('AppModel', 'Model');
/**
 * CustomPrint Model
 *
 * @property Product $Product
 */
class CustomPrint extends AppModel {
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'product_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Product' => array(
			'className' => 'Product',
			'foreignKey' => 'product_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	// default sticker stats for ChildLabel Custom Print function
	public $optionsData = array(
		'saved_img' => array(
			'width' => 260,
			'height' => 75
		),
		'font' => array(
			'file' => 'AmericanTypewriter.ttc',
			'size' => 32,
			'color' => array(
				'yellow' => '#FEF94B',
			)
		),
		'text' => array(
			'xpos' => 0,
			'ypos'	=> 28,
			'angle' => 0,
			'line_height' => 36,
			'max_width_allowed' => 190
		),
	);
	
	/**
	 * 
	 * update new image returning the filename
	 * @param $data Array that contains the options
	 * @return string Filename of the new images
	 */
	public function updateNewImage($data, $originalFileName) {
		// text on the custom print itself
		$text = 'Lee Ming Xuan';
		
		// get the full path to the original imagefile
		$temp_name = PRODUCT_IMAGES_PATH . $originalFileName;
		
		// Create the full path for new file for the image to be written
		// this new_file is the one with the print
		$new_file = TMP_CUSTOM_PRINTS.'final_'.time().'.png';

		// Resizing the uploaded image
		$resized_photo = new Imagick($temp_name);

		// Write the image to a new file so that we can put the overlay text later
		$resized_photo->setImageFormat('png');
		$resized_photo->writeImage($new_file);

		// Now create the overlay text
		$overlay = new Imagick();
		$draw = new ImagickDraw();
		$pixel = new ImagickPixel( 'transparent' );

		// Use the same width as the image or up to you
		$overlay->newImage(260, 75, $pixel);

		// Set fill color
		$draw->setFillColor('#FEF94B');

		// Set font. Check your server for available fonts.
		$draw->setFont(FONTS . 'AmericanTypewriter.ttc');
		$draw->setFontSize( 32 );

		// Create the text
		$maxWidthAllowedForText = 190;
		list($lines, $lineHeight) = $this->wordWrapAnnotation($overlay, $draw, $text, $maxWidthAllowedForText);


		$xpos = 0; // x and y coordiantes to start printing
		$ypos = 28;
		$angle = 0; // angle at which the word is printed
		for($i = 0; $i < count($lines); $i++)
		    $overlay->annotateImage($draw,  $xpos, $ypos + $i*36, $angle, $lines[$i]);

		// Write to the disk so that we can finally overlay
		// this overlay_file is the one with the text
		$finalFilename = time().'.png';
		$overlay_file = TMP_CUSTOM_PRINTS . $finalFilename;
		$overlay->setImageFormat('png');
		$overlay->writeImage($overlay_file);

		// overlay
		// when we run this, overlay the text from overlay_file onto the print in new_file
		// thus the final product is in new_file
		shell_exec("composite -gravity center ".$overlay_file." {$new_file} {$new_file}");	
		
		// so at the end we remove the overlayFile which contains the text
		$overlayFile = new File($overlay_file);
		$overlayFile->delete();
		
		return $finalFilename;
	}
	
	/**
	 * word wrap annotation that will add in the words into the image
	 *
	 * @param imagick image object by reference
	 * @param $draw
	 * @param $text
	 * @param #maxWidth
	 * @return array
	 * 
	 **/
	public function wordWrapAnnotation(&$image, &$draw, $text, $maxWidth) {
	    $words = explode(" ", $text);
	    $lines = array();
	    $i = 0;
	    $lineHeight = 0;
	    while($i < count($words) )
	    {
	        $currentLine = $words[$i];
	        if($i+1 >= count($words))
	        {
	            $lines[] = $currentLine;
	            break;
	        }
	        //Check to see if we can add another word to this line
	        $metrics = $image->queryFontMetrics($draw, $currentLine . ' ' . $words[$i+1]);
	        while($metrics['textWidth'] <= $maxWidth)
	        {
	            //If so, do it and keep doing it!
	            $currentLine .= ' ' . $words[++$i];
	            if($i+1 >= count($words))
	                break;
	            $metrics = $image->queryFontMetrics($draw, $currentLine . ' ' . $words[$i+1]);
	        }
	        //We can't add the next word to this line, so loop to the next line
	        $lines[] = $currentLine;
	        $i++;
	        //Finally, update line height
	        if($metrics['textHeight'] > $lineHeight)
	            $lineHeight = $metrics['textHeight'];
	    }
	    return array($lines, $lineHeight);
	}
	
	
}
