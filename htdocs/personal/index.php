<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Личный кабинет");
global $USER;

echo '<div class="container">';

if (!$USER->IsAuthorized()) {
    echo '<h1>Вход</h1>';
    $APPLICATION->IncludeComponent("bitrix:system.auth.form", ".default", [
        "REGISTER_URL" => "/personal/register.php",
        "PROFILE_URL" => "/personal/profile.php",
        "FORGOT_PASSWORD_URL" => "/personal/forgot.php",
        "SHOW_ERRORS" => "Y"
    ]);
    echo '</div>';
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
    return;
}

echo '<h1>Личный кабинет</h1>';

// профиль
echo '<p><a class="btn btn--ghost" href="/personal/profile.php">Профиль</a></p>';

// менеджер
$userGroups = $USER->GetUserGroupArray();
$isManager = in_array(5, $userGroups);

// кнопки заявок
if ($isManager) {
    echo '<p><a class="btn btn--ghost" href="/manager/">Все заявки клиентов</a></p>';
    echo '<p><a class="btn btn--ghost" href="/personal/my-calculations.php">Мои заявки</a></p>';
} else {
    echo '<p><a class="btn btn--ghost" href="/personal/my-calculations.php">Мои заявки на расчёт</a></p>';
}

// кнопка выйти
$logoutUrl = $APPLICATION->GetCurPageParam(
    "logout=yes&".bitrix_sessid_get(),
    ["login","logout","register","forgot_password","change_password","confirm_registration","sessid"]
);
echo '<p><a class="btn btn--ghost" href="'.htmlspecialcharsbx($logoutUrl).'">Выйти</a></p>';

echo '</div>';

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>
