<?php

class cesTestSelenium extends sfTestFunctional
{
  protected $shutdownBrowser = true;

  public function __construct(cesTestBrowser $browser, lime_test $lime = null, $testers = array())
  {
    $this->browser = $browser;

    if (is_null(self::$test))
    {
      self::$test = !is_null($lime) ? $lime : new lime_test(null, new lime_output_color());
    }

    register_shutdown_function(array($this, 'shutdown'));
  }
  
  /**
   * event fires when the test is complete. put any cleanup work here
   */
  public function shutdown()
  {
    if ($this->shutdownBrowser)
    {
    }
  }
}
