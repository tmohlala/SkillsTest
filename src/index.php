<?php
/**
 * @author      Rijnhard Hessel
 * @copyright   Copyright (c) 2018 Teleforge Pty Ltd
 */

/**
 * usually this acts as the public entrypoint for the application
 * that is so that users/attackers dont have direct access to the actual other php files in src
 *
 * when using frameworks this is usually where the either the framework is initialized (like the symfony kernel)
 * or where the router is engaged.
 *
 * Essentially this file acts as a proxy to the actual source code.
 * the web directory allows user access, the src directory does not.
 *
 * In the interest of simplification, apache has been configured with the whole source directory executable.
 */

echo "its working";

var_dump(['xdebug' => 'yes']);