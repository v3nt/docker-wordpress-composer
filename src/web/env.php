<?php
/**
 * Your base production configuration goes in this file. Environment-specific
 * overrides go in their respective config/environments/{{WP_ENV}}.php file.
 *
 * A good default policy is to deviate from the production config as little as
 * possible. Try to define as much of your configuration in this file as you
 * can.
 */

 

/** @var string Directory containing all of the site's files */
$root_dir = dirname(__DIR__);

echo $root_dir;

/** @var string Document Root */
$webroot_dir = $root_dir . '/web';

 
$dotenv = file_get_contents($root_dir . '/.env');

echo($dotenv);