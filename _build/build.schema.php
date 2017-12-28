<?php
/**
 * TableRates module for Commerce
 *
 * Copyright 2012-2013 by Mark Hamstra <hello@markhamstra.com>
 *
*/
$mtime = microtime();
$mtime = explode(" ", $mtime);
$mtime = $mtime[1] + $mtime[0];
$tstart = $mtime;
set_time_limit(0);

/* define package name */
define('PKG_NAME','Commerce_TableRates');
define('PKG_NAME_LOWER',strtolower(PKG_NAME));

require_once dirname(dirname(__FILE__)) . '/config.core.php';
include_once MODX_CORE_PATH . 'model/modx/modx.class.php';
$modx= new modX();
$modx->initialize('mgr');
$modx->loadClass('transport.modPackageBuilder','',false, true);
$modx->setLogLevel(modX::LOG_LEVEL_INFO);
$modx->setLogTarget(XPDO_CLI_MODE ? 'ECHO' : 'HTML');

$root = dirname(dirname(__FILE__)).'/';
$sources = array(
    'root' => $root,
    'core' => $root.'core/components/commerce_tablerates/',
    'model' => $root.'core/components/commerce_tablerates/model/',
    'assets' => $root.'assets/components/commerce_tablerates/',
    'schema' => $root.'core/components/commerce_tablerates/model/schema/',
);
$manager= $modx->getManager();
$generator= $manager->getGenerator();
$generator->classTemplate= <<<EOD
<?php
/**
 * TableRates extension for Commerce
 *
 * Copyright 2017 by Mark Hamstra <mark@modmore.com>
 *
 * This file is meant to be used with Commerce by modmore. A valid Commerce license is required.
 *
 * @package commerce_tablerates
 * @author Mark Hamstra <mark@modmore.com>
 * @license See core/components/commerce_tablerates/docs/license.txt
 */
class [+class+] extends [+extends+]
{

}

EOD;
    $generator->platformTemplate= <<<EOD
<?php
require_once strtr(realpath(dirname(dirname(__FILE__))), '\\\\', '/') . '/[+class-lowercase+].class.php';
/**
 * TableRates extension for Commerce
 *
 * Copyright 2017 by Mark Hamstra <mark@modmore.com>
 *
 * This file is meant to be used with Commerce by modmore. A valid Commerce license is required.
 *
 * @package commerce_tablerates
 * @author Mark Hamstra <mark@modmore.com>
 * @license See core/components/commerce_tablerates/docs/license.txt
 */
class [+class+]_[+platform+] extends [+class+]
{

}

EOD;
    $generator->mapHeader= <<<EOD
<?php
/**
 * TableRates extension for Commerce
 *
 * Copyright 2017 by Mark Hamstra <mark@modmore.com>
 *
 * This file is meant to be used with Commerce by modmore. A valid Commerce license is required.
 *
 * @package commerce_tablerates
 * @author Mark Hamstra <mark@modmore.com>
 * @license See core/components/commerce_tablerates/docs/license.txt
 */

EOD;

$generator->parseSchema($sources['schema'] . 'commerce_tablerates.mysql.schema.xml', $sources['model']);


$mtime= microtime();
$mtime= explode(" ", $mtime);
$mtime= $mtime[1] + $mtime[0];
$tend= $mtime;
$totalTime= ($tend - $tstart);
$totalTime= sprintf("%2.4f s", $totalTime);

echo "\nExecution time: {$totalTime}\n";

exit ();