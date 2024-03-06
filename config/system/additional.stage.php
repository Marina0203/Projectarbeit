<?php

require_once __DIR__ . '/additional.production.php';

// Backend
(static function (): void {
    $GLOBALS['TYPO3_CONF_VARS']['BE'] = array_replace_recursive(
        $GLOBALS['TYPO3_CONF_VARS']['BE'],
        [
            'debug' => true,
        ]
    );
})();

// Frontend
(static function (): void {
    $GLOBALS['TYPO3_CONF_VARS']['FE'] = array_replace_recursive(
        $GLOBALS['TYPO3_CONF_VARS']['FE'],
        [
            'debug' => true,
            'permalogin' => 2,
            'defaultTypoScript_setup' => 'config.contentObjectExceptionHandler = 0',
        ]
    );
})();

// System
(static function (): void {
    $GLOBALS['TYPO3_CONF_VARS']['SYS'] = array_replace_recursive(
        $GLOBALS['TYPO3_CONF_VARS']['SYS'],
        [
            'displayErrors' => -1,
            'devIPmask' => implode(',', ['127.0.0.1', '::1', '85.14.251.*']),
            'errorHandlerErrors' => E_ALL & ~(E_STRICT | E_NOTICE | E_COMPILE_WARNING | E_COMPILE_ERROR | E_CORE_WARNING | E_CORE_ERROR | E_PARSE | E_ERROR),
            'exceptionalErrors' => E_ALL & ~(E_STRICT | E_NOTICE | E_COMPILE_WARNING | E_COMPILE_ERROR | E_CORE_WARNING | E_CORE_ERROR | E_PARSE | E_ERROR | E_DEPRECATED | E_USER_DEPRECATED | E_WARNING | E_USER_ERROR | E_USER_NOTICE | E_USER_WARNING),
            'features' => [
                'redirects.hitCount' => false,
            ],
        ]
    );
})();
