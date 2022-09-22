<!DOCTYPE html>
<html lang="ru">
<head>
  <?php require '_header.php'; ?>

  <title> Velvet </title>

  <script src="https://events.nethouse.ru/assets/js/popup-form.js"></script>

  <!-- Yandex.Metrika counter -->
  <script type="text/javascript" >
    (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
    m[i].l=1*new Date();
    for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
    k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
    (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

    ym(90522388, "init", {
          clickmap:true,
          trackLinks:true,
          accurateTrackBounce:true
    });
  </script>
  <noscript><div><img src="https://mc.yandex.ru/watch/90522388" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
  <!-- /Yandex.Metrika counter -->
</head>
<body>
  <div class="page-container">
    <img class="page-container__gradient-img" src="/images/gradient.png">
    <div class="page-container__background-img" id="background-img"></div>

    <div class="content" id="content">
      <span class="content__date">14 октября</span>

      <span class="content__age">18+</span>
      <span class="content__mobile-place">GRIBOEDOV BASEMENT</span>

      <h1 class="content__title" id="title">VELVET</h1>

      <p class="content__paragraph">
        В ПЯТНИЦУ 14 ОКТЯБРЯ С 23:00 И ДО РАННЕГО УТРА ЛЕГЕНДАРНЫЙ БУНКЕР ГРИБОЕДОВА НАПОЛНИТСЯ ЗВУКАМИ БРЕЙК БИТА, 
        ДАРК ДИСКО, ЭЛЕКТРО, НЬЮ БИТА, ПАНК ТРАНСА, ТЕХНО И ГИПНОТИК МИНИМАЛА. 
        DJ XNX ИЗ МОСКВЫ И ПОДДЕРЖКА ОТ ЛОКАЛЬНОЙ И ГЛОБАЛЬНОЙ СЦЕНЫ ПЕТЕРБУРГА, НЕ ПРОПУСТИТЕ!
        <br><br> 
        ЭЛЕКТРОННЫЙ БИЛЕТ ПО КНОПКЕ НИЖЕ:
        <br>
        ОДИНОЧНЫЙ - <span style="text-decoration: underline;">500₽</span>.
        <br>
        НА ТРОИХ - <span style="text-decoration: underline;">1200₽</span>.
        <br><br>
        ПРИВЕЛЕГИИ ЭЛЕКТРОННЫХ БИЛЕТОВ: ОТДЕЛЬНАЯ ОЧЕРЕДЬ; ВЭЛКОМ ДРИНКИ.
      </p>

      <button class="content__btn btn" onclick="showEventsNhForm('https://events.nethouse.ru/buy_tickets/58040/')">
        купить билет
      </button>

      <div class="content__icons">
        <a class="content__icon" href="https://www.instagram.com/velvet.wav">
          <img width="26" height="26" src="/images/inst.svg">
        </a>

        <a class="content__icon" href="https://t.me/VELVETVLVT">
          <img width="26" height="26" src="/images/tg.svg">
        </a>

        <a class="content__icon" href="https://vk.com/public215752020">
          <img width="26" height="26" src="/images/vk.svg">
        </a>
      </div>

      <div class="content__footer">
        <a class="content__contacts" href="/contacts">реквизиты</a>
        <span class="content__place">GRIBOEDOV BASEMENT</span>
      </div>
    </div>

    <div class="modal-wrapper" id="modal-wrapper">
      <div class="modal" id="modal">
        <button class="modal__close" id="modal-close-btn"></button>
        <form class="modal__content" action="/create-order" method="POST">
          <span class="modal__title">ПОКУПКА БИЛЕТА</span>

          <p class="modal__paragraph">
            Пожалуйста, укажите ваши данные для оформления покупки и получения билета.
          </p>

          <div class="modal__group">
            <label class="label">фио</label>
            <input class="input" type="text" name="fio" required>
          </div>

          <div class="modal__group">
            <label class="label">Телефон</label>
            <input class="input" type="text" name="phone" required>
          </div>

          <div class="modal__group">
            <label class="label">Email</label>
            <input class="input" type="email" name="email" required>
          </div>

          <div class="modal__group">
            <label class="label">количество билетов</label>
            <div class="price-calculator">
              <div class="price-calculator__input">
              <input type="hidden" id="price" value="<?php echo $_ENV['PRICE']; ?>">
              <input type="hidden" id="price-discount" value="<?php echo $_ENV['DISCOUNT_PRICE']; ?>">

                <button type="button" id="minus-btn" class="price-calculator__btn price-calculator__btn_minus" disabled></button>
                <input id="price-input" class="price-calculator__label" type="number" name="quantity" value="1" min="1" max="10">
                <button type="button" id="plus-btn" class="price-calculator__btn price-calculator__btn_plus"></button>

                <span class="price-calculator__total-old" id="price-total-old"><?php echo $_ENV['PRICE']; ?> РУБ</span>
                <span class="price-calculator__total" id="price-total"><?php echo $_ENV['PRICE']; ?> РУБ</span>
              </div>
            </div>
          </div>

          <div class="modal__group">
            <p class="modal__hint">
              От 3-х билетов в один чек действует скидка 20%.
              Привелегии электронных билетов: отдельная очередь и вэлком дринки.   
            </p>
          </div>

          <button class="modal__submit btn" type="submit">
            купить билет
          </button>

          <p class="modal__footer-text">
            нажимая на кнопку, вы даете согласие на <a href="/files/policy.pdf">обработку персональных данных</a>
          </p>
        </form>
      </div>
    </div>
  </div>

  <script src="/js/app.js"></script>
  <script src="/js/word-animation.js"></script>
</body>
</html>
