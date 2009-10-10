<?php
class cesTestBrowser
{
  protected $sfTestFunctional;
  public $external_browser;
  protected $engine;
  public $testChain = array();
  public function getSfTestFunctional()
  {
    return $this->sfTestFunctional;
  }
  public function __construct($stay_open=false, $browser="firefox", $url="http://localhost/", $host="127.0.0.1", $port="4444")
  {
    $this->stayOpen = $stay_open;
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
    $this->buildTestChain();
    $this->executeTestChain();
  }
  public function buildTestChain()
  {
    $this->testChain = array();
    foreach (get_class_methods(get_class($this)) as $testMethodName)
    {
      if (preg_match('/^(.*)Test$/', $testMethodName))
      {
        $this->testChain[] = $testMethodName;
      }
    }
    return $this->testChain;
  }
  public function executeTestChain()
  {
    foreach ($this->testChain as $testMethod)
    {
      $this->$testMethod();
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