<?php

$startDate = $_POST['startDate']; // Дата открытия вклада
$sum = $_POST['sum']; // Сумма вклада
$term = $_POST['term']; // Срок вклада в мес/год
$checkbox = $_POST['checkbox']; // Ежемесячное пополнение вклада
$termSelect = $_POST['termSelect']; // Выбранный срок мес/год
$percent = $_POST['percent']; // Процентная ставка, % годовых

$date = explode(".", $startDate);

if(!$startDate) {
  $response = [
    'text' => 'Введите правильную дату',
    ];
    echo json_encode($response);
    die();
} else {
  if (!checkdate($date[1], $date[0], $date[2])) {
    $response = [
      'text' => 'Введите правильную дату в формате DD.MM.YY',
      ];
      echo json_encode($response);
      die();
  }
}

if ($sum < 1000 || $sum > 3000000) {
  $response = [
    'text' => 'Ошибка, введите число от 1000 до 3000000',
    ];
    echo json_encode($response);
    die();
} 

if ($termSelect == 'month') {
  if ($term < 1 || $term > 60) {
    $response = [
      'text' => 'Ошибка, срок вклада может быть от 1 до 60 месяцев',
      ];
      echo json_encode($response);
      die();
  }
} 

if ($termSelect == 'year'){
  if($term < 1 || $term > 5){
    $response = [
      'text' => 'Ошибка, срок вклада может быть от 1 до 5 лет',
      ];
      echo json_encode($response);
      die();
  }
  $term = $_POST['term'] * 12;
}

if(is_numeric($percent)) {
if ($percent < 3 || $percent > 100) {
  $response = [
    'text' => 'Процентная ставка может быть от 3% до 100%',
    ];
    echo json_encode($response);
    die();
  }
} else {
  $response = [
    'text' => 'Введите целое число от 3% до 100%',
    ];
    echo json_encode($response);
    die();
}

 //Проверка на ежемесячное пополнение
  if ($checkbox) {
      if($_POST['sumAdd']) {
        $sumAdd = $_POST["sumAdd"];
      } else {
        $sumAdd = 0;
      }
  } 

  if ($sumAdd < 0 || $sumAdd > 3000000) {
    $response = [
      'text' => 'Ошибка, сумма пополнения вклада может быть от 0 до 3000000',
      ];
      echo json_encode($response);
      die();
  }

//Предыдущий месяц
if ($date[1] - 1 === 0) {
  $prevDay = 12;
  $year = $date[2] - 1;
} else {
  $prevDay = $date[1] - 1;
  $year = $date[2];
}

$daysN = date('t', mktime(0, 0, 0, $date[1], 1, $date[2])); // Количество дней в текущем месяце на которые приходился вклад
$daysY = date('L')?366:365; // Количество дней в году на который приходился вклад
$daysPrevMonth = cal_days_in_month(CAL_GREGORIAN, $prevDay, $year); //Количество дней в прошлом месяце.
$prevResult = $sum + ($daysN * ($percent/$daysY)); // Сумма на счете на конец прошлого месяца

for ($i = 0; $i < $term - 1; $i++) {
  if ($date[1] + 1 === 13) {
    $nextDate = 1;
    $yearInFor = $date[2] + 1;
  } else {
    $nextDate = $date[1] + 1;
    $yearInFor = $date[2];
  }

  $daysCurrentMonthinFor = cal_days_in_month(CAL_GREGORIAN, $nextDate, $yearInFor);
  $result += ($prevResult + ($prevResult + $sumAdd)) * ($daysCurrentMonthinFor * ($percent / $daysY));
}

if ($term === 1) {
  $response = [
    'text' => round($prevResult, 0),
    ];
    echo json_encode($response);
    die();
} else {
  $response = [
    'text' => round($result, 0),
    ];
    echo json_encode($response);
    die();
}






