<?php
return [
    'ctrl' => [
        'sortby' => 'sorting',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'editlock' => 'editlock',
        'versioningWS' => true,
        'origUid' => 't3_origuid',
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'translationSource' => 'l10n_source',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
            'fe_group' => 'fe_group',
        ],
        'title' => 'LLL:EXT:sz_assets/Resources/Private/Language/locallang_db.xlf:tx_szassets_domain_model_booking',
        'label' => 'start_date',
        'iconfile' => 'EXT:sz_assets/Resources/Public/Icons/Extension.svg',
        'hideTable' => false,
    ],

    'palettes' => [
        'language' => [
            'showitem' => '
                        sys_language_uid;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:sys_language_uid_formlabel,l18n_parent
                    ',
        ],
        'hidden' => [
            'showitem' => '
                        hidden;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:field.default.hidden
                    ',
        ],
        'access' => [
            'label' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access',
            'showitem' => '
                        starttime;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:starttime_formlabel,
                        endtime;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:endtime_formlabel,
                        --linebreak--,
                        fe_group;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:fe_group_formlabel,
                        --linebreak--,editlock
                    ',
        ],
    ],
    'columns' => [
        'editlock' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_tca.xlf:editlock',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'items' => [
                    [
                        '',
                        '',
                    ],
                ],
            ],
        ],
        'sys_language_uid' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language',
            'config' => [
                'type' => 'language',
            ],
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [
                        '',
                        0,
                    ],
                ],
                'default' => 0,
                'foreign_table' => 'tx_szassets_domain_model_booking',
                'foreign_table_where' => 'AND tx_szassets_domain_model_booking.pid=###CURRENT_PID### AND tx_szassets_domain_model_booking.sys_language_uid IN (-1, 0)',
            ],
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'hidden' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.visible',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'items' => [
                    [
                        0 => '',
                        1 => '',
                        'invertStateDisplay' => true,
                    ],
                ],
            ],
        ],
        'starttime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.starttime',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'eval' => 'datetime,int',
                'default' => 0,
            ],
            'l10n_mode' => 'exclude',
            'l10n_display' => 'defaultAsReadonly',
        ],
        'endtime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.endtime',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'eval' => 'datetime,int',
                'default' => 0,
                'range' => [
                    'upper' => 2145913200,
                ],
            ],
            'l10n_mode' => 'exclude',
            'l10n_display' => 'defaultAsReadonly',
        ],
        'fe_group' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.fe_group',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'size' => 5,
                'maxitems' => 20,
                'items' => [
                    [
                        'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.hide_at_login',
                        -1,
                    ],
                    [
                        'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.any_login',
                        -2,
                    ],
                    [
                        'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.usergroups',
                        '--div--',
                    ],
                ],
                'exclusiveKeys' => '-1,-2',
                'foreign_table' => 'fe_groups',
            ],
        ],
        'sorting' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'room' => [
            'exclude' => true,
            'label' => 'LLL:EXT:sz_assets/Resources/Private/Language/locallang_db.xlf:custom_table.room',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_szassets_domain_model_room',
                'minitems' => 0,
                'maxitems' => 1,
            ],
        ],
        'user_first_name' => [
            'exclude' => true,
            'label' => 'LLL:EXT:sz_assets/Resources/Private/Language/locallang_db.xlf:custom_table.first_name',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            ],
        ],
        'user_last_name' => [
            'exclude' => true,
            'label' => 'LLL:EXT:sz_assets/Resources/Private/Language/locallang_db.xlf:custom_table.last_name',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            ],
        ],
        'user_email' => [
            'exclude' => true,
            'label' => 'LLL:EXT:sz_assets/Resources/Private/Language/locallang_db.xlf:custom_table.email',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            ],
        ],
        'start_date' => [
            'exclude' => true,
            'label' => 'LLL:EXT:sz_assets/Resources/Private/Language/locallang_db.xlf:custom_table.start_date',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'eval' => 'datetime,int',
                'default' => 0,
            ],
        ],
        't3_origuid' => [
            'config' => [
                'type' => 'passthrough',
                'default' => 0,
            ],
        ],
        'l10n_source' => [
            'config' => [
                'type' => 'passthrough',
                'default' => 0,
            ],
        ],
    ],
    'types' => [
        1 => [
            'showitem' => '--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
             room, user_first_name, user_last_name, user_email, start_date, end_date,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,--palette--;;language,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,--palette--;;hidden,--palette--;;access',
        ],
    ],
];

