$(function(){
  $('#js-link-mycontact').on('click', function (event) {

    $.ajax({
      type: 'GET',
      url: $(this).attr('href')
    }).done(function (response) {
      $('#js-content').html(response);
    });

    return false;
  });

  $('#mycontact-form').on('submit', function (event) {

    event.preventDefault();
    var form = $(this);

    $.ajax({
      type: form.attr('method'),
      url: form.attr('action'),
      data: form.serialize()
    }).done(function (response) {
      $('#js-content').html(response);
    });

  });
});