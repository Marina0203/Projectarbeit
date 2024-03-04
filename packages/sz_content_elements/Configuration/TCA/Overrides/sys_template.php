<?php

defined('TYPO3') || exit;

// Add static TypoScript
(static function (): void {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
        \SUNZINET\SzContentElements\Utility\ContentElementFilesUtility::EXT_KEY,
        'Configuration/TypoScript/',
        'SUNZINET Content Elements'
    );
})();
