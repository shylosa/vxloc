$(function(){
  $('#js-link-login').
  on('click', function (event) {

    $.ajax({
      type: 'GET',
      url: $(this).attr('href')
    }).done(function (response) {
      $('#js-content').html(response);
    });

    //Запрет перехода по нажатой ссылке
    return false;
  });
});

    /*let phonebook = $('#js-phonebook');
    let linkLogin = $('#js-link-login');
    phonebook.find('.invalid-feedback').remove();
    phonebook.removeClass('was-validated');

    event.preventDefault();

    $.ajax({
      type: 'POST',
      url: this.attr('href'),
      data: chatForm.serialize(),
    }).done(function(data) {
      postTable.html(data);
      chatForm[0].reset();
      chatForm.find('.invalid-feedback').remove();
    }).fail(function(jqXHR, textStatus, errorThrown) {
      let $field, fieldName, $feedback;

      chatForm.addClass('was-validated');

      for (fieldName in jqXHR.responseJSON) {
        $field = $('[name*="[' + fieldName + ']"]');
        $feedback = $('<div class="invalid-feedback"></div>');
        $feedback.html(jqXHR.responseJSON[fieldName]);
        $field.parent().append($feedback);
      }
    });

  });
});*/
