$(document).ready(function () {
  var form = $('#formRegistration');
  form.validate({
    validClass: 'is-valid',
    rules: {
      regName: {
        required: true
      },
      regSecondName: {
        required: true
      },
      email: {
        required: true,
        email: true //для проверки валидации на сервере закомментировать
      },
      passwordReg: {
        required: true,
        minlength: 5
      },
      rePasswordReg: {
        required: true,
        minlength: 5,
        equalTo: passwordReg //для проверки валидации на сервере закомментировать
      },
    },
    messages: {
      regName: "Пожалуйста, укажите Имя",
      regSecondName: "Пожалуйста, укажите Фамилию",
      passwordReg: {
        required: "Введите пароль, под которым будет производится вход в аккаунт",
        minlength: "Ваш пароль составляет менее 5 символов"
      },
      rePasswordReg: {
        required: "Введите пароль, под которым будет производится вход в аккаунт",
        minlength: "Ваш пароль составляет менее 5 символов",
        equalTo: "Пароли должны совпадать"
      },
      email: "Пожалуйста, укажите Email"
    },
    errorPlacement: function (error, element) {
      offset = element.offset();
      element.addClass('is-invalid');
      error.insertAfter(element);
      error.addClass('invalid-feedback');
    },
    success: function (error, element) {
      element.className = 'form-control is-valid';

    },
    submitHandler: function () {
      $.ajax({
        type: form.attr('method'),
        url: form.attr('action'),
        data: form.serialize(),
        success: function (data) {
          $('#formRegistration').css('display', 'none');
          $('#status').css('display', 'block');
          $('#status').html('<div class="alert alert-success" role="alert">'
            + '<h1 class="alert-heading">Регистрация успешно завершена</h4>'
            + '</div>')
        },
        error: function (data) {
          $('#status').css('display', 'block');
          let message;
          if (data.responseText == 2) {
            message = 'Валидация данных на сервере прошла с ошибкой, пользователь с указанным Email или Именем уже зарегестрирован';
          }
          else if (data.responseText == 3) {
            message = 'Валидация данных на сервере прошла с ошибкой, пожалуйста, проверьте указанный пароль(пароль и повтор пароля должны совпадать) и Email на соответствие формату ...@...';
          }
          $('#status').html('<div class="alert alert-danger" role="alert">'
            + message
            + '</div>')
        },
      });
    }
  });
});