<?php

defined('TYPO3') || exit;

// Add static TypoScript
(static function (): void {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
        'sz_assets',
        'Configuration/TypoScript',
        'SUNZINET Assets - Default'
    );
})();
