<?php
class TimeZoneComponent extends Component {
 
/**
 * Function expecting an array with a created or modified or updated field with a yyyy-mm-dd hh:mm:ss string value
 *
 * This function will convert the string datetime into DateTime object 
 *
 * @param array
 * @param DateTimeZone Php object default is null object if unset, eventually will set to UTC
 * @return DateTime object
 */     
	function convert ($array, $dateTimeZone = null) {
		// initialize datetimezone where necessary
		if ($dateTimeZone == null) {
			$dateTimeZone = new DataTimeZone('UTC');
		}
		
		if (array_key_exists('created', $array)) {
			$time = new DateTime($array['created']);
			
			$time->setTimezone($dateTimeZone);
		
			$array['created'] = $time;
		}
		
		if (array_key_exists('modified', $array)) {
			$time = new DateTime($array['modified']);
			
			$time->setTimezone($dateTimeZone);
		
			$array['modified'] = $time;
		}
		
		if (array_key_exists('updated', $array)) {
			$time = new DateTime($array['updated']);
			
			$time->setTimezone($dateTimeZone);
		
			$array['updated'] = $time;
		}
                
		
		return $array;
	}
}
?>