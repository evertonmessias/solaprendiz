<?php
$para = $_POST['emailconteudista'];
$assunto = 'Mensagem do Solução de Aprendizagem';

$titulo = $_POST['titulo'];

$URL_ATUAL= "https://$_SERVER[HTTP_HOST]";

$mensagem = "<h3>Proposta Educorp:</h3>Conteudista, você já pode editar a proposta <a href='".$URL_ATUAL."' target='_blank'><strong>".$titulo."</strong></a>.";

$headers[] = 'MIME-Version: 1.0';
$headers[] = 'Content-type: text/html; charset=utf-8';
$headers[] = 'From: Solução de Aprendizagem <noreply-educorp@unicamp.br>';

$enviar = mail($para, $assunto, $mensagem, implode("\r\n", $headers));

if($enviar){
  echo "<span style='color:#088A08'>E-mail enviado ao(s) Conteudista(s) com Sucesso</span> ";
}else{
  echo "<span style='color:#f00'>Erro ao Enviar a Mensagem</span>";
}
?>
