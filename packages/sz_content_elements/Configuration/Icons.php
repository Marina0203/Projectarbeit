<?php

declare(strict_types=1);

use SUNZINET\SzContentElements\Utility\ContentElementFilesUtility;
use TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider;
use TYPO3\CMS\Core\Utility\GeneralUtility;

defined('TYPO3') || exit;

// Register content element icons
return (static function (): array {
    $icons = [];
    foreach (ContentElementFilesUtility::getContentElementNames() as $name) {
        // Use default icon as fallback for missing content element icons
        $relIconPath = sprintf(
            'EXT:%s/Resources/Public/ContentElements/%s/%s',
            ContentElementFilesUtility::EXT_KEY,
            $name,
            ContentElementFilesUtility::FILE_ICON
        );
        if (! file_exists(GeneralUtility::getFileAbsFileName($relIconPath))) {
            $relIconPath = sprintf(
                'EXT:%s/Resources/Public/Icons/Default.svg',
                ContentElementFilesUtility::EXT_KEY
            );
        }

        $icons[strtolower($name . '-icon')] = [
            'provider' => SvgIconProvider::class,
            'source' => $relIconPath,
        ];
    }
    return $icons;
})();
