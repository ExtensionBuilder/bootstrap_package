<?php

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

return [
    'ctrl' => [
        'label' => 'header',
        'sortby' => 'sorting',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'title' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:card_group_item',
        'delete' => 'deleted',
        'versioningWS' => true,
        'origUid' => 't3_origuid',
        'hideTable' => true,
        'hideAtCopy' => true,
        'prependAtCopy' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.prependAtCopy',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'languageField' => 'sys_language_uid',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'security' => [
            'ignorePageTypeRestriction' => true,
        ],
        'typeicon_classes' => [
            'default' => 'content-bootstrappackage-card-group-item',
        ],
    ],
    'types' => [
        '1' => [
            'showitem' => '
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
                --palette--;LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:card_group_item.header;header,
                image,
                bodytext,
                --palette--;LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:card_group_item.link;link,
                icon_file,
                --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.visibility;visibility,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
                --palette--;;hiddenLanguagePalette,
            ',
        ],
    ],
    'palettes' => [
        '1' => [
            'showitem' => '',
        ],
        'access' => [
            'showitem' => '
                starttime;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:starttime_formlabel,
                endtime;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:endtime_formlabel
            ',
        ],
        'header' => [
            'showitem' => '
                header,
                --linebreak--,
                subheader,
            ',
        ],
        'link' => [
            'showitem' => '
                link,
                link_title,
                --linebreak--,
                link_class,
                --linebreak--,
                link_icon_set,
                --linebreak--,
                link_icon_identifier,
                link_icon,
            ',
        ],
        'general' => [
            'showitem' => '
                tt_content
            ',
        ],
        'visibility' => [
            'showitem' => '
                hidden;LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:card_group_item
            ',
        ],
        // hidden but needs to be included all the time, so sys_language_uid is set correctly
        'hiddenLanguagePalette' => [
            'showitem' => 'sys_language_uid, l10n_parent',
            'isHiddenPalette' => true,
        ],
    ],
    'columns' => [
        'tt_content' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:card_group_item.tt_content',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tt_content',
                'foreign_table_where' => 'AND tt_content.pid=###CURRENT_PID### AND tt_content.{#CType}=\'card_group\'',
                'maxitems' => 1,
                'default' => 0,
            ],
        ],
        'hidden' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.hidden',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
            ],
        ],
        'starttime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.starttime',
            'config' => [
                'type' => 'datetime',
                'default' => 0,
            ],
            'l10n_mode' => 'exclude',
            'l10n_display' => 'defaultAsReadonly',
        ],
        'endtime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.endtime',
            'config' => [
                'type' => 'datetime',
                'default' => 0,
                'range' => [
                    'upper' => mktime(0, 0, 0, 1, 1, 2038),
                ],
            ],
            'l10n_mode' => 'exclude',
            'l10n_display' => 'defaultAsReadonly',
        ],
        'sys_language_uid' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language',
            'config' => ['type' => 'language'],
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [
                        'label' => '',
                        'value' => 0,
                    ],
                ],
                'foreign_table' => 'tx_bootstrappackage_card_group_item',
                'foreign_table_where' => 'AND tx_bootstrappackage_card_group_item.pid=###CURRENT_PID### AND tx_bootstrappackage_card_group_item.sys_language_uid IN (-1,0)',
                'default' => 0,
            ],
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'header' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:card_group_item.header',
            'config' => [
                'type' => 'input',
                'size' => 50,
                'eval' => 'trim',
                'required' => true,
            ],
        ],
        'subheader' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:card_group_item.subheader',
            'config' => [
                'type' => 'input',
                'size' => 50,
                'eval' => 'trim',
            ],
        ],
        'image' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:card_group_item.image',
            'config' => [
                'type' => 'file',
                'allowed' => 'common-image-types',
                'minitems' => 0,
                'maxitems' => 1,
                'overrideChildTca' => [
                    'types' => [
                        \TYPO3\CMS\Core\Resource\FileType::IMAGE->value => [
                            'showitem' => '
                                --palette--;;imageoverlayPalette,
                                --palette--;;filePalette',
                        ],
                    ],
                ],
            ],
        ],
        'bodytext' => [
            'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:card_group_item.bodytext',
            'exclude' => true,
            'config' => [
                'type' => 'text',
                'cols' => '80',
                'rows' => '15',
                'softref' => 'typolink_tag,email[subst],url',
                'enableRichtext' => true,
            ],
        ],
        'link' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:card_group_item.link',
            'config' => [
                'type' => 'link',
                'size' => 50,
                'appearance' => ['browserTitle' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:card_group_item.link'],
            ],
        ],
        'link_title' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:card_group_item.link_title',
            'config' => [
                'type' => 'input',
                'size' => 50,
                'eval' => 'trim',
            ],
        ],
        'link_icon_set' => [
            'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:card_group_item.link_icon_set',
            'onChange' => 'reload',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'itemsProcFunc' => 'BK2K\BootstrapPackage\Service\IconService->getIconSetItems',
            ],
            'l10n_mode' => 'exclude',
        ],
        'link_icon_identifier' => [
            'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:card_group_item.link_icon_identifier',
            'displayCond' => 'FIELD:link_icon_set:REQ:true',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'itemsProcFunc' => 'BK2K\BootstrapPackage\Service\IconService->getIconItems',
                'itemsProcConfig' => [
                    'iconSetField' => 'link_icon_set',
                ],
                'fieldWizard' => [
                    'selectIcons' => [
                        'renderType' => 'iconWizard',
                        'disabled' => false,
                    ],
                ],
            ],
            'l10n_mode' => 'exclude',
        ],
        'link_icon' => [
            'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:card_group_item.link_icon',
            'displayCond' => 'FIELD:link_icon_set:REQ:false',
            'config' => [
                'type' => 'file',
                'allowed' => ['gif', 'png', 'svg'],
                'appearance' => [
                    'createNewRelationLinkTitle' => 'LLL:EXT:frontend/Resources/Private/Language/Database.xlf:tt_content.asset_references.addFileReference',
                ],
                'overrideChildTca' => [
                    'types' => [
                        \TYPO3\CMS\Core\Resource\FileType::IMAGE->value => [
                            'showitem' => '--palette--;;filePalette',
                        ],
                    ],
                ],
                'minitems' => 0,
                'maxitems' => 1,
            ],
            'l10n_mode' => 'exclude',
        ],
        'link_class' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:card_group_item.link_class',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['label' => 'default', 'value' => 'default'],
                    ['label' => 'primary', 'value' => 'primary'],
                    ['label' => 'secondary', 'value' => 'secondary'],
                    ['label' => 'tertiary', 'value' => 'tertiary'],
                    ['label' => 'quaternary', 'value' => 'quaternary'],
                    ['label' => 'success', 'value' => 'success'],
                    ['label' => 'info', 'value' => 'info'],
                    ['label' => 'warning', 'value' => 'warning'],
                    ['label' => 'danger', 'value' => 'danger'],
                    ['label' => 'outline-default', 'value' => 'outline-default'],
                    ['label' => 'outline-primary', 'value' => 'outline-primary'],
                    ['label' => 'outline-secondary', 'value' => 'outline-secondary'],
                    ['label' => 'outline-tertiary', 'value' => 'outline-tertiary'],
                    ['label' => 'outline-quaternary', 'value' => 'outline-quaternary'],
                    ['label' => 'outline-success', 'value' => 'outline-success'],
                    ['label' => 'outline-info', 'value' => 'outline-info'],
                    ['label' => 'outline-warning', 'value' => 'outline-warning'],
                    ['label' => 'outline-danger', 'value' => 'outline-danger'],
                ],
            ],
        ],
    ],
];
