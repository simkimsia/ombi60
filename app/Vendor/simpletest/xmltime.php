<?php


/**#@+
 *  include other SimpleTest class files
 */
require_once(dirname(__FILE__) . '/xml.php');
/**#@-*/

  /**
   * extend default XmlReporter to record & report time to run each test method
   */

class XmlTimeReporter extends XmlReporter {
  var $pre;

  function paintMethodStart($test_name) {
    $this->pre = microtime();
    parent::paintMethodStart($test_name);
  }

  function paintMethodEnd($test_name) {
    $post = microtime();
    if ($this->pre != null) {
      $duration = $post - $this->pre;
      // how can post time be less than pre?  assuming zero if this happens..
      if ($post < $this->pre) $duration = 0;
      print $this->_getIndent(1);
      print "<time>$duration</time>\n";
    }
    parent::paintMethodEnd($test_name);
    $this->pre = null;
  }

}

?>