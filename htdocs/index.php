<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("СтройКомпания — промышленное строительство");
?>
<section class="hero">
    <div class="container hero__grid">
        <div class="panel">
            <div class="panel__in">
                <span class="badge">Промышленный монтаж • Инженерия • Электромонтаж</span>
                <h1 class="h1">Комплексные решения<br>для промышленного строительства</h1>
                <p class="lead">
                    Выполняем строительно‑монтажные работы от проектирования до ввода объекта в эксплуатацию, а также аренду спецтехники.
                </p>
                <div style="display:flex;gap:12px;flex-wrap:wrap">
                    <a class="btn" href="/calculator/">Получить расчёт</a>
                    <a class="btn btn--ghost" href="/projects/">Наши проекты</a>
                </div>

                <div class="kpi">
                    <div class="box"><b>Сроки</b><span>План‑график и контроль</span></div>
                    <div class="box"><b>Качество</b><span>Допуски и стандарты</span></div>
                    <div class="box"><b>Безопасность</b><span>На всех этапах работ</span></div>
                </div>
            </div>
        </div>

        <div class="panel">
            <div class="panel__in">
                <h2 style="margin:0 0 10px">Ключевые направления</h2>
                <div class="muted">Строительство и ремонт • Инженерные системы • Электромонтаж • Металлоконструкции</div>
                <hr class="line">
                <div class="muted">Листайте вниз, чтобы узнать больше</div>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <h2>Направления работ</h2>
        <div class="cards">
            <div class="card"><div class="card__in">
                    <h3>Металлоконструкции</h3>
                    <div class="muted">Монтаж, сборка, сварочные работы, технологические трубопроводы.</div>
                </div></div>
            <div class="card"><div class="card__in">
                    <h3>Инженерные системы</h3>
                    <div class="muted">ОВиК, внутренние/наружные сети, монтаж оборудования.</div>
                </div></div>
            <div class="card"><div class="card__in">
                    <h3>Электромонтаж</h3>
                    <div class="muted">Комплекс работ и ВЛ 6–10 кВ.</div>
                </div></div>
        </div>
    </div>
</section>

<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>
