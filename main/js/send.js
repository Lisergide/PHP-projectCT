function send(id){
  $.ajax({
    type: "POST",
    url: "?page=basket&func=addAjax&id=" + id,
    success: function (date) {
      $('#basket').html(date);
    }
});
}