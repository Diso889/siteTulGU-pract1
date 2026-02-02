<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Context;

if (!check_bitrix_sessid()) {
    LocalRedirect("/calculator/?err=sess");
}

if (!\Bitrix\Main\Loader::includeModule("iblock")) {
    LocalRedirect("/calculator/?err=iblock");
}

define("ESI_CALC_IBLOCK_ID", 2); //id инфоблока

function getEnumIdByXmlId(int $iblockId, string $propCode, string $xmlId): int
{
    $xmlId = trim($xmlId);
    if ($xmlId === '') return 0;

    $res = CIBlockPropertyEnum::GetList(
        ["SORT" => "ASC"],
        ["IBLOCK_ID" => $iblockId, "CODE" => $propCode, "XML_ID" => $xmlId]
    );

    if ($row = $res->Fetch()) {
        return (int)$row["ID"];
    }

    return 0;
}

$request = Context::getCurrent()->getRequest();

$objectType = (string)$request->getPost("object_type");  // house|industrial|energy (XML_ID)
$stage      = (string)$request->getPost("stage");        // foundation|frame|roof|finishing (XML_ID)
$area       = (float)$request->getPost("area");
$complexity = (string)$request->getPost("complexity");   // normal|hard (XML_ID)
$region     = (string)$request->getPost("region");       // near|far (XML_ID)

$phone   = trim((string)$request->getPost("phone"));
$email   = trim((string)$request->getPost("email"));
$comment = trim((string)$request->getPost("comment"));

if ($objectType === "" || $stage === "" || $area <= 0 || $complexity === "" || $region === "" || $phone === "") {
    LocalRedirect("/calculator/?err=required");
}

// Справочники расчёта
$baseRates = [
    "house"      => 12000,
    "industrial" => 15000,
    "energy"     => 18000,
];

$stageKoef = [
    "foundation" => 0.25,
    "frame"      => 0.35,
    "roof"       => 0.20,
    "finishing"  => 0.20,
];

$complexityKoef = [
    "normal" => 1.0,
    "hard"   => 1.3,
];

$regionKoef = [
    "near" => 1.0,
    "far"  => 1.15,
];

$base   = $baseRates[$objectType] ?? 12000;
$kStage = $stageKoef[$stage] ?? 0.3;
$kComp  = $complexityKoef[$complexity] ?? 1.0;
$kReg   = $regionKoef[$region] ?? 1.0;

$price = round($area * $base * $kStage * $kComp * $kReg, 0);

//enum_id для свойств списков
$objectTypeEnum = getEnumIdByXmlId(ESI_CALC_IBLOCK_ID, "OBJECT_TYPE", $objectType);
$stageEnum      = getEnumIdByXmlId(ESI_CALC_IBLOCK_ID, "STAGE", $stage);
$complexityEnum = getEnumIdByXmlId(ESI_CALC_IBLOCK_ID, "COMPLEXITY", $complexity);
$regionEnum     = getEnumIdByXmlId(ESI_CALC_IBLOCK_ID, "REGION", $region);

if (!$objectTypeEnum || !$stageEnum || !$complexityEnum || !$regionEnum) {
    LocalRedirect("/calculator/?err=enum");
}

global $USER;
$userId = (int)($USER->IsAuthorized() ? $USER->GetID() : 0);

$el = new CIBlockElement();

$name = "Заявка: {$area} м²";

$fields = [
    "IBLOCK_ID" => ESI_CALC_IBLOCK_ID,
    "NAME"      => $name,
    "ACTIVE"    => "Y",
    "PROPERTY_VALUES" => [
        "USER_ID"     => $userId,
        "OBJECT_TYPE" => $objectTypeEnum,
        "STAGE"       => $stageEnum,
        "AREA"        => $area,
        "COMPLEXITY"  => $complexityEnum,
        "REGION"      => $regionEnum,
        "PHONE"       => $phone,
        "EMAIL"       => $email,
        "COMMENT"     => $comment,
        "PRICE"       => $price,
    ],
];

$id = $el->Add($fields);

if (!$id) {
    LocalRedirect("/calculator/?err=save");
}

LocalRedirect("/calculator/?ok=1");
