<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>IQ Dev Backend</title>
  <link href="assets/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="assets/jquery-ui.css">
  <script src="assets/jquery-1.12.4.js"></script>
  <script src="assets/jquery-ui.js"></script>
  <script src="assets/jquery.validate.min.js"></script>
</head>
<body>
  <div class="wrapper">
    <div class="content">
    <div class="header">
    <div class="header__container">
      <img class="header__logo" src="img/logo.svg" alt="Logo IQ Dev">
      <p class="header__text">Deposit Calculator</p>
      </div>
    </div>
    <div class="container">
      <h1 class="form__title h1">Депозитный калькулятор</h1>
      <p class="form__description">Калькулятор депозитов позволяет рассчитать ваши доходы после внесения суммы на счет в банке по опредленному тарифу.</p>
      <form class="row" id="form">
          <div class="col">
          <input class="form-control" type="text" name="startDate" id="datepicker" placeholder="Дата открытия">
          <input class="form-control" type="text" name="sum" placeholder="Сумма вклада">
          <input class="custom-control-input" id="checkbox" type="checkbox" name="checkbox">
          <span  class="custom-control-description">Ежемесячное пополнение вклада</span>
          <input class="form-control btn btn-success" type="submit" value="Рассчитать">
          </div>
          <div class="col">
            <div class="row">
            <div class="form-group col-md-9">
              <input class="form-control" type="text" name="term" placeholder="Срок вклада">
            </div>
            <div class="form-group col-md-3">
              <select class="form-control" name="termSelect">
              <option value="month">Месяц</option>
              <option value="year">Год</option> 
          </select>
            </div>
            </div>
          <input class="form-control" type="text" name="percent" placeholder="Процентная ставка % годовых">
          <input class="form-control none" id="sumAdd" type="text" name="sumAdd" placeholder="Сумма пополнения вклада">
          </div>
          <p id="message"></p>
      </form> 
    </div>
    </div>
    <div class="footer"></div>
  </div>
<script src="script.js"></script>
</body>
</html>
