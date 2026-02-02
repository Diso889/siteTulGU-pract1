<?php

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;

class ilimurzin_install extends CModule
{
    public $MODULE_ID = 'ilimurzin.install';

    public function __construct()
    {
        Loc::loadMessages(__FILE__);

        $arModuleVersion = null;

        include __DIR__ . '/version.php';

        if (isset($arModuleVersion) && is_array($arModuleVersion)) {
            $this->MODULE_VERSION = $arModuleVersion['VERSION'];
            $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
        }

        $this->MODULE_NAME = Loc::getMessage('ILIMURZIN_INSTALL_MODULE_NAME');
        $this->MODULE_DESCRIPTION = Loc::getMessage('ILIMURZIN_INSTALL_MODULE_DESCRIPTION');
        $this->PARTNER_NAME = Loc::getMessage('ILIMURZIN_INSTALL_PARTNER_NAME');
        $this->PARTNER_URI = Loc::getMessage('ILIMURZIN_INSTALL_PARTNER_URI');
    }

    public function DoInstall(): void
    {
        $this->InstallDB();
        $this->InstallFiles();
    }

    public function DoUninstall(): void
    {
        $this->UnInstallDB();
        $this->UnInstallFiles();
    }

    public function InstallDB(): bool
    {
        ModuleManager::registerModule($this->MODULE_ID);

        return true;
    }

    public function UnInstallDB(): bool
    {
        ModuleManager::unRegisterModule($this->MODULE_ID);

        return true;
    }

    public function InstallFiles(): bool
    {
        CopyDirFiles(__DIR__ . '/wizards/ilimurzin/install', $_SERVER['DOCUMENT_ROOT'] . '/bitrix/wizards/ilimurzin/install', true, true);

        return true;
    }

    public function UnInstallFiles(): bool
    {
        DeleteDirFilesEx('bitrix/wizards/ilimurzin/install');

        return true;
    }
}
