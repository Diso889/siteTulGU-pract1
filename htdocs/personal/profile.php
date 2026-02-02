<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Профиль");

global $USER;
if (!$USER->IsAuthorized())
{
    LocalRedirect("/personal/");
}
?>

<section class="cabinet">
    <div class="container">
        <span class="badge">ЛК</span>
        <h1 class="h1">Профиль</h1>
        <p class="lead">Изменение личных данных и пароля.</p>

        <div class="cabinet__box">
            <?php
            $APPLICATION->IncludeComponent(
                    "bitrix:main.profile",
                    "",
                    array(
                            "SET_TITLE" => "N",
                            "AJAX_MODE" => "N",
                            "SEND_INFO" => "Y",
                            "CHECK_RIGHTS" => "Y",
                            "USER_PROPERTY_NAME" => "",
                            "USER_PROPERTY" => array(),
                    ),
                    false
            );
            ?>
        </div>

        <div style="margin-top:14px">
            <a class="btn btn--ghost" href="/personal/">← Назад в кабинет</a>
        </div>
    </div>
</section>

<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>
