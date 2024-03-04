<?php

declare(strict_types=1);

use SUNZINET\SzContentElements\Utility\ContentElementFilesUtility;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3') || exit;

// Add content element TypoScript files
(static function (): void {
    $contents = ContentElementFilesUtility::getContents(
        ContentElementFilesUtility::FILE_TYPO_SCRIPT_SETUP
    );
    foreach ($contents as $content) {
        ExtensionManagementUtility::addTypoScript(
            ContentElementFilesUtility::EXT_KEY,
            'setup',
            $content,
            'defaultContentRendering'
        );
    }
})();

// Add content element PageTS configuration files
(static function (): void {
    $paths = ContentElementFilesUtility::getRelPaths(
        ContentElementFilesUtility::FILE_PAGE_TS_CONFIG
    );
    foreach ($paths as $path) {
        ExtensionManagementUtility::addPageTSConfig(
            sprintf(
                '@import "EXT:%s/%s"',
                ContentElementFilesUtility::EXT_KEY,
                $path
            ),
        );
    }
})();
