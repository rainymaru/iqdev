$(function(){
	$("#datepicker").datepicker();
});

/* Локализация datepicker */
$.datepicker.regional['ru'] = {
	closeText: 'Закрыть',
	prevText: 'Предыдущий',
	nextText: 'Следующий',
	currentText: 'Сегодня',
	monthNames: ['Январь','Февраль','Март','Апрель','Май','Июнь','Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
	monthNamesShort: ['Янв','Фев','Мар','Апр','Май','Июн','Июл','Авг','Сен','Окт','Ноя','Дек'],
	dayNames: ['воскресенье','понедельник','вторник','среда','четверг','пятница','суббота'],
	dayNamesShort: ['вск','пнд','втр','срд','чтв','птн','сбт'],
	dayNamesMin: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
	weekHeader: 'Не',
	dateFormat: 'dd.mm.yy',
	firstDay: 1,
	isRTL: false,
	showMonthAfterYear: false,
	yearSuffix: ''
};
$.datepicker.setDefaults($.datepicker.regional['ru']);

$("#checkbox").on("change", function() {
  if ($('#checkbox').is(':checked')){
    $("#sumAdd").removeClass("none");
  } else {
    $("#sumAdd").addClass("none");
  }
});

$(document).ready(function() {
  $("#form").validate({
    errorClass: "error fail-alert is-invalid",
		validClass: "is-valid",
    rules: {
      startDate: {
				required: true,
        date: true,
      },
      sum : {
				required: true,
        number: true,
				range: [1000, 3000000],
      },
      term: {
				required: true,
        number: true,
      },
      percent: {
				required: true,
        number: true,
				range: [3, 100],
      },
      sumAdd: {
        number: true,
				range: [0, 3000000],
      },

    },
    messages : {
			startDate: {
				required: "Введите дату в формате DD.MM.YY"
			},
      sum: {
				required: "Пожалуйста, введите числовое значение от 1000 до 3000000",
        number: "Пожалуйста, введите числовое значение",
				range: "Пожалуйста, введите числовое значение от 1000 до 3000000", 
      },
      term: {
				required: "Пожалуйста, введите срок вклада",
        number: "Пожалуйста, введите числовое значение"
      },
      percent: {
				required: "Введите значение от 3% до 100%",
        number: "Пожалуйста, введите числовое значение",
				range: "Введите значение от 3% до 100%"
      },
      sumAdd: {
        number: "Пожалуйста, введите числовое значение",
				range: "Введите значение от 0 до 3000000"
      }
    }
  });
});

$.validator.addMethod("date", function(value, element) {
      return value.match(/^(0[1-9]|[12][0-9]|3[01])[.](0[1-9]|1[012])[.](20)[0-9]{2}$/);
    },
    "Пожалуйста, введите дату в формате DD.MM.YY"
);

$("#form").on("submit", function(event){
  event.preventDefault();
	$.ajax({
		url: '/calc.php',
    method: 'POST',
    dataType: 'json',
    data: $(this).serialize(),
    success: function(response){
			$('#message').text(response.text);
    }
  });
});
