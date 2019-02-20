<?php
// Constants.
define('REQUIRED_PHP_VERSION', '7.0.0');
define('APPLICATION_NAMESPACE', 'SlsrAdm');

// Error reporting.
error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);

// Check PHP version.
if (version_compare(PHP_VERSION, REQUIRED_PHP_VERSION) < 0) {
    die('Require PHP '.REQUIRED_PHP_VERSION.' or above.');
}

// Class autoloading.
set_include_path(get_include_path().PATH_SEPARATOR.__DIR__);
foreach (scandir(__DIR__) as $entry) {
    if (($entry != '.') && ($entry != '..')) {
        $entry = __DIR__.DIRECTORY_SEPARATOR.$entry;
        if (is_dir($entry)) {
            set_include_path(get_include_path().PATH_SEPARATOR.$entry);
        }
    }
}
spl_autoload_register(function (string $className) {
    spl_autoload(str_replace(APPLICATION_NAMESPACE.'\\', '', $className));
}, true, false);
