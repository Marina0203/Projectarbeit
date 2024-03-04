<?php

declare(strict_types=1);

namespace SUNZINET\SzContentElements\Listener\Core;

use SUNZINET\SzContentElements\Utility\ContentElementFilesUtility;
use TYPO3\CMS\Core\Database\Event\AlterTableDefinitionStatementsEvent;

final class RegisterContentElementSqlDefinitions
{
    public function __invoke(AlterTableDefinitionStatementsEvent $event): void
    {
        $contents = ContentElementFilesUtility::getContents(ContentElementFilesUtility::FILE_SQL);
        foreach ($contents as $content) {
            $event->addSqlData($content);
        }
    }
}
