<?php

$path = dirname(__FILE__).'/../../lib/client/';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);
$path .= 'PEAR/';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);
require_once(dirname(__FILE__) . '/../../../../test/bootstrap/functional.php');
require_once(dirname(__FILE__). '/../../../../test/bootstrap/unit.php');
//spawn a new process to run the java selenium server



/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


// guess current application
if (!isset($app))
{
  $traces = debug_backtrace();
  $caller = $traces[0];

  $dirPieces = explode(DIRECTORY_SEPARATOR, dirname($caller['file']));
  $app = array_pop($dirPieces);
}

require_once dirname(__FILE__).'/../../../../config/ProjectConfiguration.class.php';
$configuration = ProjectConfiguration::getApplicationConfiguration($app, 'test', isset($debug) ? $debug : true);
sfContext::createInstance($configuration);

// remove all cache
sfToolkit::clearDirectory(sfConfig::get('sf_app_cache_dir'));

Doctrine::loadData(sfConfig::get('sf_test_dir').'/fixtures'); 

