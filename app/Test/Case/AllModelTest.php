<?php
/**
 * AllModelTest file
 *
 */
/**
 * AllModelTest class
 *
 * This test group will run model class tests
 *
 * @package       Ombi60.Test.Case
 */
class AllModelTest extends PHPUnit_Framework_TestSuite {

/**
 * suite method, defines tests for this suite.
 *
 * @return void
 */
	public static function suite() {
		$suite = new PHPUnit_Framework_TestSuite('All Model related class tests');

		$path = APP_TEST_CASES . DS . 'Model' . DS;

		$suite->addTestFile($path . 'AddressTest.php');
		//$suite->addTestFile($path . 'AppModelTest.php');
		$suite->addTestFile($path . 'BlogTest.php');
		$suite->addTestFile($path . 'CartItemTest.php');
		$suite->addTestFile($path . 'CartTest.php');
		$suite->addTestFile($path . 'CasualSurferTest.php');
		$suite->addTestFile($path . 'CountryTest.php');
		$suite->addTestFile($path . 'CustomerTest.php');
		$suite->addTestFile($path . 'DomainTest.php');
		$suite->addTestFile($path . 'LinkListTest.php');
		$suite->addTestFile($path . 'LinkTest.php');
		$suite->addTestFile($path . 'MerchantTest.php');
		//$suite->addTestFile($path . 'OrderLineItemTest.php');
		$suite->addTestFile($path . 'OrderTest.php');
		/*
		$suite->addTestFile($path . 'PageTypeTest.php');
		$suite->addTestFile($path . 'PaydollarTransactionTest.php');
		$suite->addTestFile($path . 'PaymentModuleTest.php');
		**/
		$suite->addTestFile($path . 'PaymentTest.php');
		/*
		$suite->addTestFile($path . 'PaypalPayerTest.php');
		$suite->addTestFile($path . 'PaypalPayersPaymentTest.php');
		
		$suite->addTestFile($path . 'PostTest.php');
		$suite->addTestFile($path . 'PriceBasedRateTest.php');
		
		$suite->addTestFile($path . 'ProductGroupTest.php');
		$suite->addTestFile($path . 'ProductImageTest.php');
		$suite->addTestFile($path . 'ProductOptionTest.php');
		*/
		$suite->addTestFile($path . 'ProductTest.php');
		/*
		$suite->addTestFile($path . 'ProductTypeTest.php');
		$suite->addTestFile($path . 'ProductsInGroupTest.php');
		$suite->addTestFile($path . 'RecurringPaymentProfile.php');
		
		$suite->addTestFile($path . 'SavedThemeTest.php');
		**/
		$suite->addTestFile($path . 'ShipmentTest.php');
		/*
		$suite->addTestFile($path . 'ShippedToCountryTest.php');
		$suite->addTestFile($path . 'ShippingRateTest.php');
		
		$suite->addTestFile($path . 'ShopSettingTest.php');
		$suite->addTestFile($path . 'ShopTest.php');
		$suite->addTestFile($path . 'ShopsPaymentModuleTest.php');
		$suite->addTestFile($path . 'SubscriptionPlanTest.php');
		$suite->addTestFile($path . 'ThemeTest.php');
		$suite->addTestFile($path . 'UserTest.php');
		$suite->addTestFile($path . 'VariantOptionTest.php');
		$suite->addTestFile($path . 'VariantTest.php');
		$suite->addTestFile($path . 'VendorTest.php');
		$suite->addTestFile($path . 'WeightBasedRateTest.php');
		$suite->addTestFile($path . 'WishlistTest.php');
		*/

		return $suite;
	}
}
