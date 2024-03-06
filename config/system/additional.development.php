<?php

require_once __DIR__ . '/additional.stage.php';

// Extensions
(static function (): void {
    $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['filefill']['storages'] = [
        1 => [
            ['identifier' => 'domain', 'configuration' => 'https://www.example.com'],
            ['identifier' => 'placeholder'],
        ],
    ];
})();

// Logging
(static function (): void {
    $GLOBALS['TYPO3_CONF_VARS']['LOG'] = array_replace_recursive(
        $GLOBALS['TYPO3_CONF_VARS']['LOG'],
        [
            'TYPO3' => [
                'CMS' => [
                    'deprecations' => [
                        'writerConfiguration' => [
                            \TYPO3\CMS\Core\Log\LogLevel::NOTICE => [
                                \TYPO3\CMS\Core\Log\Writer\FileWriter::class => [
                                    'disabled' => false,
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ]
    );
})();

// Backend
(static function (): void {
    $GLOBALS['TYPO3_CONF_VARS']['BE'] = array_replace_recursive(
        $GLOBALS['TYPO3_CONF_VARS']['BE'],
        [
            'compressionLevel' => 0,
        ]
    );
})();

// Frontend
(static function (): void {
    $GLOBALS['TYPO3_CONF_VARS']['FE'] = array_replace_recursive(
        $GLOBALS['TYPO3_CONF_VARS']['FE'],
        [
            'compressionLevel' => 0,
            'pageNotFoundOnCHashError' => true,
        ]
    );
})();

// System
(static function (): void {
    $GLOBALS['TYPO3_CONF_VARS']['SYS'] = array_replace_recursive(
        $GLOBALS['TYPO3_CONF_VARS']['SYS'],
        [
            'devIPmask' => '*',
            'displayErrors' => 1,
            'errorHandlerErrors' => E_ALL & ~(E_NOTICE | E_WARNING),
            'exceptionalErrors' => E_ALL & ~(E_NOTICE | E_WARNING | E_USER_WARNING | E_USER_ERROR | E_USER_NOTICE),
            'debugExceptionHandler' => \TYPO3\CMS\Core\Error\DebugExceptionHandler::class,
            'productionExceptionHandler' => \TYPO3\CMS\Core\Error\DebugExceptionHandler::class,
            'features' => [
                'redirects.hitCount' => false,
            ],
        ]
    );
})();
