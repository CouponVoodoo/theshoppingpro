<?php
/**
 * ClickTale - PHP Integration Module
 *
 * LICENSE
 *
 * This source file is subject to the ClickTale(R) Integration Module License that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.clicktale.com/Integration/0.2/LICENSE.txt
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@clicktale.com so we can send you a copy immediately.
 *
 */
?>
<?php
// $Id: sys_get_temp_dir.php,v 1.1 2008/11/24 04:18:49 aidan Exp $


/**
 * Replace sys_get_temp_dir()
 *
 * @category    PHP
 * @package     PHP_Compat
 * @license     LGPL - http://www.gnu.org/licenses/lgpl.html
 * @copyright   2004-2007 Aidan Lister <aidan@php.net>, Arpad Ray <arpad@php.net>
 * @link        http://php.net/function.sys_get_temp_dir
 * @author      James Wade <php@hm2k.org>
 * @version     $Revision: 1.1 $
 * @since       PHP 5
 * @require     PHP 4.0.0 (realpath)
 */
function php_compat_sys_get_temp_dir()
{
	if (!empty($_ENV['TMP'])) {
		return realpath($_ENV['TMP']);
	}
	
	if (!empty($_ENV['TMPDIR'])) {
		return realpath( $_ENV['TMPDIR']);
	}
	
	if (!empty($_ENV['TEMP'])) {
		return realpath( $_ENV['TEMP']);
	}
	
	$tempfile = tempnam(uniqid(rand(),TRUE),'');
	if (file_exists($tempfile)) {
		unlink($tempfile);
		return realpath(dirname($tempfile));
	}
}

// Define
if (!function_exists('sys_get_temp_dir')) {
    function sys_get_temp_dir()
    {
        return php_compat_sys_get_temp_dir();
    }
}
