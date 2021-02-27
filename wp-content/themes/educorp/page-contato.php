<?php
  
$para = $_POST['destino'];
$assunto = 'Mensagem do Solução de Aprendizagem';

$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

$mensagem = "<br><strong>De</strong>: ".$name."<br><strong>E-Mail</strong>: ".$email."<br><br><strong>Assunto</strong>: ".$subject."<br><strong>Mensagem</strong>: ".$message;

$headers[] = 'MIME-Version: 1.0';
$headers[] = 'Content-type: text/html; charset=iso-8859-1';
$headers[] = 'From: Solução de Aprendizagem <noreply-educorp@unicamp.br>';

$enviar = mail($para, $assunto, $mensagem, implode("\r\n", $headers));

if($enviar){
  echo "<span style='color:#088A08'>Mensagem Enviada com Sucesso</span> ";
}else{
  echo "<span style='color:#f00'>Erro ao Enviar a Mensagem</span>";
}
  
?>
