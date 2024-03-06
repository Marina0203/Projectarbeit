<?php

require_once __DIR__ . '/additional.development.php';

// Mail
(static function (): void {
    $GLOBALS['TYPO3_CONF_VARS']['MAIL'] = array_replace_recursive(
        $GLOBALS['TYPO3_CONF_VARS']['MAIL'],
        [
            // This mail configuration sends all emails to mailpit
            'transport' => 'smtp',
            'transport_smtp_encrypt' => false,
            'transport_smtp_server' => 'localhost:1025',
        ]
    );
})();

// System
(static function (): void {
    $GLOBALS['TYPO3_CONF_VARS']['SYS'] = array_replace_recursive(
        $GLOBALS['TYPO3_CONF_VARS']['SYS'],
        [
            'createGroup' => '',
            'trustedHostsPattern' => '.*.*',
            'exceptionalErrors' => E_ALL,
            'caching' => [
                'cacheConfigurations' => [
                    'core' => [
                        'backend' => \TYPO3\CMS\Core\Cache\Backend\NullBackend::class,
                    ],
                    'pages' => [
                        'backend' => \TYPO3\CMS\Core\Cache\Backend\NullBackend::class,
                    ],
                    'pagesection' => [
                        'backend' => \TYPO3\CMS\Core\Cache\Backend\NullBackend::class,
                    ],
                    'rootline' => [
                        'backend' => \TYPO3\CMS\Core\Cache\Backend\NullBackend::class,
                    ],
                    'assets' => [
                        'backend' => \TYPO3\CMS\Core\Cache\Backend\NullBackend::class,
                    ],
                    'l10n' => [
                        'backend' => \TYPO3\CMS\Core\Cache\Backend\NullBackend::class,
                    ],
                    'hash' => [
                        'backend' => \TYPO3\CMS\Core\Cache\Backend\NullBackend::class,
                    ],
                    'fluid_template' => [
                        'backend' => \TYPO3\CMS\Core\Cache\Backend\NullBackend::class,
                    ],
                    'extbase' => [
                        'backend' => \TYPO3\CMS\Core\Cache\Backend\NullBackend::class,
                    ],
                ],
            ],
            'features' => [
                'redirects.hitCount' => false,
            ],
        ]
    );
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
                            'notice' => [
                                \TYPO3\CMS\Core\Log\Writer\FileWriter::class => [
                                    'disabled' => false,
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            'IchHabRecht' => [
                'Filefill' => [
                    'writerConfiguration' => [
                        \TYPO3\CMS\Core\Log\LogLevel::DEBUG => [
                            \TYPO3\CMS\Core\Log\Writer\FileWriter::class => [
                                'logFileInfix' => 'filefill',
                            ],
                        ],
                    ],
                ],
            ],
        ]
    );
})();
