<?php

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

defined('TYPO3') or die();

(static function() {
    ExtensionUtility::registerPlugin(
        'SzAssets',
        'Booking',
        'Booking'
    );
})();
