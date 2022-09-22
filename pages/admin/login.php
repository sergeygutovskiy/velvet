<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Админ Панель | Вход</title>

  <!-- UIkit CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.15.10/dist/css/uikit.min.css" />

  <!-- UIkit JS -->
  <script src="https://cdn.jsdelivr.net/npm/uikit@3.15.10/dist/js/uikit.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/uikit@3.15.10/dist/js/uikit-icons.min.js"></script>
</head>
<body>
  <div class="uk-container uk-flex" uk-height-viewport="expand: true">
    <div class="uk-card uk-card-default uk-card-body uk-width-1-1 uk-margin-auto uk-margin-auto-vertical">
      <form action="/admin/login" method="POST">
        <h3 class="uk-card-title">Войти</h3>

        <div class="uk-margin">
          <input class="uk-input" type="text" name="name" placeholder="Имя">
        </div>
        <div class="uk-margin">
          <input class="uk-input" type="password" name="password" placeholder="Фамилия">
        </div>

        <button class="uk-button uk-button-primary" type="submit">
          войти
        </button>
      </form>
    </div>
  </div>
</body>
</html>
