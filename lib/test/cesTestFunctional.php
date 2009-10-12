<?php
class cesTestFunctional extends sfTestFunctional
{
  public function loadData()
  {
    Doctrine::loadData(sfConfig::get('sf_test_dir').'/fixtures'); 
    return $this;
  }
}
?>