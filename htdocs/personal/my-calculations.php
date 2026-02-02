<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Мои заявки");
global $USER;

if (!$USER->IsAuthorized()) {
    LocalRedirect("/personal/");
}

if (!\Bitrix\Main\Loader::includeModule("iblock")) {
    echo "<div class='container'><div class='card'>Модуль инфоблоков не подключён.</div></div>";
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
    return;
}

// тот же ID инфоблока, что в submit.php
define("ESI_CALC_IBLOCK_ID", 2);

$userId = (int)$USER->GetID();

$res = CIBlockElement::GetList(
    ["ID" => "DESC"],
    [
        "IBLOCK_ID" => ESI_CALC_IBLOCK_ID,
        "ACTIVE" => "Y",
        "PROPERTY_USER_ID" => $userId
    ],
    false,
    ["nTopCount" => 100],
    [
        "ID",
        "IBLOCK_ID",
        "NAME",
        "DATE_CREATE",
        "PROPERTY_AREA",
        "PROPERTY_OBJECT_TYPE",
        "PROPERTY_STAGE",
        "PROPERTY_PRICE",
        "PROPERTY_STATUS",
        "PROPERTY_MANAGER_ANSWER",
        "PROPERTY_MANAGER_ANSWER_DATE",
    ]
);

echo "<div class='container'><h1>Мои заявки на расчёт</h1>";

if ($res->SelectedRowsCount() == 0) {
    echo "<div class='card'>Заявок пока нет.</div>";
} else {
    while ($row = $res->GetNext()) {
        echo "<div class='card' style='margin-bottom:12px'>";
        echo "<div><b>#".$row["ID"]."</b> ".htmlspecialcharsbx($row["NAME"])."</div>";
        echo "<div style='color:#64748b'>".$row["DATE_CREATE"]."</div>";

        //читаем статус напрямую через GetProperty
        $statusText = "";
        $dbProp = CIBlockElement::GetProperty(
            ESI_CALC_IBLOCK_ID,
            (int)$row["ID"],
            "sort",
            "asc",
            ["CODE" => "STATUS"]
        );
        if ($p = $dbProp->Fetch()) {
            $statusText = (string)($p["VALUE_ENUM"] ?? "");
        }

        if ($statusText !== "") {
            echo "<div>Статус: ".htmlspecialcharsbx($statusText)."</div>";
        }

        echo "<div>Тип объекта: ".htmlspecialcharsbx($row["PROPERTY_OBJECT_TYPE_VALUE"])."</div>";
        echo "<div>Этап: ".htmlspecialcharsbx($row["PROPERTY_STAGE_VALUE"])."</div>";
        echo "<div>Площадь: ".htmlspecialcharsbx($row["PROPERTY_AREA_VALUE"])." м²</div>";
        echo "<div>Ориентировочная стоимость: ".number_format((float)$row["PROPERTY_PRICE_VALUE"], 0, ".", " ")." ₽</div>";

        // MANAGER_ANSWER как массив 
        $ans = $row["PROPERTY_MANAGER_ANSWER_VALUE"];
        $ansText = is_array($ans) ? (string)($ans["TEXT"] ?? "") : (string)$ans;

        if ($ansText !== "") {
            echo "<hr>";
            if (!empty($row["PROPERTY_MANAGER_ANSWER_DATE_VALUE"])) {
                echo "<div style='color:#64748b'>Ответ от: ".htmlspecialcharsbx($row["PROPERTY_MANAGER_ANSWER_DATE_VALUE"])."</div>";
            }
            echo "<div><b>Ответ менеджера:</b></div>";
            echo "<div>".nl2br(htmlspecialcharsbx($ansText))."</div>";
        } else {
            echo "<div style='color:#64748b;margin-top:8px'>Ответ менеджера пока не получен.</div>";
        }

        echo "</div>";
    }
}

echo "</div>";

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>
