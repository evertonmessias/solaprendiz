<?php
$assunto = 'Mensagem do Solução de Aprendizagem';
$titulo = $_POST['titulo'];
$headers[] = 'MIME-Version: 1.0';
$headers[] = 'Content-type: text/html; charset=utf-8';
$headers[] = 'From: Solução de Aprendizagem <noreply-educorp@unicamp.br>';
$ehresp =  $_POST['ehresp'];

if($ehresp == 0){
  $para = $_POST['adminemail'];
  $mensagem = "<h3>Proposta Educorp:</h3>Responsável, a proposta <strong>".$titulo."</strong> foi finalizada!";
  $quem = "ao Responsável";
}else if($ehresp == 1){
  $URL_ATUAL= "https://$_SERVER[HTTP_HOST]";
  $para = $_POST['emailconteudista'];
  $mensagem = "<h3>Proposta Educorp:</h3>Conteudista, você já pode editar a proposta <a href='".$URL_ATUAL."' target='_blank'><strong>".$titulo."</strong></a>.";
  $quem = "ao(s) Conteudista(s)";
}

$enviar = mail($para, $assunto, $mensagem, implode("\r\n", $headers));
if($enviar){
  echo "<span style='color:#088A08'>E-mail enviado ".$quem." com Sucesso</span> ";
}else{
  echo "<span style='color:#f00'>Erro ao Enviar a Mensagem</span>";
}
?>
