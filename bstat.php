<?php
/*
Plugin Name: bStat
Plugin URI: http://maisonbisson.com/
Description: Blog stats and activity stream
Version: 6.0 alpha development
Author: Casey Bisson
Author URI: http://maisonbisson.com/blog/
*/

require_once __DIR__ . '/components/class-bstat.php';
bstat();

register_activation_hook( __FILE__, array( bstat(), 'initial_setup' ) );


// comment tracking is kept separate as an example of how to build other integrations
require_once __DIR__ . '/components/class-bstat-comments.php';
bstat_comments();
