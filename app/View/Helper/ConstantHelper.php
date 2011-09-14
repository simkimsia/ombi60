<?php
class ConstantHelper extends AppHelper {

	function displayPayment($constantValue) {
		switch($constantValue) {
			case PAYMENT_ABANDONED :
				return 'Abandoned';

			case PAYMENT_AUTHORIZED :
				return 'Authorized';

			case PAYMENT_PAID :
				return 'Paid';
			case PAYMENT_PENDING :
				return 'Pending';

			default :
				return '';
		}
	}

	function displayFulfillment($constantValue) {
		switch($constantValue) {
			case FULFILLMENT_FULFILLED :
				return 'Fulfilled';

			case FULFILLMENT_NOT_FULFILLED :
				return 'Not Fulfilled';

			case FULFILLMENT_PARTIAL :
				return 'Partial';
			default :
				return '';
		}
	}

	function displayUnitForWeight() {
		App::uses('Shop', 'Model');
		$unit = Shop::get('ShopSetting.unit_system');

		if ($unit === 'metric') {
			return 'kg';
		} else {
			return 'lb';
		}
	}

	function displayUnitForLength() {
		App::uses('Shop', 'Model');
		$unit = Shop::get('ShopSetting.unit_system');

		if ($unit === 'metric') {
			return 'cm';
		} else {
			return 'in';
		}
	}

/**
 * the more or less equivalent of WeightWithUnit in ombi60Twig Extension
 * usually used within cakephp admin views
 **/
	function convertGramsToDisplayedWeight($weight_in_grams, $with_unit = true) {
		App::uses('Shop', 'Model');
		$unit = Shop::get('ShopSetting.unit_system');

		App::uses('Number', 'View/Helper');
		$number = new NumberHelper();

		$result_weight = 0.0;


		if ($unit === 'metric') {
			$result_weight =  $weight_in_grams * 0.001;
			$unit_symbol = ($with_unit) ? ' kg' : '' ;
			return $number->precision($result_weight, 1) . $unit_symbol;
		} else {
			$result_weight =  $weight_in_grams * 0.00220462262;
			$unit_symbol = ($with_unit) ? ' lb' : '' ;
			return $number->precision($result_weight, 1) . $unit_symbol;
		}
	}
}