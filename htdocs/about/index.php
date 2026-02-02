<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("О компании");
?>
<div class="bg-anim" aria-hidden="true"></div>

<section class="section">
    <div class="container">
        <span class="badge">Компания</span>
        <h1 class="h1">СтройКомпания</h1>
        <p class="lead">Строительно-монтажные работы от проектирования до ввода в эксплуатацию, а также аренда спецтехники и грузовых автомобилей.</p>

        <div class="cards">
            <div class="card reveal"><div class="card__in">
                    <h3>Надёжность</h3>
                    <div class="muted">100% ответственность за сроки и качество строительства и монтажа.</div>
                </div></div>
            <div class="card reveal"><div class="card__in">
                    <h3>Безопасность</h3>
                    <div class="muted">Фокус на безопасности в процессе работ и при эксплуатации результата.</div>
                </div></div>
            <div class="card reveal"><div class="card__in">
                    <h3>Команда</h3>
                    <div class="muted">Квалифицированные рабочие и ИТР с опытом более 5 лет, допуски, включая НАКС.</div>
                </div></div>
        </div>

        <div class="panel" style="margin-top:14px">
            <div class="panel__in reveal">
                <h2>Контакты</h2>
                <div class="muted">
                    <div>Ген. директор: Семеничев Иван Алексеевич</div>
                    <div>Email: <a href="mailto:semenichev.iva@yandex.ru">semenichev.iva@yandex.ru</a></div>
                    <div>Тел.: <a href="tel:+79999999999">+7 (999) 999‑99‑99</a>, <a href="tel:+78888888888">+7 (888) 888‑88‑88</a></div>
                    <div>Сайт: <a href="https://github.com/Diso889/siteTulGU-pract" target="_blank" rel="noopener">github</a></div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>
