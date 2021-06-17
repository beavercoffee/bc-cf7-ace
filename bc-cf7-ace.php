<?php
/*
Author: Beaver Coffee
Author URI: https://beaver.coffee
Description: Log In (and Sign Up) with Contact Form 7.
Domain Path:
License: GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Network: true
Plugin Name: BC CF7 Login
Plugin URI: https://github.com/beavercoffee/bc-cf7-ace
Requires at least: 5.7
Requires PHP: 5.6
Text Domain: bc-cf7-ace
Version: 1.6.15
*/

if(defined('ABSPATH')){
    require_once(plugin_dir_path(__FILE__) . 'classes/class-bc-cf7-ace.php');
    BC_CF7_ACE::get_instance(__FILE__);
}