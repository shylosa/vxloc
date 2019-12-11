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