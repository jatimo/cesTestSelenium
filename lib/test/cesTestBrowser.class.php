<?php
class cesTestBrowser
{
  protected $testFunctional;
  public $external_browser;
  protected $engine;
  public $testChain = array();
  public function getTestFunctional()
  {
    return $this->testFunctional;
  }
  public function __construct($stay_open=false, $browser="firefox", $url="http://localhost/", $host="127.0.0.1", $port="4444")
  {
    $this->stayOpen = $stay_open;
    $this->engine = $browser;
    $this->testFunctional  = new cesTestFunctional(new sfBrowser());
    //$this->testFunctional->loadData();
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
    if ($this->engine != "mock" && !$this->stayOpen) {
      $this->external_browser->stop();
    }
  }

}