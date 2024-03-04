<?php

declare(strict_types=1);

use SUNZINET\SzAssets\Controller\BookingController;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

defined('TYPO3') || exit;

// Add default user TsConfig
(static function (): void {
    ExtensionManagementUtility::addUserTSConfig(
        '@import "EXT:sz_assets/Configuration/user.tsconfig"'
    );
})();

(static function() {

    ExtensionUtility::configurePlugin(
        'SzAssets',
        'Booking',
        [
            BookingController::class => 'list, book',
        ],
        // non-cacheable actions
        [
            BookingController::class => 'list, book',
        ]
    );
})();
