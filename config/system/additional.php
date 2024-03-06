<?php

/*
 * Include context related configuration file
 *
 * The configuration files "additional.*.php" inherit the config from the next
 * higher instance file which means e.g. if you want to set a configuration for
 * all instances (dev, stage, prod) you only set it in "additional.production.php".
 * That also means if you're on stage, the config for dev and dev/local are not
 * loaded.
 *
 * "additional.development.local.php" inherits from "additional.development.php"
 * "additional.development.php"       inherits from "additional.stage.php"
 * "additional.stage.php"             inherits from "additional.production.php"
 */
(static function (): void {
    $context = (string) \TYPO3\CMS\Core\Core\Environment::getContext();
    $path = \TYPO3\CMS\Core\Core\Environment::getConfigPath() . '/system';
    $file = sprintf('%s/additional.%s.php', $path, strtolower(str_replace('/', '.', $context)));
    if (file_exists($file)) {
        require_once $file;
    }
})();
