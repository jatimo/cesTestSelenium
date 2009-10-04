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
  public function getSeleniumBrowser()
  {
    return $this->browser->external_browser;
  }
  public function shutdown()
  {
    if ($this->shutdownBrowser)
    {
    }
  }
}
