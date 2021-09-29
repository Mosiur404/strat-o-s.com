<?php

/**
 * 
 * Plugin Name: Stratos Core
 * Plugin URI: https://strat-o-s.com
 * Description: A simple plugin for building awesome stuffs
 * Version:     0.0.1
 * Author:      Mosiur
 * Author URI:  Mosiur.io
 * Text Domain: stratos
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 *
 */

// Block direct access to file
defined('ABSPATH') or die('Not Authorized!');

// Plugin Defines
define("SC_FILE", __FILE__);
define("SC_DIRECTORY", dirname(__FILE__));
define("SC_TEXT_DOMAIN", dirname(__FILE__));
define("SC_DIRECTORY_BASENAME", plugin_basename(SC_FILE));
define("SC_DIRECTORY_PATH", plugin_dir_path(SC_FILE));
define("SC_DIRECTORY_URL", plugins_url(null, SC_FILE));

// Require the main class file
include_once(SC_DIRECTORY . '/include/init.php');

//require widgets
add_action('init', 'sc_require_files');
function sc_require_files()
{
    require_once(SC_DIRECTORY . '/include/widgets/slider_2.php');
    require_once(SC_DIRECTORY . '/include/widgets/slider_1.php');
}
