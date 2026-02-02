<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Расчёт стоимости");
global $USER;

$err = (string)($_GET["err"] ?? "");
$ok  = (string)($_GET["ok"] ?? "");
?>

<section class="calcPage">
    <div class="container calcPage__head">
        <span class="badge">Расчёт</span>
        <h1 class="h1">Расчёт стоимости работ</h1>
        <p class="lead">Выберите параметры — система рассчитает ориентировочную стоимость и сохранит заявку.</p>
    </div>

    <div class="container calcPage__grid">
        <div class="calcBox">
            <div class="calcBox__in">

                <?php if ($ok === "1"): ?>
                    <div class="calcMsg calcMsg--ok">
                        Заявка отправлена. Мы свяжемся с вами.
                    </div>
                <?php endif; ?>

                <?php if ($err !== ""): ?>
                    <div class="calcMsg calcMsg--err">
                        <?php
                        
                        $map = [
                                "sess" => "Сессия устарела. Обновите страницу и отправьте ещё раз.",
                                "iblock" => "Модуль инфоблоков недоступен. Проверьте настройки сайта.",
                                "required" => "Заполните обязательные поля.",
                                "enum" => "Ошибка справочников (XML_ID). Проверьте списки свойств инфоблока.",
                                "save" => "Не удалось сохранить заявку. Попробуйте ещё раз.",
                        ];
                        echo htmlspecialchars($map[$err] ?? ("Ошибка: ".$err));
                        ?>
                    </div>
                <?php endif; ?>

                <form class="calcForm" method="post" action="/calculator/submit.php" data-calc-form>
                    <?=bitrix_sessid_post()?>

                    <div class="calcForm__grid">
                        <div class="field">
                            <label>Тип объекта</label>
                            <select name="object_type" required data-calc-object>
                                <option value="">Выберите…</option>
                                <option value="house">Дом / коттедж</option>
                                <option value="industrial">Промышленный объект</option>
                                <option value="energy">Энергетика / сети</option>
                            </select>
                        </div>

                        <div class="field">
                            <label>Этап работ</label>
                            <select name="stage" required data-calc-stage>
                                <option value="">Выберите…</option>
                                <option value="foundation">Фундамент</option>
                                <option value="frame">Каркас / коробка</option>
                                <option value="roof">Кровля</option>
                                <option value="finishing">Отделка</option>
                            </select>
                        </div>

                        <div class="field">
                            <label>Площадь (м²)</label>
                            <input type="number" name="area" min="1" step="1" placeholder="Например: 120" required data-calc-area>
                        </div>

                        <div class="field">
                            <label>Сложность</label>
                            <select name="complexity" required data-calc-complexity>
                                <option value="">Выберите…</option>
                                <option value="normal">Обычная</option>
                                <option value="hard">Повышенная</option>
                            </select>
                        </div>

                        <div class="field calcForm__wide">
                            <label>Регион работ</label>
                            <select name="region" required data-calc-region>
                                <option value="">Выберите…</option>
                                <option value="near">Близко</option>
                                <option value="far">Далеко</option>
                            </select>
                        </div>

                        <div class="field">
                            <label>Телефон</label>
                            <input type="text" name="phone" placeholder="+7" required>
                        </div>

                        <div class="field">
                            <label>Email</label>
                            <input type="email" name="email" placeholder="mail@example.ru">
                        </div>

                        <div class="field calcForm__wide">
                            <label>Комментарий</label>
                            <textarea name="comment" rows="4" placeholder="Пожелания, сроки, особенности объекта…"></textarea>
                        </div>
                    </div>

                    <?php if (!$USER->IsAuthorized()): ?>
                        <div class="calcHint">
                            Для просмотра заявок в личном кабинете нужно войти или зарегистрироваться.
                        </div>
                    <?php endif; ?>

                    <div class="calcActions">
                        <button class="btn" type="submit">Отправить</button>
                        <a class="btn btn--ghost" href="/personal/">Личный кабинет</a>
                    </div>
                </form>
            </div>
        </div>

        <aside class="calcSide">
            <div class="calcSide__card">
                <div class="calcSide__title">Ориентировочная стоимость</div>
                <div class="calcSide__price" data-calc-total>—</div>
                <div class="calcSide__rows">
                    <div class="calcSide__row"><span>Расчёт</span><b>по вашим параметрам</b></div>
                    <div class="calcSide__row"><span>Точность</span><b>после ТЗ</b></div>
                </div>
                <div class="calcSide__note">
                    Итоговая стоимость зависит от ТЗ, условий, сроков и объёмов.
                </div>
            </div>
        </aside>
    </div>
</section>

<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>
