<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Регистрация");
?>
<div class="container">
    <?php
    $APPLICATION->IncludeComponent("bitrix:main.register", ".default", [
        "SHOW_FIELDS" => ["NAME","LAST_NAME","PERSONAL_PHONE","EMAIL"],
        "REQUIRED_FIELDS" => ["NAME","PERSONAL_PHONE","EMAIL"],
        "AUTH" => "Y",
        "USE_BACKURL" => "Y",
        "SET_TITLE" => "Y"
    ]);
    ?>
</div>
<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>
