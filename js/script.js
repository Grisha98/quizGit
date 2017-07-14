function add(){
  var data = new FormData(this);

  $.ajax({
      url: '../register.php',
      type: "POST",
      data: data,
      contentType: false,
      cache: false,
      processData: false,
      success: function (response) {
        $('#data').html(response);
      },
      error: function(jqXHR, textStatus, errorThrown) {
        console.log(textStatus, errorThrown);
      }
  });
}