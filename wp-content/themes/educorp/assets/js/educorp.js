$(function () {
  // Everton 02/02/2021
  $("#contact #enviar").click(() => {
    var name = $("#contact #name").val();
    var email = $("#contact #email").val();
    var subject = $("#contact #subject").val();
    var message = $("#contact #message").val();
    var destino = $('#contact #destino').val();
    //console.log(destino);
    var exp = /^\w+([\.-]\w+)*@\w+\.(\w+\.)*\w{2,3}$/;
    if (name.length < 4) {
      $("#contact #name").val("Nome inválido!").css({ 'color': 'red' });
    } else if (!exp.test(email)) {
      $("#contact #email").val("E-mail inválido!").css({ 'color': 'red' });
    } else if (subject.length < 4) {
      $("#contact #subject").val("Assunto inválido!").css({ 'color': 'red' });
    } else if (message.length < 4) {
      $("##contact #message").val("Mensagem inválida!").css({ 'color': 'red' });
    } else {
      $.post("/wp-content/themes/educorp/page-contato.php", { name: name, email: email, subject: subject, message: message, destino: destino }, function (data) {
        $("#contact .sent").html(data);
        $("#contact #name").val("");
        $("#contact #email").val("");
        $("#contact #subject").val("");
        $("#contact #message").val("");
      });
    }
  })
  $("#contact #name").click(() => {
    $("#contact #name").val("").css({ 'color': '#000' });;
  })
  $("#contact #email").click(() => {
    $("#contact #email").val("").css({ 'color': '#000' });;
  })
  $("#contact #subject").click(() => {
    $("#contact #subject").val("").css({ 'color': '#000' });;
  })
  $("#contact #message").click(() => {
    $("#contact #message").val("").css({ 'color': '#000' });;
  })
})