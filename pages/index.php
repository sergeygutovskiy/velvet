<!DOCTYPE html>
<html lang="ru">
<head>
  <?php require '_header.php'; ?>

  <title> Velvet </title>
</head>
<body>
  <div class="page-container">
    <img class="page-container__gradient-img" src="/images/gradient.png">
    <div class="page-container__background-img" id="background-img"></div>

    <div class="content" id="content">
      <span class="content__date">14 октября</span>
      
      <span class="content__age">18+</span>
      <span class="content__mobile-place">GRIBOEDOV BASEMENT</span>

      <h1 class="content__title">VELVET</h1>

      <p class="content__paragraph">
        В пятницу 14 октября с 23:00 и до раннего утра легендарный Бункер Грибоедова наполнится 
        звуками брейк бита, дарк диско, электро, нью бита, панк транса, техно и гипнотик минимала.
        Dj XNX из Москвы и поддержка от локальной и глобальной сцены Петербурга, не пропустите!
        <br><br> 
        Электронный билет по кнопке ниже - 
        <span style="text-decoration: underline;">
          <?php echo $_ENV['PRICE'] ?>₽
        </span> 
      </p>

      <button class="content__btn btn" id="modal-open-btn">
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
</body>
</html>
