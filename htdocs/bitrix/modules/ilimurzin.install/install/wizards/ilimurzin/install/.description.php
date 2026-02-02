<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

$arWizardDescription = [
    'NAME' => GetMessage('ILIMURZIN_INSTALL_WIZARD_NAME'),
    'DESCRIPTION' => GetMessage('ILIMURZIN_INSTALL_WIZARD_DESCRIPTION'),
    'VERSION' => '1.0.0',
    'WIZARD_TYPE' => 'INSTALL',
    'STEPS_SETTINGS' => [
        'START_INSTALL' => [
            'CONTENT' => GetMessage('ILIMURZIN_INSTALL_START_INSTALL_CONTENT'),
        ],
        'FINISH' => [
            'CLASS' => 'InstallFinishStep',
            'SCRIPT' => '/scripts/steps.php',
        ],
    ],
];
