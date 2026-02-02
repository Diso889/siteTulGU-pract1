<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Аренда техники");
?>
<section class="rent">
    <div class="container rent__head">
        <span class="badge">Аренда</span>
        <h1 class="h1 rent__title">Аренда техники</h1>
        <p class="lead rent__lead">Подберите технику по категории и оставьте заявку — менеджер уточнит сроки и стоимость.</p>
    </div>

    <div class="container rent__grid">
        <!-- фильтры слева -->
        <aside class="rent__filters panel">
            <div class="panel__in">
                <h2 class="rent__h2">Категории</h2>

                <div class="rent__checks">
                    <label class="chk">
                        <input type="checkbox" checked data-filter="excavators">
                        <span>Экскаваторы</span>
                    </label>
                    <label class="chk">
                        <input type="checkbox" checked data-filter="tractors">
                        <span>Тракторы</span>
                    </label>
                    <label class="chk">
                        <input type="checkbox" checked data-filter="kamaz">
                        <span>Камазы</span>
                    </label>
                    <label class="chk">
                        <input type="checkbox" checked data-filter="mini">
                        <span>Малая техника</span>
                    </label>
                </div>

                <hr class="line">

                <button class="btn btn--ghost rent__btn" type="button" data-filter-reset>Сбросить</button>
            </div>
        </aside>

        <!-- карточки справа -->
        <main class="rent__cards">
            <div class="rentCards" data-rent-grid>
                <!-- экскаваторы -->
                <article class="rentCard" data-cat="excavators" data-title="Экскаватор ES-1">
                    <div class="rentCard__img" style="background-image:url('<?=SITE_TEMPLATE_PATH?>/assets/img/rent/es1.jpg')"></div>
                    <div class="rentCard__body">
                        <div class="rentCard__tag">Экскаваторы</div>
                        <h3 class="rentCard__title">Экскаватор ES‑1</h3>
                        <div class="rentCard__meta">
                            <div>Цена: <b>Уточняйте</b></div>
                            <div>Подача: по договорённости</div>
                        </div>
                        <button class="btn rentCard__cta" type="button"
                                data-order
                                data-name="Экскаватор ES‑1"
                                data-cat="Экскаваторы"
                                data-img="<?=SITE_TEMPLATE_PATH?>/assets/img/rent/es1.jpg">Заказать</button>
                    </div>
                </article>

                <article class="rentCard" data-cat="excavators" data-title="Экскаватор ES-2">
                    <div class="rentCard__img" style="background-image:url('<?=SITE_TEMPLATE_PATH?>/assets/img/rent/es2.jpg')"></div>
                    <div class="rentCard__body">
                        <div class="rentCard__tag">Экскаваторы</div>
                        <h3 class="rentCard__title">Экскаватор ES‑2</h3>
                        <div class="rentCard__meta">
                            <div>Цена: <b>Уточняйте</b></div>
                            <div>Подача: по договорённости</div>
                        </div>
                        <button class="btn rentCard__cta" type="button"
                                data-order
                                data-name="Экскаватор ES‑2"
                                data-cat="Экскаваторы"
                                data-img="<?=SITE_TEMPLATE_PATH?>/assets/img/rent/es2.jpg">Заказать</button>
                    </div>
                </article>

                <article class="rentCard" data-cat="excavators" data-title="Экскаватор ES-3">
                    <div class="rentCard__img" style="background-image:url('<?=SITE_TEMPLATE_PATH?>/assets/img/rent/es3.jpg')"></div>
                    <div class="rentCard__body">
                        <div class="rentCard__tag">Экскаваторы</div>
                        <h3 class="rentCard__title">Экскаватор ES‑3</h3>
                        <div class="rentCard__meta">
                            <div>Цена: <b>Уточняйте</b></div>
                            <div>Подача: по договорённости</div>
                        </div>
                        <button class="btn rentCard__cta" type="button"
                                data-order
                                data-name="Экскаватор ES‑3"
                                data-cat="Экскаваторы"
                                data-img="<?=SITE_TEMPLATE_PATH?>/assets/img/rent/es3.jpg">Заказать</button>
                    </div>
                </article>

                <!-- камазы -->
                <article class="rentCard" data-cat="kamaz" data-title="КамАЗ KM-1">
                    <div class="rentCard__img" style="background-image:url('<?=SITE_TEMPLATE_PATH?>/assets/img/rent/km1.jpg')"></div>
                    <div class="rentCard__body">
                        <div class="rentCard__tag">Камазы</div>
                        <h3 class="rentCard__title">КамАЗ KM‑1</h3>
                        <div class="rentCard__meta">
                            <div>Цена: <b>Уточняйте</b></div>
                            <div>Подача: по договорённости</div>
                        </div>
                        <button class="btn rentCard__cta" type="button"
                                data-order
                                data-name="КамАЗ KM‑1"
                                data-cat="Камазы"
                                data-img="<?=SITE_TEMPLATE_PATH?>/assets/img/rent/km1.jpg">Заказать</button>
                    </div>
                </article>

                <article class="rentCard" data-cat="kamaz" data-title="КамАЗ KM-2">
                    <div class="rentCard__img" style="background-image:url('<?=SITE_TEMPLATE_PATH?>/assets/img/rent/km2.jpg')"></div>
                    <div class="rentCard__body">
                        <div class="rentCard__tag">Камазы</div>
                        <h3 class="rentCard__title">КамАЗ KM‑2</h3>
                        <div class="rentCard__meta">
                            <div>Цена: <b>Уточняйте</b></div>
                            <div>Подача: по договорённости</div>
                        </div>
                        <button class="btn rentCard__cta" type="button"
                                data-order
                                data-name="КамАЗ KM‑2"
                                data-cat="Камазы"
                                data-img="<?=SITE_TEMPLATE_PATH?>/assets/img/rent/km2.jpg">Заказать</button>
                    </div>
                </article>

                <article class="rentCard" data-cat="kamaz" data-title="КамАЗ KM-3">
                    <div class="rentCard__img" style="background-image:url('<?=SITE_TEMPLATE_PATH?>/assets/img/rent/km3.jpg')"></div>
                    <div class="rentCard__body">
                        <div class="rentCard__tag">Камазы</div>
                        <h3 class="rentCard__title">КамАЗ KM‑3</h3>
                        <div class="rentCard__meta">
                            <div>Цена: <b>Уточняйте</b></div>
                            <div>Подача: по договорённости</div>
                        </div>
                        <button class="btn rentCard__cta" type="button"
                                data-order
                                data-name="КамАЗ KM‑3"
                                data-cat="Камазы"
                                data-img="<?=SITE_TEMPLATE_PATH?>/assets/img/rent/km3.jpg">Заказать</button>
                    </div>
                </article>

                <!-- малая техника -->
                <article class="rentCard" data-cat="mini" data-title="Малая техника ML-1">
                    <div class="rentCard__img" style="background-image:url('<?=SITE_TEMPLATE_PATH?>/assets/img/rent/ml1.jpg')"></div>
                    <div class="rentCard__body">
                        <div class="rentCard__tag">Малая техника</div>
                        <h3 class="rentCard__title">Малая техника ML‑1</h3>
                        <div class="rentCard__meta">
                            <div>Цена: <b>Уточняйте</b></div>
                            <div>Подача: по договорённости</div>
                        </div>
                        <button class="btn rentCard__cta" type="button"
                                data-order
                                data-name="Малая техника ML‑1"
                                data-cat="Малая техника"
                                data-img="<?=SITE_TEMPLATE_PATH?>/assets/img/rent/ml1.jpg">Заказать</button>
                    </div>
                </article>

                <article class="rentCard" data-cat="mini" data-title="Малая техника ML-2">
                    <div class="rentCard__img" style="background-image:url('<?=SITE_TEMPLATE_PATH?>/assets/img/rent/ml2.jpg')"></div>
                    <div class="rentCard__body">
                        <div class="rentCard__tag">Малая техника</div>
                        <h3 class="rentCard__title">Малая техника ML‑2</h3>
                        <div class="rentCard__meta">
                            <div>Цена: <b>Уточняйте</b></div>
                            <div>Подача: по договорённости</div>
                        </div>
                        <button class="btn rentCard__cta" type="button"
                                data-order
                                data-name="Малая техника ML‑2"
                                data-cat="Малая техника"
                                data-img="<?=SITE_TEMPLATE_PATH?>/assets/img/rent/ml2.jpg">Заказать</button>
                    </div>
                </article>

                <article class="rentCard" data-cat="mini" data-title="Малая техника ML-3">
                    <div class="rentCard__img" style="background-image:url('<?=SITE_TEMPLATE_PATH?>/assets/img/rent/ml3.jpg')"></div>
                    <div class="rentCard__body">
                        <div class="rentCard__tag">Малая техника</div>
                        <h3 class="rentCard__title">Малая техника ML‑3</h3>
                        <div class="rentCard__meta">
                            <div>Цена: <b>Уточняйте</b></div>
                            <div>Подача: по договорённости</div>
                        </div>
                        <button class="btn rentCard__cta" type="button"
                                data-order
                                data-name="Малая техника ML‑3"
                                data-cat="Малая техника"
                                data-img="<?=SITE_TEMPLATE_PATH?>/assets/img/rent/ml3.jpg">Заказать</button>
                    </div>
                </article>

                <!-- тракторы (не забыть добавить картинки) -->
                <article class="rentCard" data-cat="tractors" data-title="Трактор TR-1">
                    <div class="rentCard__img rentCard__img--placeholder"></div>
                    <div class="rentCard__body">
                        <div class="rentCard__tag">Тракторы</div>
                        <h3 class="rentCard__title">Трактор TR‑1</h3>
                        <div class="rentCard__meta">
                            <div>Цена: <b>Уточняйте</b></div>
                            <div>Подача: по договорённости</div>
                        </div>
                        <button class="btn rentCard__cta" type="button"
                                data-order
                                data-name="Трактор TR‑1"
                                data-cat="Тракторы"
                                data-img="">Заказать</button>
                    </div>
                </article>

            </div>
        </main>
    </div>
</section>

<!-- Popup заказа  -->
<div class="modal" hidden data-modal>
    <div class="modal__backdrop" data-modal-close></div>
    <div class="modal__dialog" role="dialog" aria-modal="true" aria-label="Заявка на аренду">
        <button class="modal__close" type="button" aria-label="Закрыть" data-modal-close>×</button>

        <div class="modal__head">
            <div class="modal__img" data-modal-img></div>
            <div>
                <div class="modal__kicker" data-modal-cat>Категория</div>
                <div class="modal__title" data-modal-title>Техника</div>
                <div class="modal__note">Оставьте контакты — перезвоним и уточним условия.</div>
            </div>
        </div>

        <form class="modal__form" data-modal-form>
            <div class="field">
                <label>Имя</label>
                <input type="text" name="NAME" required>
            </div>
            <div class="field">
                <label>Телефон</label>
                <input type="tel" name="PHONE" required placeholder="+7">
            </div>
            <div class="field">
                <label>Комментарий</label>
                <textarea name="COMMENT" rows="4" placeholder="Сроки, место работ, требования..."></textarea>
            </div>

            <input type="hidden" name="EQUIPMENT" data-modal-hidden>

            <div style="display:flex;gap:12px;flex-wrap:wrap;margin-top:12px">
                <button class="btn" type="submit">Отправить</button>
                <button class="btn btn--ghost" type="button" data-modal-close>Отмена</button>
            </div>
        </form>
    </div>
</div>

<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>
