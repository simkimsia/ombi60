<?php
/**
 * AllControllersTest file
 *
 */
/**
 * AllControllersTest class
 *
 * This test group will run cache engine tests.
 *
 * @package       Ombi60.Test.Case
 */
class AllControllersTest extends PHPUnit_Framework_TestSuite {

/**
 * suite method, defines tests for this suite.
 *
 * @return void
 */
	public static function suite() {
		$suite = new CakeTestSuite('All Controller related class tests');

		$path = APP_TEST_CASES . DS . 'Controller' . DS;

		$suite->addTestFile($path . 'BlogsControllerTest.php');
		$suite->addTestFile($path . 'CartsControllerTest.php');
		//$suite->addTestFile($path . 'CustomersControllerTest.php');
		$suite->addTestFile($path . 'DomainsControllerTest.php');
		/*
		$suite->addTestFile($path . 'GiftCardsControllerTest.php');
		$suite->addTestFile($path . 'GroupsControllerTest.php');
		*/
		$suite->addTestFile($path . 'LinkListsControllerTest.php');
		/*
		$suite->addTestFile($path . 'LinksControllerTest.php');
		$suite->addTestFile($path . 'MerchantsControllerTest.php');
		*/
		$suite->addTestFile($path . 'OrdersControllerTest.php');
		/*
		$suite->addTestFile($path . 'PageTypesControllerTest.php');
		$suite->addTestFile($path . 'PaydollarTransactionsControllerTest.php');
		$suite->addTestFile($path . 'PaymentsControllerTest.php');
		$suite->addTestFile($path . 'PostsControllerTest.php');
		$suite->addTestFile($path . 'ProductGroupsControllerTest.php');
		$suite->addTestFile($path . 'ProductImagesControllerTest.php');
		$suite->addTestFile($path . 'ProductsControllerTest.php');
		$suite->addTestFile($path . 'SavedThemesControllerTest.php');
		$suite->addTestFile($path . 'ShippingRatesControllerTest.php');
		$suite->addTestFile($path . 'ShopsControllerTest.php');
		$suite->addTestFile($path . 'ThemesControllerTest.php');
		$suite->addTestFile($path . 'UsersControllerTest.php');
		$suite->addTestFile($path . 'WebpagesControllerTest.php');
		*/

		return $suite;
	}
}


		