<?php
	
	require "./Bibliotecas/PHPMailer/Exception.php";
	require "./Bibliotecas/PHPMailer/OAuth.php";
	require "./Bibliotecas/PHPMailer/PHPMailer.php";
	require "./Bibliotecas/PHPMailer/POP3.php";
	require "./Bibliotecas/PHPMailer/SMTP.php";

	//Import PHPMailer classes into the global namespace
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	//print_r($_POST);

	class Mensagem {
		private $nome = null;
		private $email = null;
		private $celular = null;
		private $assunto = null;
		private $mensagem = null;
		public $status = ['codigo_status' => null, 'descricao_status' => ''];

		public function __get($atributo) {
			return $this->$atributo;
		}

		public function __set($atributo, $valor) {
			$this->$atributo = $valor;
		}

		function protecao($string) {
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

		public function mensagemValida() {
			if(empty($this->para) || empty($this->assunto) || empty($this->mensagem)) {
				return false;
			}
				return true;
		}
	}

	$mensagem = new Mensagem();

	$mensagem->__set('nome', trim($_POST['nome']);
	$mensagem->__set('nome', addslashes('nome');
	$mensagem->__set('nome', protecao('nome');

	$mensagem->__set('email', trim($_POST['email']);
	$mensagem->__set('email', addslashes('email');
	$mensagem->__set('email', protecao('email');

	$mensagem->__set('celular', trim($_POST['celular']);
	$mensagem->__set('celular', addslashes('celular');
	$mensagem->__set('celular', protecao('celular');

	$mensagem->__set('assunto', trim($_POST['assunto']);
	$mensagem->__set('assunto', addslashes('assunto');
	$mensagem->__set('assunto', protecao('assunto');

	$mensagem->__set('mensagem', trim($_POST['mensagem']);
	$mensagem->__set('mensagem', addslashes('mensagem');
	$mensagem->__set('mensagem', protecao('mensagem');

	if(!$mensagem->mensagemValida()) {
		echo 
			"<script language= 'JavaScript'>
        		alert('Desculpe: Ocorreu um erro no envio da mensagem. Por favor, tente novamente')
      			location.href='index.php';
     		</script>";
	}

	$mail = new PHPMailer(true);
	try {

		//Conecta com o banco de dados
		$connect_error = 'Sorry, we\'re experiencing connection issues.';
		$con = mysqli_connect("localhost","u163114764_agvtr", "1aA@3467985");
		mysqli_select_db($con, "u163114764_agvtr") or die($connect_error);

	    //Server settings
	    $mail->SMTPDebug = false;                                 // Enable verbose debug output
	    $mail->isSMTP();                                      // Set mailer to use SMTP
	    $mail->Host = '';  // Specify main and backup SMTP servers
	    $mail->SMTPAuth = true;                               // Enable SMTP authentication
	    $mail->Username = 'contato@agenciavitrola.com.br';                 // SMTP username
	    $mail->Password = '1a@3467985';                           // SMTP password
	    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
	    $mail->Port = 587;                                    // TCP port to connect to

	    //Recipients
	    $mail->setFrom($mensagem->__get('email'));
	    $mail->addAddress('contato@agenciavitrola.com.br');     // Add a recipient
	    //$mail->addAddress('ellen@example.com');               // Name is optional
	    //$mail->addReplyTo('info@example.com', 'Information');
	    //$mail->addCC('cc@example.com');
	    //$mail->addBCC('bcc@example.com');

	    //Attachments
	    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
	    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

	    //Content
	    $mail->isHTML(true);                                  // Set email format to HTML
	    $mail->Subject = $mensagem->__get('assunto');
	    $mail->Body    = 'E-mail de: ' . ($mensagem->__get('nome') . '<br/>' . 'celular: ' . ($mensagem->__get('celular') . '<br/>' . 'Mensagem: ' . $mensagem->__get('mensagem');
	    $mail->AltBody = 'É necessário utilizar um client que suporte HTML para ter acesso ao conteúdo total dessa mensagem';

	    $mail->send();

	    //Seleciono o IP
		$ip = $_SERVER['REMOTE_ADDR'];

		//Gero a data e hora de cadastro
		$dataabertura = date("Y/m/d H:i:s");

		$sql = mysqli_query($con, "INSERT INTO contato (nome, email, celular, assunto, mensagem, dataabertura, ip) VALUES ('".$nome."', '".$email."', '".$celular."', '".$assunto."', '".$mensagem."', '".$dataabertura."', '".$ip."')");

	    $mensagem->status['codigo_status'] = 1;
	    $mensagem->status['descricao_status'] = 'Mensagem enviada com sucesso';

	} catch (Exception $e) {

		$mensagem->status['codigo_status'] = 2;
	    $mensagem->status['descricao_status'] = 'Não foi possível enviar este e-mail! Por favor tente novamente mais tarde. Detalhes do erro: ' . $mail->ErrorInfo;

	}
	
?>