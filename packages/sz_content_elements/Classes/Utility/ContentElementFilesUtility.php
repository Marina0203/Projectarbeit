<?php

declare(strict_types=1);

namespace SUNZINET\SzContentElements\Utility;

use DirectoryIterator;
use Generator;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * @internal
 */
final class ContentElementFilesUtility
{
    public const EXT_KEY = 'sz_content_elements';
    public const FILE_FLEX_FORM = 'FlexForm.xml';
    public const FILE_PAGE_TS_CONFIG = 'Page.tsconfig';
    public const FILE_TYPO_SCRIPT_SETUP = 'Setup.typoscript';
    public const FILE_TCA = 'Tca.php';
    public const FILE_SQL = 'Database.sql';
    public const FILE_ICON = 'Icon.svg';

    public static function getContentElementNames(): Generator
    {
        foreach (self::getFolders() as $folder) {
            yield self::getNameFromPath($folder->getPathname(), true);
        }
    }

    public static function getNameFromPath(string $path, bool $isDir = false): string
    {
        return $isDir ? basename($path) : basename(dirname($path));
    }

    public static function getContents(string $filename, bool $isPublicResource = false): Generator
    {
        foreach (self::getPaths($filename, $isPublicResource) as $path) {
            yield (string) file_get_contents($path);
        }
    }

    public static function getRelPaths(string $filename, bool $isPublicResource = false): Generator
    {
        $absExtPath = GeneralUtility::getFileAbsFileName(sprintf('EXT:%s/', self::EXT_KEY));
        $strip = rtrim($absExtPath, DIRECTORY_SEPARATOR);

        foreach (self::getPaths($filename, $isPublicResource) as $path) {
            yield trim(str_replace($strip, '', $path), DIRECTORY_SEPARATOR);
        }
    }

    public static function getPaths(string $filename, bool $isPublicResource = false): Generator
    {
        foreach (self::getFiles($filename, $isPublicResource) as $file) {
            yield $file->getPathname();
        }
    }

    public static function getFiles(string $filename, bool $isPublicResource = false): Generator
    {
        $path = GeneralUtility::getFileAbsFileName(
            sprintf(
                'EXT:%s/Resources/%s/ContentElements/',
                self::EXT_KEY,
                $isPublicResource ? 'Public' : 'Private',
            )
        );

        /** @var DirectoryIterator $directory */
        foreach (new DirectoryIterator($path) as $directory) {
            if ($directory->isDir() && ! $directory->isDot() && $directory->isReadable()) {
                /** @var DirectoryIterator $file */
                foreach (new DirectoryIterator($directory->getPathname()) as $file) {
                    if ($file->getFilename() === $filename && $file->isReadable()) {
                        yield $file;
                    }
                }
            }
        }
    }

    public static function getFolders(bool $isPublicResource = false): Generator
    {
        $path = GeneralUtility::getFileAbsFileName(
            sprintf(
                'EXT:%s/Resources/%s/ContentElements/',
                self::EXT_KEY,
                $isPublicResource ? 'Public' : 'Private',
            )
        );

        /** @var DirectoryIterator $directory */
        foreach (new DirectoryIterator($path) as $directory) {
            if ($directory->isDir() && ! $directory->isDot() && $directory->isReadable()) {
                yield $directory;
            }
        }
    }

    private function __construct()
    {
    }
}
