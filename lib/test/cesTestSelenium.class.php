<?php

class cesTestSelenium extends sfTestFunctional
{
  protected $shutdownBrowser = true;

  public function __construct(cesTestBrowser $browser, lime_test $lime = null, $testers = array())
  {
    $this->test()->info('Test System Bootstrapped... Configuring..');
    $this->browser = $browser;

    if (is_null(self::$test))
    {
      self::$test = !is_null($lime) ? $lime : new lime_test(null, new lime_output_color());
    }

    register_shutdown_function(array($this, 'shutdown'));
    $this->configure();
    $this->test()->info('Building Test Chain...');
    $this->buildTestChain();
    $this->test()->info('Executing Test Chain...');
    $this->executeTestChain();
  }
  public function configure() {}
  
  public function loadCases($fileSpec)
  {
    $absoluteFileSpec = sfConfig::get('sf_root_dir') . "/test/cases/" . $fileSpec . ".yml";
    if (file_exists($absoluteFileSpec))
    {
      return sfYaml::load($absoluteFileSpec);
    }
    else
    {
      throw new sfException("File not found: {$absoluteFileSpec}");
    }
  }
  public function getSeleniumBrowser()
  {
    return $this->browser->external_browser;
  }
  public function shutdown()
  {
    if ($this->shutdownBrowser)
    {
      $this->getSeleniumBrowser()->stop();
    }
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
      $this->test()->info("{$testMethod}:");
      $this->$testMethod();
    }
  }
  
}
