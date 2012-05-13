<?php
/**
 * AllTests file
 *
 */
/**
 * AllTests class
 *
 * This test group will run all test in the cases/libs/models/behaviors directory
 *
 * @package       Ombi60.Test.Case
 */
class AllTests extends PHPUnit_Framework_TestSuite {

/**
 * Suite define the tests for this suite
 *
 * @return void
 */
	public static function suite() {
		$suite = new PHPUnit_Framework_TestSuite('All Tests');

		$path = APP_TEST_CASES . DS;

		// need to run this first because we have issues with the MerchantTest running later than other tests
		$suite->addTestFile($path . 'AllModelTest.php');
		// add a comment to test jenkins polling does not affect build trigger
		// $suite->addTestFile($path . 'AllConsoleTest.php');
		// $suite->addTestFile($path . 'AllBehaviorsTest.php');
		// $suite->addTestFile($path . 'AllComponentsTest.php');
		$suite->addTestFile($path . 'AllControllerTest.php');
		// $suite->addTestFile($path . 'AllHelpersTest.php');

		// $suite->addTestFile($path . 'AllViewTest.php');

		// $suite->addTestFile($path . 'AllSeleniumTest.php');

		return $suite;
	}
}
