<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Услуги");
?>
<div class="bg-anim" aria-hidden="true"></div>

<section class="section">
    <div class="container">
        <span class="badge">Услуги</span>
        <h1 class="h1">Что выполняем</h1>
        <p class="lead">Полный спектр работ: общестроительные, монтажные, инженерные и электромонтажные направления.</p>

        <div class="cards">
            <div class="card reveal"><div class="card__in">
                    <h3>Строительство и ремонт</h3>
                    <div class="muted">Реконструкция, капитальный ремонт, малоэтажные и высотные дома, фундаменты различных типов.</div>
                </div></div>

            <div class="card reveal"><div class="card__in">
                    <h3>Инженерные системы</h3>
                    <div class="muted">Отопление, вентиляция и кондиционирование, внутренние и наружные сети и коммуникации.</div>
                </div></div>

            <div class="card reveal"><div class="card__in">
                    <h3>Электромонтаж</h3>
                    <div class="muted">Комплекс электромонтажных работ, строительство ВЛ 6–10 кВ.</div>
                </div></div>

            <div class="card reveal"><div class="card__in">
                    <h3>Металлоконструкции</h3>
                    <div class="muted">Монтаж, сборка металлоконструкций и технологических трубопроводов, сварочные работы.</div>
                </div></div>

            <div class="card reveal"><div class="card__in">
                    <h3>Общестрой</h3>
                    <div class="muted">Земляные, каменные, кровельные, фасадные, отделочные, геодезические работы, благоустройство.</div>
                </div></div>

            <div class="card reveal"><div class="card__in">
                    <h3>Проектирование</h3>
                    <div class="muted">Здания, сооружения, инженерные системы электроснабжения, водоснабжения и водоотведения.</div>
                </div></div>
        </div>

        <div class="panel" style="margin-top:14px">
            <div class="panel__in reveal">
                <h2>Нужен расчёт?</h2>
                <p class="muted">Заполните параметры — получите ориентировочную стоимость и заявку для менеджера.</p>
                <a class="btn" href="/calculator/">Перейти к расчёту</a>
            </div>
        </div>
    </div>
</section>

<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>
