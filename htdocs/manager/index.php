<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Заявки клиентов");
global $USER;

date_default_timezone_set('Europe/Moscow'); // часовой пояс

if (!$USER->IsAuthorized()) {
    LocalRedirect("/personal/");
}

// проверяем группу менеджеров (ID = 5)
$userGroups = $USER->GetUserGroupArray();
if (!in_array(5, $userGroups)) {
    LocalRedirect("/personal/");
}

if (!\Bitrix\Main\Loader::includeModule("iblock")) {
    echo "<div class='container'><div class='card'>Модуль инфоблоков не подключён.</div></div>";
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
    return;
}

define("ESI_CALC_IBLOCK_ID", 2);
define("ESI_STATUS_PROP_CODE", "STATUS");

//забираем все варианты списка статусов и строим select по ENUM_ID
$statusEnums = [];
$rsEnums = CIBlockPropertyEnum::GetList(
    ["SORT" => "ASC"],
    ["IBLOCK_ID" => ESI_CALC_IBLOCK_ID, "CODE" => ESI_STATUS_PROP_CODE]
);
while ($e = $rsEnums->GetNext()) {
    $statusEnums[(int)$e["ID"]] = [
        "VALUE" => (string)$e["VALUE"],
        "XML_ID" => (string)$e["XML_ID"],
    ];
}

//сохранение ответа/статуса
if ($_SERVER["REQUEST_METHOD"] === "POST" && ($_POST["action"] ?? "") === "save_answer") {
    if (check_bitrix_sessid()) {
        $elementId = (int)($_POST["ELEMENT_ID"] ?? 0);
        $answer    = trim((string)($_POST["ANSWER"] ?? ""));
        $statusEnumId = (int)($_POST["STATUS_ENUM_ID"] ?? 0);

        $props = [];

        // статус: сохраняем напрямую ENUM_ID
        if ($statusEnumId > 0 && isset($statusEnums[$statusEnumId])) {
            $props["STATUS"] = $statusEnumId;
        }

        // ответ менеджера
        if ($answer !== "") {
            $props["MANAGER_ANSWER"] = ["VALUE" => ["TYPE" => "HTML", "TEXT" => $answer]];
            $props["MANAGER_ANSWER_DATE"] = date("d.m.Y H:i:s");
        }

        if ($elementId > 0 && !empty($props)) {
            CIBlockElement::SetPropertyValuesEx($elementId, ESI_CALC_IBLOCK_ID, $props); // [web:815]
            LocalRedirect($APPLICATION->GetCurPageParam("saved=1", ["saved"]));
        } else {
            LocalRedirect($APPLICATION->GetCurPageParam("saved=0", ["saved"]));
        }
    } else {
        LocalRedirect($APPLICATION->GetCurPageParam("saved=0", ["saved"]));
    }
}

// список заявок
$res = CIBlockElement::GetList(
    ["ID" => "DESC"],
    ["IBLOCK_ID" => ESI_CALC_IBLOCK_ID, "ACTIVE" => "Y"],
    false,
    ["nTopCount" => 200],
    [
        "ID",
        "NAME",
        "DATE_CREATE",
        "PROPERTY_AREA",
        "PROPERTY_OBJECT_TYPE",
        "PROPERTY_STAGE",
        "PROPERTY_PRICE",
        "PROPERTY_USER_ID",
        "PROPERTY_PHONE",
        "PROPERTY_EMAIL",
        "PROPERTY_STATUS",
        "PROPERTY_STATUS_ENUM_ID",
        "PROPERTY_MANAGER_ANSWER",
        "PROPERTY_MANAGER_ANSWER_DATE",
    ]
);

echo "<div class='container'><h1>Все заявки клиентов</h1>";

//уведомление сверху
if (isset($_GET["saved"])) {
    if ($_GET["saved"] == "1") {
        echo "<div style='
            display:inline-block;
            margin:10px 0 16px;
            padding:8px 12px;
            border:1px solid rgba(34,197,94,.6);
            background:rgba(34,197,94,.08);
            color:#bbf7d0;
            border-radius:10px;
            font-size:14px;
        '>Сохранено</div>";
    } else {
        echo "<div style='
            display:inline-block;
            margin:10px 0 16px;
            padding:8px 12px;
            border:1px solid rgba(239,68,68,.6);
            background:rgba(239,68,68,.08);
            color:#fecaca;
            border-radius:10px;
            font-size:14px;
        '>Не удалось сохранить</div>";
    }
}

if ($res->SelectedRowsCount() == 0) {
    echo "<div class='card'>Заявок пока нет.</div>";
} else {
    while ($row = $res->GetNext()) {
        $clientId = (int)($row["PROPERTY_USER_ID_VALUE"] ?? 0);
        $client = $clientId > 0 ? CUser::GetByID($clientId)->Fetch() : null;

        $clientName = "Неизвестно";
        if (is_array($client)) {
            $clientName = trim((string)($client["NAME"] ?? "")." ".(string)($client["LAST_NAME"] ?? ""));
            if ($clientName === "") {
                $clientName = (string)($client["LOGIN"] ?? ("Пользователь #".$clientId));
            }
        }

        // текущий статус
        $statusText = "";
        if (!empty($row["PROPERTY_STATUS_VALUE"])) {
            $statusText = (string)$row["PROPERTY_STATUS_VALUE"];
        } elseif (!empty($row["PROPERTY_STATUS_ENUM_ID"]) && isset($statusEnums[(int)$row["PROPERTY_STATUS_ENUM_ID"]])) {
            $statusText = $statusEnums[(int)$row["PROPERTY_STATUS_ENUM_ID"]]["VALUE"];
        }

        // MANAGER_ANSWER приходит как массив
        $ans = $row["PROPERTY_MANAGER_ANSWER_VALUE"];
        $currentAnswer = is_array($ans) ? (string)($ans["TEXT"] ?? "") : (string)$ans;

        $currentStatusEnumId = (int)($row["PROPERTY_STATUS_ENUM_ID"] ?? 0);

        echo "<div class='card' style='margin-bottom:12px'>";
        echo "<div><b>#".$row["ID"]."</b> ".htmlspecialcharsbx($row["NAME"])."</div>";
        echo "<div style='color:#64748b'>".$row["DATE_CREATE"]." | Клиент: ".htmlspecialcharsbx($clientName)."</div>";

        if (!empty($row["PROPERTY_EMAIL_VALUE"])) {
            echo "<div>Email: ".htmlspecialcharsbx($row["PROPERTY_EMAIL_VALUE"])."</div>";
        }
        if (!empty($row["PROPERTY_PHONE_VALUE"])) {
            echo "<div>Телефон: ".htmlspecialcharsbx($row["PROPERTY_PHONE_VALUE"])."</div>";
        }

        if ($statusText !== "") {
            echo "<div>Статус: ".htmlspecialcharsbx($statusText)."</div>";
        }

        echo "<div>Тип объекта: ".htmlspecialcharsbx($row["PROPERTY_OBJECT_TYPE_VALUE"])."</div>";
        echo "<div>Этап: ".htmlspecialcharsbx($row["PROPERTY_STAGE_VALUE"])."</div>";
        echo "<div>Площадь: ".htmlspecialcharsbx($row["PROPERTY_AREA_VALUE"])." м²</div>";
        echo "<div>Ориентировочная стоимость: ".number_format((float)$row["PROPERTY_PRICE_VALUE"], 0, ".", " ")." ₽</div>";

        if (!empty($row["PROPERTY_MANAGER_ANSWER_DATE_VALUE"])) {
            echo "<div style='color:#64748b;margin-top:6px'>Последний ответ: ".htmlspecialcharsbx($row["PROPERTY_MANAGER_ANSWER_DATE_VALUE"])."</div>";
        }

        echo "<hr>";
        echo "<form method='post' style='margin-top:8px'>";
        echo bitrix_sessid_post();
        echo "<input type='hidden' name='action' value='save_answer'>";
        echo "<input type='hidden' name='ELEMENT_ID' value='".(int)$row["ID"]."'>";

        echo "<div style='margin-bottom:8px'><b>Статус</b></div>";
        echo "<select name='STATUS_ENUM_ID' style='width:100%;max-width:420px;padding:8px;margin-bottom:10px'>";
        echo "<option value='0'>— не менять —</option>";
        foreach ($statusEnums as $enumId => $enum) {
            $selected = ($currentStatusEnumId === (int)$enumId) ? " selected" : "";
            echo "<option value='".(int)$enumId."'".$selected.">".htmlspecialcharsbx($enum["VALUE"])."</option>";
        }
        echo "</select>";

        echo "<div style='margin-bottom:8px'><b>Ответ менеджера</b></div>";
        echo "<textarea name='ANSWER' rows='4' style='width:100%;max-width:720px;padding:10px'>".htmlspecialcharsbx($currentAnswer)."</textarea>";

        echo "<div style='margin-top:10px'>";
        echo "<button type='submit' class='btn btn--ghost'>Сохранить</button>";
        echo "</div>";

        echo "</form>";

        echo "</div>";
    }
}

echo "<p><a class='btn btn--ghost' href='/personal/'>← Назад в личный кабинет</a></p>";
echo "</div>";

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>
