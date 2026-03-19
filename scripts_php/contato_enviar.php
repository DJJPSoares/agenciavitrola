<?php

$connect_error = 'Sorry, we\'re experiencing connection issues.';
$con = mysqli_connect("localhost","u937895940_agvtr","1aA@3467985");
mysqli_select_db($con, "u937895940_contato") or die($connect_error);

function protecao($string){
  $string = str_replace(" or ", "", $string);
  $string = str_replace("select ", "", $string);
  $string = str_replace("delete ", "", $string);
  $string = str_replace("create ", "", $string);
  $string = str_replace("drop ", "", $string);
  $string = str_replace("update ", "", $string);
  $string = str_replace("drop table", "", $string);
  $string = str_replace("show table", "", $string);
  $string = str_replace("applet", "", $string);
  $string = str_replace("object", "", $string);
  $string = strip_tags($string);

  return $string;
}

$nome      = trim($_POST['nome']);
$nome      = addslashes($nome);
$nome      = protecao($nome);
$email     = trim($_POST['email']);
$email     = addslashes($email);
$email     = protecao($email);
$celular   = trim($_POST['celular']);
$celular   = addslashes($celular);
$celular   = protecao($celular);
$assunto   = $_POST['assunto'];
$assunto   = addslashes($assunto);
$assunto   = protecao($assunto);
$mensagem  = trim($_POST['mensagem']);
$mensagem  = addslashes($mensagem);
$mensagem  = protecao($mensagem);


// Criando a variável que irá representar o corpo do e-mail
$msg = "De: ";
$msg .= $nome;
$msg .= "\r\n";
$msg .= "E-mail: ";
$msg .= $email;
$msg .= "\r\n";
$msg .= "Celular: ";
$msg .= $celular;
$msg .= "\r\n";
$msg .= "Assunto: ";
$msg .= $assunto;
$msg .= "\r\n";
$msg .= "Mensagem: ";
$msg .= "\r\n";
$msg .= $mensagem;
$msg .= "\r\n";
$msg .= "\r\n";

//Seleciono o IP
$ip = $_SERVER['REMOTE_ADDR'];

//Gero a data e hora de cadastro
$dataabertura = date("Y/m/d H:i:s");

//Agora selecionamos algumas informações de controle opcionais. O IP da pessoa que está inserindo as informações e a data e hora da inserção.

if(($nome && $email && $assunto && $mensagem) == '') {
    echo "<script language= 'JavaScript'>
        alert('Desculpe: Ocorreu um erro no envio da mensagem. Por favor, tente novamente')
      location.href='index.php';
     </script>";
   } else {

$sql = mysqli_query($con, "INSERT INTO contato (nome, email, celular, assunto, mensagem, dataabertura, ip) VALUES ('".$nome."', '".$email."', '".$celular."', '".$assunto."', '".$mensagem."', '".$dataabertura."', '".$ip."')");

// Criando a variável adicional de headers
$headers = "From: "; //Observe que eu utilizei o header 'From' que é um header padrão.
$headers .= $nome;
$headers .= " <";
$headers .= $email;
$headers .= ">";
// Agora é só utilizar a função mail()

// mail("contato@meusite.com", $assunto, $msg, $headers);
// O bloco exibe a mensagem de acordo com resultado da utilização
// da função, ou seja, se a mensagem foi enviada ou não

if(@mail("contato@agenciavitrola.com.br", $assunto, $msg, $headers)) {
	echo "<script language= 'JavaScript'>
	      alert('Obrigado, mensagem enviada com sucesso. Entraremos em contato em breve')
		  location.href='index.php';
		 </script>";
}
else {
	echo "<script language=javascript>
	      alert('Desculpe: Ocorreu um erro no envio da mensagem. Por favor, tente novamente')
		  location.href='index.php';
		 </script>";
}
}
?>