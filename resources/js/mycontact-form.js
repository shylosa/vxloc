$(function(){
  $('#js-link-mycontact').on('click', function (event) {
    event.preventDefault();

    $.ajax({
      type: 'GET',
      url: $(this).attr('href')
    }).done(function (response) {
      $('#js-content').html(response);
    });
  });

  var jsContent =$('#js-content');

  jsContent.on('submit', 'form', function (event) {
      event.preventDefault();
      var uform = $('#mycontact-form');

      $.ajax({
        type: uform.attr('method'),
        url: uform.attr('action'),
        data: uform.serialize()
      }).done(function (response) {
        $('#js-content').html(response);
        $('.alert, .text-danger, .invalid-feedback').delay(1000).fadeOut(1000);
      });
  });

  jsContent.on('click', 'a', function (event) {
    event.preventDefault();

    $.ajax({
      type: 'GET',
      url: $(this).attr('href'),
    }).done(function (response) {
      $('#js-content').html(response);
    });
  });
});



