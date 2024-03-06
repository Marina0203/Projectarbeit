<?php

// Database
(static function (): void {
    $GLOBALS['TYPO3_CONF_VARS']['DB'] = array_replace_recursive(
        $GLOBALS['TYPO3_CONF_VARS']['DB'],
        [
            'Connections' => [
                'Default' => [
                    'host' => getenv('TYPO3_DB_HOST'),
                    'user' => getenv('TYPO3_DB_USERNAME'),
                    'password' => getenv('TYPO3_DB_PASSWORD'),
                    'dbname' => getenv('TYPO3_DB_NAME'),
                    'charset' => getenv('TYPO3_DB_CHARSET'),
                    'driver' => getenv('TYPO3_DB_DRIVER'),
                    'port' => getenv('TYPO3_DB_PORT'),
                    'socket' => getenv('TYPO3_DB_SOCKET'),
                    'tableoptions' => [
                        'charset' => getenv('TYPO3_DB_CHARSET'),
                        'collate' => getenv('TYPO3_DB_COLLATE'),
                    ],
                ],
            ],
        ]
    );
})();

// Extensions
(static function (): void {
    $GLOBALS['TYPO3_CONF_VARS']['EXTENSIONS'] = array_replace_recursive(
        $GLOBALS['TYPO3_CONF_VARS']['EXTENSIONS'],
        [
            'backend' => [
                'backendFavicon' => 'favicon.ico',
                'backendLogo' => '',
                'loginBackgroundImage' => '',
                'loginFootnote' => 'Created by SUNZINET GmbH - www.sunzinet.com',
                'loginHighlightColor' => '#43677b',
                'loginLogo' => '',
                'loginLogoAlt' => '',
            ],
            'extensionmanager' => [
                'automaticInstallation' => '1',
                'offlineMode' => '0',
            ],
            'scheduler' => [
                'maxLifetime' => '4',
                'showSampleTasks' => '0',
            ],
        ],
    );
})();

// Backend
(static function (): void {
    $GLOBALS['TYPO3_CONF_VARS']['BE'] = array_replace_recursive(
        $GLOBALS['TYPO3_CONF_VARS']['BE'],
        [
            'languageDebug' => false,
            'passwordReset' => true,
            'passwordResetForAdmins' => false,
            'sessionTimeout' => 28_800,
            'lockSSL' => true,
            'showRefreshLoginPopup' => false,
            'adminOnly' => (bool) getenv('TYPO3_BE_ADMIN_ONLY'),
            'disable_exec_function' => true,
            'compressionLevel' => 9,
            'installToolPassword' => getenv('TYPO3_BE_INSTALL_TOOL_PASSWORD'),
            'explicitADmode' => 'explicitAllow',
            'debug' => false,
            'loginFootnote' => 'Created by SUNZINET GmbH - www.sunzinet.com',
            'loginHighlightColor' => '#43677b',
            'passwordHashing' => [
                'className' => 'TYPO3\\CMS\\Core\\Crypto\\PasswordHashing\\Argon2iPasswordHash',
                'options' => [],
            ],
        ]
    );
})();

// Frontend
(static function (): void {
    $GLOBALS['TYPO3_CONF_VARS']['FE'] = array_replace_recursive(
        $GLOBALS['TYPO3_CONF_VARS']['FE'],
        [
            'disableNoCacheParameter' => true,
            'additionalCanonicalizedUrlParameters' => [
                'q',
            ],
            'debug' => false,
            'compressionLevel' => 9,
            'pageNotFoundOnCHashError' => false,
            'pageUnavailable_force' => false, // Maintenance = true (see [SYS][devIPmask])
            'addRootLineFields' => 'subtitle',
            'checkFeUserPid' => true,
            'lifetime' => 86_400,
            'sessionTimeout' => 86_400,
            'sessionDataLifetime' => 86_400,
            'defaultUserTSconfig' => '',
            'defaultTypoScript_setup' => 'config.contentObjectExceptionHandler = 1',
            'additionalAbsRefPrefixDirectories' => 'assets',
            'cacheHash' => [
                'enforceValidation' => true,
                'excludedParameters' => array_replace_recursive(
                    $GLOBALS['TYPO3_CONF_VARS']['FE']['cacheHash']['excludedParameters'],
                    [
                        's',
                        't',
                        'q',
                    ],
                ),
            ],
            'passwordHashing' => [
                'className' => 'TYPO3\\CMS\\Core\\Crypto\\PasswordHashing\\Argon2iPasswordHash',
                'options' => [],
            ],
        ]
    );
})();

// Image processing
(static function (): void {
    $GLOBALS['TYPO3_CONF_VARS']['GFX'] = array_replace_recursive(
        $GLOBALS['TYPO3_CONF_VARS']['GFX'],
        [
            'gdlib' => true,
            'gdlib_png' => false,
            'gif_compress' => true,
            'imagefile_ext' => $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'] . ',webp',
            'jpg_quality' => 80,
            'processor' => 'ImageMagick',
            'processor_allowFrameSelection' => true,
            'processor_allowTemporaryMasksAsPng' => false,
            'processor_allowUpscaling' => true,
            'processor_colorspace' => 'sRGB',
            'processor_effects' => true,
            'processor_enabled' => true,
            'processor_interlace' => 'None',
            'processor_path' => '/usr/bin/',
            'processor_path_lzw' => '/usr/bin/',
            'processor_stripColorProfileByDefault' => true,
            'processor_stripColorProfileCommand' => '+profile \'*\'',
            'thumbnails' => true,
            'thumbnails_png' => true,
        ]
    );
})();

// Mail
(static function (): void {
    $GLOBALS['TYPO3_CONF_VARS']['MAIL'] = array_replace_recursive(
        $GLOBALS['TYPO3_CONF_VARS']['MAIL'],
        [
            'transport' => 'sendmail',
            'transport_sendmail_command' => '/usr/sbin/sendmail -t',
            'transport_smtp_encrypt' => '',
            'transport_smtp_password' => '',
            'transport_smtp_server' => '',
            'transport_smtp_username' => '',
            'defaultMailFromAddress' => 'vendor@example.com',
            'defaultMailFromName' => 'SUNZINET',
        ]
    );
})();

// ExtConf
// (static function (): void {
//     $GLOBALS['TYPO3_CONF_VARS']['EXTCONF'] = array_replace_recursive(
//         $GLOBALS['TYPO3_CONF_VARS']['EXTCONF'],
//         [
//             'lang' => [
//                 'availableLanguages' => [
//                     'de',
//                 ],
//             ],
//         ]
//     );
// })();

// System
(static function (): void {
    $GLOBALS['TYPO3_CONF_VARS']['SYS'] = array_replace_recursive(
        $GLOBALS['TYPO3_CONF_VARS']['SYS'],
        [
            'UTF8filesystem' => true,
            'fileCreateMask' => '0644', // 0664
            'folderCreateMask' => '0755', // 0775
            'features' => [
                'unifiedPageTranslationHandling' => true,
                'redirects.hitCount' => true,
            ],
            'sitename' => getenv('TYPO3_SYS_SITENAME'),
            'encryptionKey' => getenv('TYPO3_SYS_ENCRYPTION_KEY'),
            'devIPmask' => '',
            'ddmmyy' => 'd.m.y',
            'hhmm' => 'H:i',
            'USdateFormat' => false,
            'loginCopyrightWarrantyProvider' => 'SUNZINET GmbH',
            'loginCopyrightWarrantyURL' => 'https://www.sunzinet.com',
            'phpTimeZone' => 'Europe/Berlin',
            'systemLocale' => 'de_DE.UTF-8',
            'systemMaintainers' => [
                1, // SUNZINET
            ],
            'displayErrors' => 0,
            'errorHandlerErrors' => E_ALL & ~(E_STRICT | E_NOTICE | E_WARNING | E_COMPILE_WARNING | E_COMPILE_ERROR | E_CORE_WARNING | E_CORE_ERROR | E_PARSE | E_ERROR),
            'exceptionalErrors' => E_RECOVERABLE_ERROR | E_USER_DEPRECATED,
            'belogErrorReporting' => E_ALL & ~(E_STRICT | E_NOTICE | E_WARNING),
            'ipAnonymization' => 2,
        ]
    );
})();
