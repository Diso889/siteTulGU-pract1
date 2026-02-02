<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

class InstallFinishStep extends CWizardStep
{
    function InitStep()
    {
        $this->SetTitle(GetMessage('MAIN_WIZARD_FINISH_TITLE'));
        $this->SetCancelCaption(GetMessage('MAIN_WIZARD_FINISH_CAPTION'));

        $this->SetCancelStep(BX_WIZARD_FINISH_ID);
    }

    function ShowStep()
    {
        file_put_contents(
            $_SERVER['DOCUMENT_ROOT'] . (SITE_DIR ?: '/') . 'index.php',
            GetMessage('ILIMURZIN_INSTALL_INDEX_CONTENT')
        );

        $this->content = GetMessage('MAIN_WIZARD_FINISH_DESC');
    }
}
