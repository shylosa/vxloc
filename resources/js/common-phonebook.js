$(function(){
  $('#js-link-phonebook').
  on('click', function (event) {

    $.ajax({
      type: 'GET',
      url: $(this).attr('href')
    }).done(function (response) {
      $('#js-content').html(response);
      $(function(){
        $('.js-link').click(function(event){
          $(this).text(($(this).text() === 'view details') ? 'hide details' : 'view details');
        });
      });
    });

    //Запрет перехода по нажатой ссылке
    return false;
  });
});