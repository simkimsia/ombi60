<?php
/* Country Fixture generated on: 2011-11-23 10:19:07 : 1322043547 */

/**
 * CountryFixture
 *
 */
class CountryFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 5, 'key' => 'primary', 'collate' => NULL, 'comment' => ''),
		'iso' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 2, 'key' => 'unique', 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 80, 'key' => 'unique', 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'printable_name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 80, 'key' => 'unique', 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'iso3' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 3, 'key' => 'unique', 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'numcode' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 6, 'collate' => NULL, 'comment' => ''),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'unique_iso' => array('column' => 'iso', 'unique' => 1), 'unique_name' => array('column' => 'name', 'unique' => 1), 'unique_printable_name' => array('column' => 'printable_name', 'unique' => 1), 'unique_iso3' => array('column' => 'iso3', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => '1',
			'iso' => 'AF',
			'name' => 'AFGHANISTAN',
			'printable_name' => 'Afghanistan',
			'iso3' => 'AFG',
			'numcode' => '4'
		),
		array(
			'id' => '2',
			'iso' => 'AL',
			'name' => 'ALBANIA',
			'printable_name' => 'Albania',
			'iso3' => 'ALB',
			'numcode' => '8'
		),
		array(
			'id' => '3',
			'iso' => 'DZ',
			'name' => 'ALGERIA',
			'printable_name' => 'Algeria',
			'iso3' => 'DZA',
			'numcode' => '12'
		),
		array(
			'id' => '4',
			'iso' => 'AS',
			'name' => 'AMERICAN SAMOA',
			'printable_name' => 'American Samoa',
			'iso3' => 'ASM',
			'numcode' => '16'
		),
		array(
			'id' => '5',
			'iso' => 'AD',
			'name' => 'ANDORRA',
			'printable_name' => 'Andorra',
			'iso3' => 'AND',
			'numcode' => '20'
		),
		array(
			'id' => '6',
			'iso' => 'AO',
			'name' => 'ANGOLA',
			'printable_name' => 'Angola',
			'iso3' => 'AGO',
			'numcode' => '24'
		),
		array(
			'id' => '7',
			'iso' => 'AI',
			'name' => 'ANGUILLA',
			'printable_name' => 'Anguilla',
			'iso3' => 'AIA',
			'numcode' => '660'
		),
		array(
			'id' => '8',
			'iso' => 'AQ',
			'name' => 'ANTARCTICA',
			'printable_name' => 'Antarctica',
			'iso3' => NULL,
			'numcode' => NULL
		),
		array(
			'id' => '9',
			'iso' => 'AG',
			'name' => 'ANTIGUA AND BARBUDA',
			'printable_name' => 'Antigua and Barbuda',
			'iso3' => 'ATG',
			'numcode' => '28'
		),
		array(
			'id' => '10',
			'iso' => 'AR',
			'name' => 'ARGENTINA',
			'printable_name' => 'Argentina',
			'iso3' => 'ARG',
			'numcode' => '32'
		),
		array(
			'id' => '11',
			'iso' => 'AM',
			'name' => 'ARMENIA',
			'printable_name' => 'Armenia',
			'iso3' => 'ARM',
			'numcode' => '51'
		),
		array(
			'id' => '12',
			'iso' => 'AW',
			'name' => 'ARUBA',
			'printable_name' => 'Aruba',
			'iso3' => 'ABW',
			'numcode' => '533'
		),
		array(
			'id' => '13',
			'iso' => 'AU',
			'name' => 'AUSTRALIA',
			'printable_name' => 'Australia',
			'iso3' => 'AUS',
			'numcode' => '36'
		),
		array(
			'id' => '14',
			'iso' => 'AT',
			'name' => 'AUSTRIA',
			'printable_name' => 'Austria',
			'iso3' => 'AUT',
			'numcode' => '40'
		),
		array(
			'id' => '15',
			'iso' => 'AZ',
			'name' => 'AZERBAIJAN',
			'printable_name' => 'Azerbaijan',
			'iso3' => 'AZE',
			'numcode' => '31'
		),
		array(
			'id' => '16',
			'iso' => 'BS',
			'name' => 'BAHAMAS',
			'printable_name' => 'Bahamas',
			'iso3' => 'BHS',
			'numcode' => '44'
		),
		array(
			'id' => '17',
			'iso' => 'BH',
			'name' => 'BAHRAIN',
			'printable_name' => 'Bahrain',
			'iso3' => 'BHR',
			'numcode' => '48'
		),
		array(
			'id' => '18',
			'iso' => 'BD',
			'name' => 'BANGLADESH',
			'printable_name' => 'Bangladesh',
			'iso3' => 'BGD',
			'numcode' => '50'
		),
		array(
			'id' => '19',
			'iso' => 'BB',
			'name' => 'BARBADOS',
			'printable_name' => 'Barbados',
			'iso3' => 'BRB',
			'numcode' => '52'
		),
		array(
			'id' => '20',
			'iso' => 'BY',
			'name' => 'BELARUS',
			'printable_name' => 'Belarus',
			'iso3' => 'BLR',
			'numcode' => '112'
		),
		array(
			'id' => '21',
			'iso' => 'BE',
			'name' => 'BELGIUM',
			'printable_name' => 'Belgium',
			'iso3' => 'BEL',
			'numcode' => '56'
		),
		array(
			'id' => '22',
			'iso' => 'BZ',
			'name' => 'BELIZE',
			'printable_name' => 'Belize',
			'iso3' => 'BLZ',
			'numcode' => '84'
		),
		array(
			'id' => '23',
			'iso' => 'BJ',
			'name' => 'BENIN',
			'printable_name' => 'Benin',
			'iso3' => 'BEN',
			'numcode' => '204'
		),
		array(
			'id' => '24',
			'iso' => 'BM',
			'name' => 'BERMUDA',
			'printable_name' => 'Bermuda',
			'iso3' => 'BMU',
			'numcode' => '60'
		),
		array(
			'id' => '25',
			'iso' => 'BT',
			'name' => 'BHUTAN',
			'printable_name' => 'Bhutan',
			'iso3' => 'BTN',
			'numcode' => '64'
		),
		array(
			'id' => '26',
			'iso' => 'BO',
			'name' => 'BOLIVIA',
			'printable_name' => 'Bolivia',
			'iso3' => 'BOL',
			'numcode' => '68'
		),
		array(
			'id' => '27',
			'iso' => 'BA',
			'name' => 'BOSNIA AND HERZEGOVINA',
			'printable_name' => 'Bosnia and Herzegovina',
			'iso3' => 'BIH',
			'numcode' => '70'
		),
		array(
			'id' => '28',
			'iso' => 'BW',
			'name' => 'BOTSWANA',
			'printable_name' => 'Botswana',
			'iso3' => 'BWA',
			'numcode' => '72'
		),
		array(
			'id' => '29',
			'iso' => 'BV',
			'name' => 'BOUVET ISLAND',
			'printable_name' => 'Bouvet Island',
			'iso3' => NULL,
			'numcode' => NULL
		),
		array(
			'id' => '30',
			'iso' => 'BR',
			'name' => 'BRAZIL',
			'printable_name' => 'Brazil',
			'iso3' => 'BRA',
			'numcode' => '76'
		),
		array(
			'id' => '31',
			'iso' => 'IO',
			'name' => 'BRITISH INDIAN OCEAN TERRITORY',
			'printable_name' => 'British Indian Ocean Territory',
			'iso3' => NULL,
			'numcode' => NULL
		),
		array(
			'id' => '32',
			'iso' => 'BN',
			'name' => 'BRUNEI DARUSSALAM',
			'printable_name' => 'Brunei Darussalam',
			'iso3' => 'BRN',
			'numcode' => '96'
		),
		array(
			'id' => '33',
			'iso' => 'BG',
			'name' => 'BULGARIA',
			'printable_name' => 'Bulgaria',
			'iso3' => 'BGR',
			'numcode' => '100'
		),
		array(
			'id' => '34',
			'iso' => 'BF',
			'name' => 'BURKINA FASO',
			'printable_name' => 'Burkina Faso',
			'iso3' => 'BFA',
			'numcode' => '854'
		),
		array(
			'id' => '35',
			'iso' => 'BI',
			'name' => 'BURUNDI',
			'printable_name' => 'Burundi',
			'iso3' => 'BDI',
			'numcode' => '108'
		),
		array(
			'id' => '36',
			'iso' => 'KH',
			'name' => 'CAMBODIA',
			'printable_name' => 'Cambodia',
			'iso3' => 'KHM',
			'numcode' => '116'
		),
		array(
			'id' => '37',
			'iso' => 'CM',
			'name' => 'CAMEROON',
			'printable_name' => 'Cameroon',
			'iso3' => 'CMR',
			'numcode' => '120'
		),
		array(
			'id' => '38',
			'iso' => 'CA',
			'name' => 'CANADA',
			'printable_name' => 'Canada',
			'iso3' => 'CAN',
			'numcode' => '124'
		),
		array(
			'id' => '39',
			'iso' => 'CV',
			'name' => 'CAPE VERDE',
			'printable_name' => 'Cape Verde',
			'iso3' => 'CPV',
			'numcode' => '132'
		),
		array(
			'id' => '40',
			'iso' => 'KY',
			'name' => 'CAYMAN ISLANDS',
			'printable_name' => 'Cayman Islands',
			'iso3' => 'CYM',
			'numcode' => '136'
		),
		array(
			'id' => '41',
			'iso' => 'CF',
			'name' => 'CENTRAL AFRICAN REPUBLIC',
			'printable_name' => 'Central African Republic',
			'iso3' => 'CAF',
			'numcode' => '140'
		),
		array(
			'id' => '42',
			'iso' => 'TD',
			'name' => 'CHAD',
			'printable_name' => 'Chad',
			'iso3' => 'TCD',
			'numcode' => '148'
		),
		array(
			'id' => '43',
			'iso' => 'CL',
			'name' => 'CHILE',
			'printable_name' => 'Chile',
			'iso3' => 'CHL',
			'numcode' => '152'
		),
		array(
			'id' => '44',
			'iso' => 'CN',
			'name' => 'CHINA',
			'printable_name' => 'China',
			'iso3' => 'CHN',
			'numcode' => '156'
		),
		array(
			'id' => '45',
			'iso' => 'CX',
			'name' => 'CHRISTMAS ISLAND',
			'printable_name' => 'Christmas Island',
			'iso3' => NULL,
			'numcode' => NULL
		),
		array(
			'id' => '46',
			'iso' => 'CC',
			'name' => 'COCOS (KEELING) ISLANDS',
			'printable_name' => 'Cocos (Keeling) Islands',
			'iso3' => NULL,
			'numcode' => NULL
		),
		array(
			'id' => '47',
			'iso' => 'CO',
			'name' => 'COLOMBIA',
			'printable_name' => 'Colombia',
			'iso3' => 'COL',
			'numcode' => '170'
		),
		array(
			'id' => '48',
			'iso' => 'KM',
			'name' => 'COMOROS',
			'printable_name' => 'Comoros',
			'iso3' => 'COM',
			'numcode' => '174'
		),
		array(
			'id' => '49',
			'iso' => 'CG',
			'name' => 'CONGO',
			'printable_name' => 'Congo',
			'iso3' => 'COG',
			'numcode' => '178'
		),
		array(
			'id' => '50',
			'iso' => 'CD',
			'name' => 'CONGO, THE DEMOCRATIC REPUBLIC OF THE',
			'printable_name' => 'Congo, the Democratic Republic of the',
			'iso3' => 'COD',
			'numcode' => '180'
		),
		array(
			'id' => '51',
			'iso' => 'CK',
			'name' => 'COOK ISLANDS',
			'printable_name' => 'Cook Islands',
			'iso3' => 'COK',
			'numcode' => '184'
		),
		array(
			'id' => '52',
			'iso' => 'CR',
			'name' => 'COSTA RICA',
			'printable_name' => 'Costa Rica',
			'iso3' => 'CRI',
			'numcode' => '188'
		),
		array(
			'id' => '53',
			'iso' => 'CI',
			'name' => 'COTE D\'IVOIRE',
			'printable_name' => 'Cote D\'Ivoire',
			'iso3' => 'CIV',
			'numcode' => '384'
		),
		array(
			'id' => '54',
			'iso' => 'HR',
			'name' => 'CROATIA',
			'printable_name' => 'Croatia',
			'iso3' => 'HRV',
			'numcode' => '191'
		),
		array(
			'id' => '55',
			'iso' => 'CU',
			'name' => 'CUBA',
			'printable_name' => 'Cuba',
			'iso3' => 'CUB',
			'numcode' => '192'
		),
		array(
			'id' => '56',
			'iso' => 'CY',
			'name' => 'CYPRUS',
			'printable_name' => 'Cyprus',
			'iso3' => 'CYP',
			'numcode' => '196'
		),
		array(
			'id' => '57',
			'iso' => 'CZ',
			'name' => 'CZECH REPUBLIC',
			'printable_name' => 'Czech Republic',
			'iso3' => 'CZE',
			'numcode' => '203'
		),
		array(
			'id' => '58',
			'iso' => 'DK',
			'name' => 'DENMARK',
			'printable_name' => 'Denmark',
			'iso3' => 'DNK',
			'numcode' => '208'
		),
		array(
			'id' => '59',
			'iso' => 'DJ',
			'name' => 'DJIBOUTI',
			'printable_name' => 'Djibouti',
			'iso3' => 'DJI',
			'numcode' => '262'
		),
		array(
			'id' => '60',
			'iso' => 'DM',
			'name' => 'DOMINICA',
			'printable_name' => 'Dominica',
			'iso3' => 'DMA',
			'numcode' => '212'
		),
		array(
			'id' => '61',
			'iso' => 'DO',
			'name' => 'DOMINICAN REPUBLIC',
			'printable_name' => 'Dominican Republic',
			'iso3' => 'DOM',
			'numcode' => '214'
		),
		array(
			'id' => '62',
			'iso' => 'EC',
			'name' => 'ECUADOR',
			'printable_name' => 'Ecuador',
			'iso3' => 'ECU',
			'numcode' => '218'
		),
		array(
			'id' => '63',
			'iso' => 'EG',
			'name' => 'EGYPT',
			'printable_name' => 'Egypt',
			'iso3' => 'EGY',
			'numcode' => '818'
		),
		array(
			'id' => '64',
			'iso' => 'SV',
			'name' => 'EL SALVADOR',
			'printable_name' => 'El Salvador',
			'iso3' => 'SLV',
			'numcode' => '222'
		),
		array(
			'id' => '65',
			'iso' => 'GQ',
			'name' => 'EQUATORIAL GUINEA',
			'printable_name' => 'Equatorial Guinea',
			'iso3' => 'GNQ',
			'numcode' => '226'
		),
		array(
			'id' => '66',
			'iso' => 'ER',
			'name' => 'ERITREA',
			'printable_name' => 'Eritrea',
			'iso3' => 'ERI',
			'numcode' => '232'
		),
		array(
			'id' => '67',
			'iso' => 'EE',
			'name' => 'ESTONIA',
			'printable_name' => 'Estonia',
			'iso3' => 'EST',
			'numcode' => '233'
		),
		array(
			'id' => '68',
			'iso' => 'ET',
			'name' => 'ETHIOPIA',
			'printable_name' => 'Ethiopia',
			'iso3' => 'ETH',
			'numcode' => '231'
		),
		array(
			'id' => '69',
			'iso' => 'FK',
			'name' => 'FALKLAND ISLANDS (MALVINAS)',
			'printable_name' => 'Falkland Islands (Malvinas)',
			'iso3' => 'FLK',
			'numcode' => '238'
		),
		array(
			'id' => '70',
			'iso' => 'FO',
			'name' => 'FAROE ISLANDS',
			'printable_name' => 'Faroe Islands',
			'iso3' => 'FRO',
			'numcode' => '234'
		),
		array(
			'id' => '71',
			'iso' => 'FJ',
			'name' => 'FIJI',
			'printable_name' => 'Fiji',
			'iso3' => 'FJI',
			'numcode' => '242'
		),
		array(
			'id' => '72',
			'iso' => 'FI',
			'name' => 'FINLAND',
			'printable_name' => 'Finland',
			'iso3' => 'FIN',
			'numcode' => '246'
		),
		array(
			'id' => '73',
			'iso' => 'FR',
			'name' => 'FRANCE',
			'printable_name' => 'France',
			'iso3' => 'FRA',
			'numcode' => '250'
		),
		array(
			'id' => '74',
			'iso' => 'GF',
			'name' => 'FRENCH GUIANA',
			'printable_name' => 'French Guiana',
			'iso3' => 'GUF',
			'numcode' => '254'
		),
		array(
			'id' => '75',
			'iso' => 'PF',
			'name' => 'FRENCH POLYNESIA',
			'printable_name' => 'French Polynesia',
			'iso3' => 'PYF',
			'numcode' => '258'
		),
		array(
			'id' => '76',
			'iso' => 'TF',
			'name' => 'FRENCH SOUTHERN TERRITORIES',
			'printable_name' => 'French Southern Territories',
			'iso3' => NULL,
			'numcode' => NULL
		),
		array(
			'id' => '77',
			'iso' => 'GA',
			'name' => 'GABON',
			'printable_name' => 'Gabon',
			'iso3' => 'GAB',
			'numcode' => '266'
		),
		array(
			'id' => '78',
			'iso' => 'GM',
			'name' => 'GAMBIA',
			'printable_name' => 'Gambia',
			'iso3' => 'GMB',
			'numcode' => '270'
		),
		array(
			'id' => '79',
			'iso' => 'GE',
			'name' => 'GEORGIA',
			'printable_name' => 'Georgia',
			'iso3' => 'GEO',
			'numcode' => '268'
		),
		array(
			'id' => '80',
			'iso' => 'DE',
			'name' => 'GERMANY',
			'printable_name' => 'Germany',
			'iso3' => 'DEU',
			'numcode' => '276'
		),
		array(
			'id' => '81',
			'iso' => 'GH',
			'name' => 'GHANA',
			'printable_name' => 'Ghana',
			'iso3' => 'GHA',
			'numcode' => '288'
		),
		array(
			'id' => '82',
			'iso' => 'GI',
			'name' => 'GIBRALTAR',
			'printable_name' => 'Gibraltar',
			'iso3' => 'GIB',
			'numcode' => '292'
		),
		array(
			'id' => '83',
			'iso' => 'GR',
			'name' => 'GREECE',
			'printable_name' => 'Greece',
			'iso3' => 'GRC',
			'numcode' => '300'
		),
		array(
			'id' => '84',
			'iso' => 'GL',
			'name' => 'GREENLAND',
			'printable_name' => 'Greenland',
			'iso3' => 'GRL',
			'numcode' => '304'
		),
		array(
			'id' => '85',
			'iso' => 'GD',
			'name' => 'GRENADA',
			'printable_name' => 'Grenada',
			'iso3' => 'GRD',
			'numcode' => '308'
		),
		array(
			'id' => '86',
			'iso' => 'GP',
			'name' => 'GUADELOUPE',
			'printable_name' => 'Guadeloupe',
			'iso3' => 'GLP',
			'numcode' => '312'
		),
		array(
			'id' => '87',
			'iso' => 'GU',
			'name' => 'GUAM',
			'printable_name' => 'Guam',
			'iso3' => 'GUM',
			'numcode' => '316'
		),
		array(
			'id' => '88',
			'iso' => 'GT',
			'name' => 'GUATEMALA',
			'printable_name' => 'Guatemala',
			'iso3' => 'GTM',
			'numcode' => '320'
		),
		array(
			'id' => '89',
			'iso' => 'GN',
			'name' => 'GUINEA',
			'printable_name' => 'Guinea',
			'iso3' => 'GIN',
			'numcode' => '324'
		),
		array(
			'id' => '90',
			'iso' => 'GW',
			'name' => 'GUINEA-BISSAU',
			'printable_name' => 'Guinea-Bissau',
			'iso3' => 'GNB',
			'numcode' => '624'
		),
		array(
			'id' => '91',
			'iso' => 'GY',
			'name' => 'GUYANA',
			'printable_name' => 'Guyana',
			'iso3' => 'GUY',
			'numcode' => '328'
		),
		array(
			'id' => '92',
			'iso' => 'HT',
			'name' => 'HAITI',
			'printable_name' => 'Haiti',
			'iso3' => 'HTI',
			'numcode' => '332'
		),
		array(
			'id' => '93',
			'iso' => 'HM',
			'name' => 'HEARD ISLAND AND MCDONALD ISLANDS',
			'printable_name' => 'Heard Island and Mcdonald Islands',
			'iso3' => NULL,
			'numcode' => NULL
		),
		array(
			'id' => '94',
			'iso' => 'VA',
			'name' => 'HOLY SEE (VATICAN CITY STATE)',
			'printable_name' => 'Holy See (Vatican City State)',
			'iso3' => 'VAT',
			'numcode' => '336'
		),
		array(
			'id' => '95',
			'iso' => 'HN',
			'name' => 'HONDURAS',
			'printable_name' => 'Honduras',
			'iso3' => 'HND',
			'numcode' => '340'
		),
		array(
			'id' => '96',
			'iso' => 'HK',
			'name' => 'HONG KONG',
			'printable_name' => 'Hong Kong',
			'iso3' => 'HKG',
			'numcode' => '344'
		),
		array(
			'id' => '97',
			'iso' => 'HU',
			'name' => 'HUNGARY',
			'printable_name' => 'Hungary',
			'iso3' => 'HUN',
			'numcode' => '348'
		),
		array(
			'id' => '98',
			'iso' => 'IS',
			'name' => 'ICELAND',
			'printable_name' => 'Iceland',
			'iso3' => 'ISL',
			'numcode' => '352'
		),
		array(
			'id' => '99',
			'iso' => 'IN',
			'name' => 'INDIA',
			'printable_name' => 'India',
			'iso3' => 'IND',
			'numcode' => '356'
		),
		array(
			'id' => '100',
			'iso' => 'ID',
			'name' => 'INDONESIA',
			'printable_name' => 'Indonesia',
			'iso3' => 'IDN',
			'numcode' => '360'
		),
		array(
			'id' => '101',
			'iso' => 'IR',
			'name' => 'IRAN, ISLAMIC REPUBLIC OF',
			'printable_name' => 'Iran, Islamic Republic of',
			'iso3' => 'IRN',
			'numcode' => '364'
		),
		array(
			'id' => '102',
			'iso' => 'IQ',
			'name' => 'IRAQ',
			'printable_name' => 'Iraq',
			'iso3' => 'IRQ',
			'numcode' => '368'
		),
		array(
			'id' => '103',
			'iso' => 'IE',
			'name' => 'IRELAND',
			'printable_name' => 'Ireland',
			'iso3' => 'IRL',
			'numcode' => '372'
		),
		array(
			'id' => '104',
			'iso' => 'IL',
			'name' => 'ISRAEL',
			'printable_name' => 'Israel',
			'iso3' => 'ISR',
			'numcode' => '376'
		),
		array(
			'id' => '105',
			'iso' => 'IT',
			'name' => 'ITALY',
			'printable_name' => 'Italy',
			'iso3' => 'ITA',
			'numcode' => '380'
		),
		array(
			'id' => '106',
			'iso' => 'JM',
			'name' => 'JAMAICA',
			'printable_name' => 'Jamaica',
			'iso3' => 'JAM',
			'numcode' => '388'
		),
		array(
			'id' => '107',
			'iso' => 'JP',
			'name' => 'JAPAN',
			'printable_name' => 'Japan',
			'iso3' => 'JPN',
			'numcode' => '392'
		),
		array(
			'id' => '108',
			'iso' => 'JO',
			'name' => 'JORDAN',
			'printable_name' => 'Jordan',
			'iso3' => 'JOR',
			'numcode' => '400'
		),
		array(
			'id' => '109',
			'iso' => 'KZ',
			'name' => 'KAZAKHSTAN',
			'printable_name' => 'Kazakhstan',
			'iso3' => 'KAZ',
			'numcode' => '398'
		),
		array(
			'id' => '110',
			'iso' => 'KE',
			'name' => 'KENYA',
			'printable_name' => 'Kenya',
			'iso3' => 'KEN',
			'numcode' => '404'
		),
		array(
			'id' => '111',
			'iso' => 'KI',
			'name' => 'KIRIBATI',
			'printable_name' => 'Kiribati',
			'iso3' => 'KIR',
			'numcode' => '296'
		),
		array(
			'id' => '112',
			'iso' => 'KP',
			'name' => 'KOREA, DEMOCRATIC PEOPLE\'S REPUBLIC OF',
			'printable_name' => 'Korea, Democratic People\'s Republic of',
			'iso3' => 'PRK',
			'numcode' => '408'
		),
		array(
			'id' => '113',
			'iso' => 'KR',
			'name' => 'KOREA, REPUBLIC OF',
			'printable_name' => 'Korea, Republic of',
			'iso3' => 'KOR',
			'numcode' => '410'
		),
		array(
			'id' => '114',
			'iso' => 'KW',
			'name' => 'KUWAIT',
			'printable_name' => 'Kuwait',
			'iso3' => 'KWT',
			'numcode' => '414'
		),
		array(
			'id' => '115',
			'iso' => 'KG',
			'name' => 'KYRGYZSTAN',
			'printable_name' => 'Kyrgyzstan',
			'iso3' => 'KGZ',
			'numcode' => '417'
		),
		array(
			'id' => '116',
			'iso' => 'LA',
			'name' => 'LAO PEOPLE\'S DEMOCRATIC REPUBLIC',
			'printable_name' => 'Lao People\'s Democratic Republic',
			'iso3' => 'LAO',
			'numcode' => '418'
		),
		array(
			'id' => '117',
			'iso' => 'LV',
			'name' => 'LATVIA',
			'printable_name' => 'Latvia',
			'iso3' => 'LVA',
			'numcode' => '428'
		),
		array(
			'id' => '118',
			'iso' => 'LB',
			'name' => 'LEBANON',
			'printable_name' => 'Lebanon',
			'iso3' => 'LBN',
			'numcode' => '422'
		),
		array(
			'id' => '119',
			'iso' => 'LS',
			'name' => 'LESOTHO',
			'printable_name' => 'Lesotho',
			'iso3' => 'LSO',
			'numcode' => '426'
		),
		array(
			'id' => '120',
			'iso' => 'LR',
			'name' => 'LIBERIA',
			'printable_name' => 'Liberia',
			'iso3' => 'LBR',
			'numcode' => '430'
		),
		array(
			'id' => '121',
			'iso' => 'LY',
			'name' => 'LIBYAN ARAB JAMAHIRIYA',
			'printable_name' => 'Libyan Arab Jamahiriya',
			'iso3' => 'LBY',
			'numcode' => '434'
		),
		array(
			'id' => '122',
			'iso' => 'LI',
			'name' => 'LIECHTENSTEIN',
			'printable_name' => 'Liechtenstein',
			'iso3' => 'LIE',
			'numcode' => '438'
		),
		array(
			'id' => '123',
			'iso' => 'LT',
			'name' => 'LITHUANIA',
			'printable_name' => 'Lithuania',
			'iso3' => 'LTU',
			'numcode' => '440'
		),
		array(
			'id' => '124',
			'iso' => 'LU',
			'name' => 'LUXEMBOURG',
			'printable_name' => 'Luxembourg',
			'iso3' => 'LUX',
			'numcode' => '442'
		),
		array(
			'id' => '125',
			'iso' => 'MO',
			'name' => 'MACAO',
			'printable_name' => 'Macao',
			'iso3' => 'MAC',
			'numcode' => '446'
		),
		array(
			'id' => '126',
			'iso' => 'MK',
			'name' => 'MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF',
			'printable_name' => 'Macedonia, the Former Yugoslav Republic of',
			'iso3' => 'MKD',
			'numcode' => '807'
		),
		array(
			'id' => '127',
			'iso' => 'MG',
			'name' => 'MADAGASCAR',
			'printable_name' => 'Madagascar',
			'iso3' => 'MDG',
			'numcode' => '450'
		),
		array(
			'id' => '128',
			'iso' => 'MW',
			'name' => 'MALAWI',
			'printable_name' => 'Malawi',
			'iso3' => 'MWI',
			'numcode' => '454'
		),
		array(
			'id' => '129',
			'iso' => 'MY',
			'name' => 'MALAYSIA',
			'printable_name' => 'Malaysia',
			'iso3' => 'MYS',
			'numcode' => '458'
		),
		array(
			'id' => '130',
			'iso' => 'MV',
			'name' => 'MALDIVES',
			'printable_name' => 'Maldives',
			'iso3' => 'MDV',
			'numcode' => '462'
		),
		array(
			'id' => '131',
			'iso' => 'ML',
			'name' => 'MALI',
			'printable_name' => 'Mali',
			'iso3' => 'MLI',
			'numcode' => '466'
		),
		array(
			'id' => '132',
			'iso' => 'MT',
			'name' => 'MALTA',
			'printable_name' => 'Malta',
			'iso3' => 'MLT',
			'numcode' => '470'
		),
		array(
			'id' => '133',
			'iso' => 'MH',
			'name' => 'MARSHALL ISLANDS',
			'printable_name' => 'Marshall Islands',
			'iso3' => 'MHL',
			'numcode' => '584'
		),
		array(
			'id' => '134',
			'iso' => 'MQ',
			'name' => 'MARTINIQUE',
			'printable_name' => 'Martinique',
			'iso3' => 'MTQ',
			'numcode' => '474'
		),
		array(
			'id' => '135',
			'iso' => 'MR',
			'name' => 'MAURITANIA',
			'printable_name' => 'Mauritania',
			'iso3' => 'MRT',
			'numcode' => '478'
		),
		array(
			'id' => '136',
			'iso' => 'MU',
			'name' => 'MAURITIUS',
			'printable_name' => 'Mauritius',
			'iso3' => 'MUS',
			'numcode' => '480'
		),
		array(
			'id' => '137',
			'iso' => 'YT',
			'name' => 'MAYOTTE',
			'printable_name' => 'Mayotte',
			'iso3' => NULL,
			'numcode' => NULL
		),
		array(
			'id' => '138',
			'iso' => 'MX',
			'name' => 'MEXICO',
			'printable_name' => 'Mexico',
			'iso3' => 'MEX',
			'numcode' => '484'
		),
		array(
			'id' => '139',
			'iso' => 'FM',
			'name' => 'MICRONESIA, FEDERATED STATES OF',
			'printable_name' => 'Micronesia, Federated States of',
			'iso3' => 'FSM',
			'numcode' => '583'
		),
		array(
			'id' => '140',
			'iso' => 'MD',
			'name' => 'MOLDOVA, REPUBLIC OF',
			'printable_name' => 'Moldova, Republic of',
			'iso3' => 'MDA',
			'numcode' => '498'
		),
		array(
			'id' => '141',
			'iso' => 'MC',
			'name' => 'MONACO',
			'printable_name' => 'Monaco',
			'iso3' => 'MCO',
			'numcode' => '492'
		),
		array(
			'id' => '142',
			'iso' => 'MN',
			'name' => 'MONGOLIA',
			'printable_name' => 'Mongolia',
			'iso3' => 'MNG',
			'numcode' => '496'
		),
		array(
			'id' => '143',
			'iso' => 'MS',
			'name' => 'MONTSERRAT',
			'printable_name' => 'Montserrat',
			'iso3' => 'MSR',
			'numcode' => '500'
		),
		array(
			'id' => '144',
			'iso' => 'MA',
			'name' => 'MOROCCO',
			'printable_name' => 'Morocco',
			'iso3' => 'MAR',
			'numcode' => '504'
		),
		array(
			'id' => '145',
			'iso' => 'MZ',
			'name' => 'MOZAMBIQUE',
			'printable_name' => 'Mozambique',
			'iso3' => 'MOZ',
			'numcode' => '508'
		),
		array(
			'id' => '146',
			'iso' => 'MM',
			'name' => 'MYANMAR',
			'printable_name' => 'Myanmar',
			'iso3' => 'MMR',
			'numcode' => '104'
		),
		array(
			'id' => '147',
			'iso' => 'NA',
			'name' => 'NAMIBIA',
			'printable_name' => 'Namibia',
			'iso3' => 'NAM',
			'numcode' => '516'
		),
		array(
			'id' => '148',
			'iso' => 'NR',
			'name' => 'NAURU',
			'printable_name' => 'Nauru',
			'iso3' => 'NRU',
			'numcode' => '520'
		),
		array(
			'id' => '149',
			'iso' => 'NP',
			'name' => 'NEPAL',
			'printable_name' => 'Nepal',
			'iso3' => 'NPL',
			'numcode' => '524'
		),
		array(
			'id' => '150',
			'iso' => 'NL',
			'name' => 'NETHERLANDS',
			'printable_name' => 'Netherlands',
			'iso3' => 'NLD',
			'numcode' => '528'
		),
		array(
			'id' => '151',
			'iso' => 'AN',
			'name' => 'NETHERLANDS ANTILLES',
			'printable_name' => 'Netherlands Antilles',
			'iso3' => 'ANT',
			'numcode' => '530'
		),
		array(
			'id' => '152',
			'iso' => 'NC',
			'name' => 'NEW CALEDONIA',
			'printable_name' => 'New Caledonia',
			'iso3' => 'NCL',
			'numcode' => '540'
		),
		array(
			'id' => '153',
			'iso' => 'NZ',
			'name' => 'NEW ZEALAND',
			'printable_name' => 'New Zealand',
			'iso3' => 'NZL',
			'numcode' => '554'
		),
		array(
			'id' => '154',
			'iso' => 'NI',
			'name' => 'NICARAGUA',
			'printable_name' => 'Nicaragua',
			'iso3' => 'NIC',
			'numcode' => '558'
		),
		array(
			'id' => '155',
			'iso' => 'NE',
			'name' => 'NIGER',
			'printable_name' => 'Niger',
			'iso3' => 'NER',
			'numcode' => '562'
		),
		array(
			'id' => '156',
			'iso' => 'NG',
			'name' => 'NIGERIA',
			'printable_name' => 'Nigeria',
			'iso3' => 'NGA',
			'numcode' => '566'
		),
		array(
			'id' => '157',
			'iso' => 'NU',
			'name' => 'NIUE',
			'printable_name' => 'Niue',
			'iso3' => 'NIU',
			'numcode' => '570'
		),
		array(
			'id' => '158',
			'iso' => 'NF',
			'name' => 'NORFOLK ISLAND',
			'printable_name' => 'Norfolk Island',
			'iso3' => 'NFK',
			'numcode' => '574'
		),
		array(
			'id' => '159',
			'iso' => 'MP',
			'name' => 'NORTHERN MARIANA ISLANDS',
			'printable_name' => 'Northern Mariana Islands',
			'iso3' => 'MNP',
			'numcode' => '580'
		),
		array(
			'id' => '160',
			'iso' => 'NO',
			'name' => 'NORWAY',
			'printable_name' => 'Norway',
			'iso3' => 'NOR',
			'numcode' => '578'
		),
		array(
			'id' => '161',
			'iso' => 'OM',
			'name' => 'OMAN',
			'printable_name' => 'Oman',
			'iso3' => 'OMN',
			'numcode' => '512'
		),
		array(
			'id' => '162',
			'iso' => 'PK',
			'name' => 'PAKISTAN',
			'printable_name' => 'Pakistan',
			'iso3' => 'PAK',
			'numcode' => '586'
		),
		array(
			'id' => '163',
			'iso' => 'PW',
			'name' => 'PALAU',
			'printable_name' => 'Palau',
			'iso3' => 'PLW',
			'numcode' => '585'
		),
		array(
			'id' => '164',
			'iso' => 'PS',
			'name' => 'PALESTINIAN TERRITORY, OCCUPIED',
			'printable_name' => 'Palestinian Territory, Occupied',
			'iso3' => NULL,
			'numcode' => NULL
		),
		array(
			'id' => '165',
			'iso' => 'PA',
			'name' => 'PANAMA',
			'printable_name' => 'Panama',
			'iso3' => 'PAN',
			'numcode' => '591'
		),
		array(
			'id' => '166',
			'iso' => 'PG',
			'name' => 'PAPUA NEW GUINEA',
			'printable_name' => 'Papua New Guinea',
			'iso3' => 'PNG',
			'numcode' => '598'
		),
		array(
			'id' => '167',
			'iso' => 'PY',
			'name' => 'PARAGUAY',
			'printable_name' => 'Paraguay',
			'iso3' => 'PRY',
			'numcode' => '600'
		),
		array(
			'id' => '168',
			'iso' => 'PE',
			'name' => 'PERU',
			'printable_name' => 'Peru',
			'iso3' => 'PER',
			'numcode' => '604'
		),
		array(
			'id' => '169',
			'iso' => 'PH',
			'name' => 'PHILIPPINES',
			'printable_name' => 'Philippines',
			'iso3' => 'PHL',
			'numcode' => '608'
		),
		array(
			'id' => '170',
			'iso' => 'PN',
			'name' => 'PITCAIRN',
			'printable_name' => 'Pitcairn',
			'iso3' => 'PCN',
			'numcode' => '612'
		),
		array(
			'id' => '171',
			'iso' => 'PL',
			'name' => 'POLAND',
			'printable_name' => 'Poland',
			'iso3' => 'POL',
			'numcode' => '616'
		),
		array(
			'id' => '172',
			'iso' => 'PT',
			'name' => 'PORTUGAL',
			'printable_name' => 'Portugal',
			'iso3' => 'PRT',
			'numcode' => '620'
		),
		array(
			'id' => '173',
			'iso' => 'PR',
			'name' => 'PUERTO RICO',
			'printable_name' => 'Puerto Rico',
			'iso3' => 'PRI',
			'numcode' => '630'
		),
		array(
			'id' => '174',
			'iso' => 'QA',
			'name' => 'QATAR',
			'printable_name' => 'Qatar',
			'iso3' => 'QAT',
			'numcode' => '634'
		),
		array(
			'id' => '175',
			'iso' => 'RE',
			'name' => 'REUNION',
			'printable_name' => 'Reunion',
			'iso3' => 'REU',
			'numcode' => '638'
		),
		array(
			'id' => '176',
			'iso' => 'RO',
			'name' => 'ROMANIA',
			'printable_name' => 'Romania',
			'iso3' => 'ROM',
			'numcode' => '642'
		),
		array(
			'id' => '177',
			'iso' => 'RU',
			'name' => 'RUSSIAN FEDERATION',
			'printable_name' => 'Russian Federation',
			'iso3' => 'RUS',
			'numcode' => '643'
		),
		array(
			'id' => '178',
			'iso' => 'RW',
			'name' => 'RWANDA',
			'printable_name' => 'Rwanda',
			'iso3' => 'RWA',
			'numcode' => '646'
		),
		array(
			'id' => '179',
			'iso' => 'SH',
			'name' => 'SAINT HELENA',
			'printable_name' => 'Saint Helena',
			'iso3' => 'SHN',
			'numcode' => '654'
		),
		array(
			'id' => '180',
			'iso' => 'KN',
			'name' => 'SAINT KITTS AND NEVIS',
			'printable_name' => 'Saint Kitts and Nevis',
			'iso3' => 'KNA',
			'numcode' => '659'
		),
		array(
			'id' => '181',
			'iso' => 'LC',
			'name' => 'SAINT LUCIA',
			'printable_name' => 'Saint Lucia',
			'iso3' => 'LCA',
			'numcode' => '662'
		),
		array(
			'id' => '182',
			'iso' => 'PM',
			'name' => 'SAINT PIERRE AND MIQUELON',
			'printable_name' => 'Saint Pierre and Miquelon',
			'iso3' => 'SPM',
			'numcode' => '666'
		),
		array(
			'id' => '183',
			'iso' => 'VC',
			'name' => 'SAINT VINCENT AND THE GRENADINES',
			'printable_name' => 'Saint Vincent and the Grenadines',
			'iso3' => 'VCT',
			'numcode' => '670'
		),
		array(
			'id' => '184',
			'iso' => 'WS',
			'name' => 'SAMOA',
			'printable_name' => 'Samoa',
			'iso3' => 'WSM',
			'numcode' => '882'
		),
		array(
			'id' => '185',
			'iso' => 'SM',
			'name' => 'SAN MARINO',
			'printable_name' => 'San Marino',
			'iso3' => 'SMR',
			'numcode' => '674'
		),
		array(
			'id' => '186',
			'iso' => 'ST',
			'name' => 'SAO TOME AND PRINCIPE',
			'printable_name' => 'Sao Tome and Principe',
			'iso3' => 'STP',
			'numcode' => '678'
		),
		array(
			'id' => '187',
			'iso' => 'SA',
			'name' => 'SAUDI ARABIA',
			'printable_name' => 'Saudi Arabia',
			'iso3' => 'SAU',
			'numcode' => '682'
		),
		array(
			'id' => '188',
			'iso' => 'SN',
			'name' => 'SENEGAL',
			'printable_name' => 'Senegal',
			'iso3' => 'SEN',
			'numcode' => '686'
		),
		array(
			'id' => '189',
			'iso' => 'CS',
			'name' => 'SERBIA AND MONTENEGRO',
			'printable_name' => 'Serbia and Montenegro',
			'iso3' => NULL,
			'numcode' => NULL
		),
		array(
			'id' => '190',
			'iso' => 'SC',
			'name' => 'SEYCHELLES',
			'printable_name' => 'Seychelles',
			'iso3' => 'SYC',
			'numcode' => '690'
		),
		array(
			'id' => '191',
			'iso' => 'SL',
			'name' => 'SIERRA LEONE',
			'printable_name' => 'Sierra Leone',
			'iso3' => 'SLE',
			'numcode' => '694'
		),
		array(
			'id' => '192',
			'iso' => 'SG',
			'name' => 'SINGAPORE',
			'printable_name' => 'Singapore',
			'iso3' => 'SGP',
			'numcode' => '702'
		),
		array(
			'id' => '193',
			'iso' => 'SK',
			'name' => 'SLOVAKIA',
			'printable_name' => 'Slovakia',
			'iso3' => 'SVK',
			'numcode' => '703'
		),
		array(
			'id' => '194',
			'iso' => 'SI',
			'name' => 'SLOVENIA',
			'printable_name' => 'Slovenia',
			'iso3' => 'SVN',
			'numcode' => '705'
		),
		array(
			'id' => '195',
			'iso' => 'SB',
			'name' => 'SOLOMON ISLANDS',
			'printable_name' => 'Solomon Islands',
			'iso3' => 'SLB',
			'numcode' => '90'
		),
		array(
			'id' => '196',
			'iso' => 'SO',
			'name' => 'SOMALIA',
			'printable_name' => 'Somalia',
			'iso3' => 'SOM',
			'numcode' => '706'
		),
		array(
			'id' => '197',
			'iso' => 'ZA',
			'name' => 'SOUTH AFRICA',
			'printable_name' => 'South Africa',
			'iso3' => 'ZAF',
			'numcode' => '710'
		),
		array(
			'id' => '198',
			'iso' => 'GS',
			'name' => 'SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS',
			'printable_name' => 'South Georgia and the South Sandwich Islands',
			'iso3' => NULL,
			'numcode' => NULL
		),
		array(
			'id' => '199',
			'iso' => 'ES',
			'name' => 'SPAIN',
			'printable_name' => 'Spain',
			'iso3' => 'ESP',
			'numcode' => '724'
		),
		array(
			'id' => '200',
			'iso' => 'LK',
			'name' => 'SRI LANKA',
			'printable_name' => 'Sri Lanka',
			'iso3' => 'LKA',
			'numcode' => '144'
		),
	);
}
