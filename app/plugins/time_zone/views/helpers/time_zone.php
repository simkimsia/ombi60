<?php  
class TimeZoneHelper extends AppHelper { 
     
	public $helpers = array('Form', 'Time'); 
	var $timezones = array( 
		'Pacific/Honolulu' => '(GMT -10:00) Hawaii',
		'US/Alaska' => '(GMT -09:00) Alaska',
		'US/Pacific' => '(GMT -08:00) Pacific Time (US & Canada)',
		'US/Arizona' => '(GMT -07:00) Arizona',
		'US/Mountain' => '(GMT -07:00) Mountain Time (US & Canada)',
		'US/Central' => '(GMT -06:00) Central Time (US & Canada), Mexico City',
		'US/Eastern' => '(GMT -05:00) Eastern Time (US & Canada)',
		'US/East-Indiana' => '(GMT -05:00) Indiana (East)',
		
		
		'Pacific/Midway' => '(GMT -11:00) Midway Island',
		'Pacific/Samoa' => '(GMT -11:00) Samoa',
		'America/Tijuana' => '(GMT -08:00) Tijuana',
		'America/Chihuahua' => '(GMT -07:00) Chihuahua',
		
		'America/Mexico_City' => '(GMT -06:00) Guadalajara',
		'America/Mexico_City' => '(GMT -06:00) Mexico City',
		'America/Monterrey' => '(GMT -06:00) Monterrey',		
		
		'America/Bogota' => '(GMT -05:00) Bogota',
		'America/Lima' => '(GMT -05:00) Lima',
		
		'America/Caracas' => '(GMT -04:30) Caracas',
		'Canada/Atlantic' => '(GMT -04:00) Atlantic Time (Canada)',
		
		'America/La_Paz' => '(GMT -04:00) La Paz',
		'America/Santiago' => '(GMT -04:00) Santiago',
		
		'Brasilia' => '(GMT -03:00) Brasilia',
		'America/Buenos_Aires' => '(GMT -03:00) Buenos Aires',
		
		'Atlantic/Azores' => '(GMT -01:00) Azores',
		'Atlantic/Cape_Verde' => '(GMT -01:00) Cape Verde Is.',
		'Africa/Casablanca' => '(GMT +00:00) Casablanca',
		'Europe/Dublin' => '(GMT +00:00) Dublin',
		
		'Europe/Lisbon' => '(GMT +00:00) Lisbon',
		'Europe/London' => '(GMT +00:00) London',
		
		'UTC' => '(GMT +00:00) UTC',
		'Europe/Amsterdam' => '(GMT +01:00) Amsterdam',
		
		'Europe/Belgrade' => '(GMT +01:00) Belgrade',
		'Europe/Berlin' => '(GMT +01:00) Berlin',
		
		
		'Europe/Bratislava' => '(GMT +01:00) Bratislava',
		'Europe/Brussels' => '(GMT +01:00) Brussels',
		'Europe/Budapest' => '(GMT +01:00) Budapest',
		'Europe/Copenhagen' => '(GMT +01:00) Copenhagen',
		'Europe/Ljubljana' => '(GMT +01:00) Ljubljana',
		'Europe/Madrid' => '(GMT +01:00) Madrid',
		'Europe/Paris' => '(GMT +01:00) Paris',
		'Europe/Prague' => '(GMT +01:00) Prague',
		'Europe/Rome' => '(GMT +01:00) Rome',
		'Europe/Sarajevo' => '(GMT +01:00) Sarajevo',
		'Europe/Skopje' => '(GMT +01:00) Skopje',
		'Europe/Stockholm' => '(GMT +01:00) Stockholm',
		'Europe/Vienna' => '(GMT +01:00) Vienna',
		'Europe/Warsaw' => '(GMT +01:00) Warsaw',
		
		'Europe/Zagreb' => '(GMT +01:00) Zagreb',
		'Europe/Athens' => '(GMT +02:00) Athens',
		'Europe/Bucharest' => '(GMT +02:00) Bucharest',
		'Africa/Cairo' => '(GMT +02:00) Cairo',
		
		'Africa/Harare' => '(GMT +02:00) Harare',
		'Europe/Helsinki' => '(GMT +02:00) Helsinki',
		'Europe/Istanbul' => '(GMT +02:00) Istanbul',
		'Asia/Jerusalem' => '(GMT +02:00) Jerusalem',
		'Europe/Kiev' => '(GMT +02:00) Kyiv',
		'Europe/Minsk' => '(GMT +02:00) Minsk',
		
		'Europe/Riga' => '(GMT +02:00) Riga',
		'Europe/Sofia' => '(GMT +02:00) Sofia',
		'Europe/Tallinn' => '(GMT +02:00) Tallinn',
		'Europe/Vilnius' => '(GMT +02:00) Vilnius',
		
		'Asia/Baghdad' => '(GMT +03:00) Baghdad',
		
		'Asia/Kuwait' => '(GMT +03:00) Kuwait',
		'Europe/Moscow' => '(GMT +03:00) Moscow',
		
		'Africa/Nairobi' => '(GMT +03:00) Nairobi',
		'Asia/Riyadh' => '(GMT +03:00) Riyadh',
		
		
		'Europe/Volgograd' => '(GMT +03:00) Volgograd',
		
		'Asia/Tehran' => '(GMT +03:30) Tehran',
		
		'Asia/Baku' => '(GMT +04:00) Baku',
		
		'Asia/Muscat' => '(GMT +04:00) Muscat',
		'Asia/Tbilisi' => '(GMT +04:00) Tbilisi',
		
		'Asia/Yerevan' => '(GMT +04:00) Yerevan',
		
		'Asia/Kabul' => '(GMT +04:30) Kabul',
		
		'Asia/Yekaterinburg' => '(GMT +05:00) Ekaterinburg',
		
		'Asia/Karachi' => '(GMT +05:00) Karachi',
		
		'Asia/Tashkent' => '(GMT +05:00) Tashkent',
		
		
		'Asia/Kolkata' => '(GMT +05:30) Kolkata',
		
		
		
		'Asia/Kathmandu' => '(GMT +05:45) Kathmandu',
		'Asia/Almaty' => '(GMT +06:00) Almaty',
		
		'Asia/Dhaka' => '(GMT +06:00) Dhaka',
		
		'Asia/Novosibirsk' => '(GMT +06:00) Novosibirsk',
		'Asia/Rangoon' => '(GMT +06:30) Rangoon',
		
		'Asia/Bangkok' => '(GMT +07:00) Bangkok',
		
		'Asia/Ho_Chi_Minh' => '(GMT +07:00) Ho Chi Minh',
		'Asia/Jakarta' => '(GMT +07:00) Jakarta',
		'Asia/Krasnoyarsk' => '(GMT +07:00) Krasnoyarsk',
		'Asia/Shanghai' => '(GMT +08:00) Beijing',
		'Asia/Shanghai' => '(GMT +08:00) Shanghai',
		'Asia/Chongqing' => '(GMT +08:00) Chongqing',
		'Asia/Hong_Kong' => '(GMT +08:00) Hong Kong',
		'Asia/Irkutsk' => '(GMT +08:00) Irkutsk',
		'Asia/Kuala_Lumpur' => '(GMT +08:00) Kuala Lumpur',
		'Australia/Perth' => '(GMT +08:00) Perth',
		'Asia/Singapore' => '(GMT +08:00) Singapore',
		'Asia/Taipei' => '(GMT +08:00) Taipei',
		'Asia/Ulan_Bator' => '(GMT +08:00) Ulaan Bataar',
		'Asia/Urumqi' => '(GMT +08:00) Urumqi',
		'Asia/Tokyo' => '(GMT +09:00) Osaka',
		'Asia/Tokyo' => '(GMT +09:00) Sapporo',
		'Asia/Seoul' => '(GMT +09:00) Seoul',
		'Asia/Tokyo' => '(GMT +09:00) Tokyo',
		'Asia/Yakutsk' => '(GMT +09:00) Yakutsk',
		'Australia/Adelaide' => '(GMT +09:30) Adelaide',
		'Australia/Darwin' => '(GMT +09:30) Darwin',
		'Australia/Brisbane' => '(GMT +10:00) Brisbane',
		'Australia/Canberra' => '(GMT +10:00) Canberra',
		'Pacific/Guam' => '(GMT +10:00) Guam',
		'Australia/Hobart' => '(GMT +10:00) Hobart',
		'Australia/Melbourne' => '(GMT +10:00) Melbourne',
		'Pacific/Port_Moresby' => '(GMT +10:00) Port Moresby',
		'Australia/Sydney' => '(GMT +10:00) Sydney',
		
		
		
		'Pacific/Auckland' => '(GMT +12:00) Auckland',
		
		'Pacific/Fiji' => '(GMT +12:00) Fiji',
		
	);
	
	function getTimeZones() {
		$result = array();
		foreach ($this->timezones as $key=>$tz) {
			
		}
		
		return $result;
	}

	function select($fieldname, $label="Please Choose a timezone") { 
	
		$list = $this->Form->input($fieldname, array("type"=>"select", "label"=>$label, "options"=>$this->timezones, "error"=>"Please choose a timezone")); 
		return $this->output($list); 
	} 
	
	function display($index) { 
		return $this->output($this->timezones[$index]); 
	}
	
	function getOffSet($index) {
		if (array_key_exists($index, $this->timezones)) {
			$content = $this->timezones[$index];
			
			$starting = '(GMT ';
			
			if (strpos($content, $starting) !== false) {
				$pos1 = strpos($string, $starting) + 5;
				$length = 6;
				$time = substr($content, $pos1, $length);
				
				$mins = substr($time, 4);
				$hrs = substr($time, 1, 2);
				$hrs = (float) $hrs;
				$mins = (float) $mins;
				$hrs = $hrs + ($mins/60.0);
				$offset = substr($time, 0, 1) . $hrs;
				$this->log($offset);
				return $offset;
			}

			
			
		}
		
		return false;
	}
} 
?>