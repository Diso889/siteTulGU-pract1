/* local/templates/esi/assets/main.js
   Полный файл: бургер-меню, плавный скролл по якорям, фильтры + модалка на /rent/,
   отправка CTA-формы (внизу страниц) пока заглушкой.
   Ничего не прячет (никаких opacity:0 для контента).
*/
(function () {

    const $ = (sel, root = document) => root.querySelector(sel);
    const $$ = (sel, root = document) => Array.from(root.querySelectorAll(sel));

    // бургер меня
    (function initBurger() {
        const burger = $('[data-burger]');
        const mobile = $('[data-mobile]');
        if (!burger || !mobile) return;

        burger.addEventListener('click', () => {
            const opened = mobile.classList.toggle('is-open');
            burger.setAttribute('aria-expanded', opened ? 'true' : 'false');
        });

        // закрыватие меню при клике по ссылке
        mobile.addEventListener('click', (e) => {
            const a = e.target.closest('a');
            if (!a) return;
            mobile.classList.remove('is-open');
            burger.setAttribute('aria-expanded', 'false');
        });
    })();

    // прлавная прокрутка
    (function initSmoothAnchors() {
        document.addEventListener('click', (e) => {
            const a = e.target.closest('a[href^="#"]');
            if (!a) return;

            const href = a.getAttribute('href');
            if (!href || href === '#') return;

            const target = document.querySelector(href);
            if (!target) return;

            e.preventDefault();
            target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            history.pushState(null, '', href);
        });
    })();

    // страница заказа
    (function initRent() {
        const rentGrid = $('[data-rent-grid]');
        if (!rentGrid) return;

        // фильтры
        const checks = $$('[data-filter]');
        const resetBtn = $('[data-filter-reset]');

        function applyFilters() {
            const active = new Set(checks.filter(c => c.checked).map(c => c.getAttribute('data-filter')));
            const cards = $$('.rentCard', rentGrid);

            cards.forEach(card => {
                const cat = card.getAttribute('data-cat');
                const show = active.size === 0 ? true : active.has(cat);
                card.style.display = show ? '' : 'none';
            });
        }

        checks.forEach(c => c.addEventListener('change', applyFilters));

        if (resetBtn) {
            resetBtn.addEventListener('click', () => {
                checks.forEach(c => (c.checked = true));
                applyFilters();
            });
        }

        // плавная прокрутка
        try {
            const url = new URL(window.location.href);
            const cat = url.searchParams.get('cat');
            if (cat) checks.forEach(c => (c.checked = (c.getAttribute('data-filter') === cat)));
        } catch (_) {}
        applyFilters();

        const modal = $('[data-modal]');
        if (!modal) return;

        const modalTitle = $('[data-modal-title]');
        const modalCat = $('[data-modal-cat]');
        const modalImg = $('[data-modal-img]');
        const modalHidden = $('[data-modal-hidden]');
        const form = $('[data-modal-form]');

        function openModal({ name, cat, img }) {
            modal.hidden = false;
            document.body.style.overflow = 'hidden';

            if (modalTitle) modalTitle.textContent = name || 'Техника';
            if (modalCat) modalCat.textContent = cat || 'Категория';
            if (modalHidden) modalHidden.value = name || '';

            if (modalImg) {
                modalImg.style.backgroundImage = img ? `url('${img}')` : '';
            }
        }

        function closeModal() {
            modal.hidden = true;
            document.body.style.overflow = '';
        }

        document.addEventListener('click', (e) => {
            const orderBtn = e.target.closest('[data-order]');
            if (orderBtn) {
                openModal({
                    name: orderBtn.getAttribute('data-name'),
                    cat: orderBtn.getAttribute('data-cat'),
                    img: orderBtn.getAttribute('data-img'),
                });
                return;
            }

            if (e.target.closest('[data-modal-close]')) {
                closeModal();
            }
        });

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closeModal(); // закрытие по Esc
        });

        if (form) {
            form.addEventListener('submit', (e) => {
                e.preventDefault();

                // Заглушка. Следующий шаг: отправка в инфоблок/почту.
                form.reset();
                closeModal();
                alert('Заявка отправлена! Мы свяжемся с вами.');
            });
        }
    })();

    // Bottom CTA (на всех страницах)
    (function initCta() {
        const f = $('[data-cta-form]');
        if (!f) return;

        f.addEventListener('submit', (e) => {
            e.preventDefault();

            // Заглушка. Следующий шаг: отправка в инфоблок/почту.
            f.reset();
            alert('Спасибо! Заявка отправлена, мы свяжемся с вами.');
        });
    })();
})();

(function () {
    const form = document.querySelector('[data-calc-form]');
    if (!form) return;

    const out = document.querySelector('[data-calc-total]');
    if (!out) return;

    const baseRates = { house: 12000, industrial: 15000, energy: 18000 };
    const stageKoef = { foundation: 0.25, frame: 0.35, roof: 0.20, finishing: 0.20 };
    const complexityKoef = { normal: 1.0, hard: 1.3 };
    const regionKoef = { near: 1.0, far: 1.15 };

    const get = (sel) => form.querySelector(sel);

    function fmt(n){
        return new Intl.NumberFormat('ru-RU').format(n) + ' ₽';
    }

    function recalc(){
        const object = get('[data-calc-object]')?.value || '';
        const stage = get('[data-calc-stage]')?.value || '';
        const area = Number(get('[data-calc-area]')?.value || 0);
        const comp = get('[data-calc-complexity]')?.value || '';
        const region = get('[data-calc-region]')?.value || '';

        if (!object || !stage || !comp || !region || !area || area <= 0) {
            out.textContent = '—';
            return;
        }

        const base = baseRates[object] ?? 12000;
        const kStage = stageKoef[stage] ?? 0.3;
        const kComp = complexityKoef[comp] ?? 1.0;
        const kReg = regionKoef[region] ?? 1.0;

        const price = Math.round(area * base * kStage * kComp * kReg);
        out.textContent = fmt(price);
    }

    form.addEventListener('input', recalc);
    form.addEventListener('change', recalc);
    recalc();
})();
