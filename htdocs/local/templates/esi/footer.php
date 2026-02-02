</main>

<section class="cta">
    <div class="container cta__wrap">
        <div class="cta__grid">
            <div class="cta__left">
                <div class="cta__kicker">Остались вопросы?</div>
                <h2 class="cta__title">Мы готовы ответить<br>на ваши вопросы<br>или принять заявку</h2>

                <div class="cta__contacts">
                    <a class="cta__contact" href="tel:+79999999999">
                        <span class="cta__ico">☎</span>
                        <span>
              <b>+7 (999) 999‑99‑99</b>
              <small>Позвонить</small>
            </span>
                    </a>

                    <a class="cta__contact" href="mailto:semenichev.iva@yandex.ru">
                        <span class="cta__ico">✉</span>
                        <span>
              <b>semenichev.iva@yandex.ru</b>
              <small>Написать на почту</small>
            </span>
                    </a>
                </div>
            </div>

            <div class="cta__right">
                <div class="ctaForm">
                    <div class="ctaForm__title">Оставить заявку</div>
                    <div class="ctaForm__subtitle">Перезвоним в течение 15 минут</div>

                    <form class="ctaForm__body" data-cta-form>
                        <label>Ваше имя</label>
                        <input type="text" name="NAME" placeholder="Андрей Петров" required>

                        <label>Номер телефона</label>
                        <input type="tel" name="PHONE" placeholder="+7" required>

                        <label>Ваш вопрос</label>
                        <textarea name="QUESTION" rows="4" placeholder="Текст вопроса"></textarea>

                        <button class="ctaForm__btn" type="submit">Отправить</button>

                        <div class="ctaForm__policy">
                            Нажимая на кнопку, вы соглашаетесь с
                            <a href="/privacy/">политикой конфиденциальности</a>
                        </div>
                    </form>
                </div>
            </div>


            <img class="cta__img" src="<?=SITE_TEMPLATE_PATH?>/assets/img/cta.png" alt="Техника"> <!--картинка экскаватор-->
        </div>
    </div>
</section>

<footer class="footer">
    <div class="container footer__grid">
        <div>
            <div class="footer__title">ООО «СтройКомпания»</div>
            <div class="muted">Строительно-монтажные работы и аренда спецтехники.</div>
        </div>

        <div>
            <div class="footer__title">Контакты</div>
            <div class="muted">
                <div><a href="tel:+79999999999">+7 (999) 999‑99‑99</a></div>
                <div><a href="tel:+78888888888">+7 (888) 888‑88‑88</a></div>
                <div><a href="mailto:semenichev.iva@yandex.ru">semenichev.iva@yandex.ru</a></div>
                <div><a href="https://github.com/Diso889/siteTulGU-pract" target="_blank" rel="noopener">github</a></div>
            </div>
        </div>

        <div>
            <div class="footer__title">Дополнительно</div>
            <div class="muted">
                <div><a href="/calculator/">Расчёт стоимости</a></div>
                <div><a href="/personal/">Личный кабинет</a></div>
            </div>
        </div>
    </div>

    <div class="container footer__bottom muted">
        © <?=date('Y')?> СтройКомпания
    </div>
</footer>

</body>
</html>
