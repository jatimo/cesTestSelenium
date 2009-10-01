<?php

class cesTestSelenium extends sfTestFunctional
{
  protected $shutdownBrowser = true;

  public function __construct(cesSeleniumBrowser $browser, lime_test $lime = null, $testers = array())
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


class cesSeleniumBrowser
{
  protected $sfTestFunctional;
  protected $external_browser;
  protected $engine;
  public function getSfTestFunctional()
  {
    return $this->sfTestFunctional;
  }
  public function __construct($browser="mock", $url="http://localhost/", $host="127.0.0.1", $port="4444")
  {
    $this->engine = $browser;
    $this->sfTestFunctional  = new sfTestFunctional(new sfBrowser());
    if ($browser == "firefox") {
      $this->external_browser = new Testing_Selenium("*firefox", $url, $host . ":" . $port);
      $this->external_browser->start();
    }
    elseif($browser == "mock-se") {
      $this->external_browser = new Testing_Selenium("*mock", $url, $host . ":" . $port);
      $this->external_browser->start();
    }
  }
  
  public function getEngine()
  {
    return $this->engine;
  }
  public function __destruct()
  {
    if ($this->engine != "mock") {
      $this->internal_browser->stop();
    }
  }
}