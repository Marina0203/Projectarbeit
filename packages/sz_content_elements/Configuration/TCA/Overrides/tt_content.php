<?php

defined('TYPO3') || exit;

// Include content element TCA configuration files
(static function (): void {
    $paths = \SUNZINET\SzContentElements\Utility\ContentElementFilesUtility::getPaths(
        \SUNZINET\SzContentElements\Utility\ContentElementFilesUtility::FILE_TCA
    );
    foreach ($paths as $path) {
        include_once($path);
    }
})();

// Add content element FlexForm configuration files
(static function (): void {
    $paths = \SUNZINET\SzContentElements\Utility\ContentElementFilesUtility::getRelPaths(
        \SUNZINET\SzContentElements\Utility\ContentElementFilesUtility::FILE_FLEX_FORM
    );
    foreach ($paths as $path) {
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
            '*',
            sprintf(
                'FILE:EXT:%s/%s',
                \SUNZINET\SzContentElements\Utility\ContentElementFilesUtility::EXT_KEY,
                $path
            ),
            strtolower(\SUNZINET\SzContentElements\Utility\ContentElementFilesUtility::getNameFromPath($path))
        );
    }
})();
