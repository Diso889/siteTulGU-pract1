<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>
<!doctype html>
<html lang="ru">
<head>
    <?php $APPLICATION->ShowHead(); ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?php $APPLICATION->ShowTitle(); ?></title>

    <link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/assets/main.css?v=10">
    <script defer src="<?=SITE_TEMPLATE_PATH?>/assets/main.js?v=10"></script>
</head>
<body>

<?php
global $USER;
if ($USER->IsAdmin()) {
    $APPLICATION->ShowPanel();
}
?>

<!--анимированный фон-->
<div class="bgfx" aria-hidden="true"></div>

<header class="topbar" id="topbar">
    <div class="container topbar__row">
        <a class="brand" href="/">
            <span class="brand__mark"></span>
            <span class="brand__text">СтройКомпания</span>
        </a>

        <nav class="nav" aria-label="Навигация">
            <a href="/about/">О компании</a>
            <a href="/services/">Услуги</a>
            <a href="/projects/">Проекты</a>

            <!-- dropdown -->
            <div class="nav-dd" data-nav-dd>
                <a class="nav-dd__btn" href="/rent/">Аренда техники</a>
                <div class="nav-dd__menu" role="menu" aria-label="Категории аренды">
                    <a role="menuitem" href="/rent/?cat=excavators">Экскаваторы</a>
                    <a role="menuitem" href="/rent/?cat=tractors">Тракторы</a>
                    <a role="menuitem" href="/rent/?cat=kamaz">Камазы</a>
                    <a role="menuitem" href="/rent/?cat=mini">Малая техника</a>
                </div>
            </div>

            <a href="/calculator/">Расчёт</a>
            <a href="/personal/">ЛК</a>
        </nav>

        <div class="topbar__cta">
            <a class="btn btn--ghost" href="/calculator/">Получить расчёт</a>
        </div>

        <button class="burger" type="button" aria-label="Открыть меню" aria-expanded="false" data-burger>
            <span></span><span></span><span></span>
        </button>
    </div>

    <div class="mobile" data-mobile>
        <div class="container mobile__links">
            <a href="/about/">О компании</a>
            <a href="/services/">Услуги</a>
            <a href="/projects/">Проекты</a>
            <a href="/rent/">Аренда техники</a>
            <a href="/calculator/">Расчёт</a>
            <a href="/personal/">ЛК</a>
        </div>
    </div>
</header>

<main class="page">
