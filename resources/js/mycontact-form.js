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

    if($(this).attr('id') === 'mycontact-form') {
      event.preventDefault();
      var uform = $(this);

      $.ajax({
        type: uform.attr('method'),
        url: uform.attr('action'),
        data: uform.serialize()
      }).done(function (response) {
        $('#js-content').html(response);
        $('.alert, .text-danger, .invalid-feedback').delay(1000).fadeOut(1000);
      });
    }
  });

  jsContent.on('click', 'a', function (event) {
    if($(this).hasClass('js-add-field')) {
      event.preventDefault();
      $.ajax({
        type: 'GET',
        url: $(this).attr('href')
      }).done(function (response) {
        $('#js-content').html(response);
      });
    }
  });
});



