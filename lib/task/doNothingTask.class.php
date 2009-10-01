<?php
class doNothingTask extends sfBaseTask
{
  protected function configure()
  {
    $this->namespace        = 'project';
    $this->name             = 'do-nothing';
    $this->briefDescription = 'Does strictly nothing';
 
    $this->detailedDescription = <<<EOF
This task is completely useless, and should be run as often as possible.
EOF;
  }
 
  protected function execute($arguments = array(), $options = array())
  {
    $test = new test();
    $this->logSection('do-nothing', 'I did nothing successfully!');
  }
}