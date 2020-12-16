<?php

//index.php

//Incluir arquivo de configuração
include('Oauth2/config.php');

$login_button = '';

//Google
//Este valor da variável $ _GET ["code"] recebido depois que o usuário faz o login em sua conta do Google redireciona para o script PHP, então este valor da variável foi recebido
if(isset($_GET["code"]))
{
 //Ele tentará trocar um código por um token de autenticação válido.
 $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

 //Essa condição verificará se há algum erro ocorrendo durante a obtenção do token de autenticação. Se não ocorrer nenhum erro, ele será executado se o bloco de código /
 if(!isset($token['error']))
 {
  //Defina o token de acesso usado para solicitações
  $google_client->setAccessToken($token['access_token']);

  //Armazene o valor "access_token" na variável $ _SESSION para uso futuro.
  $_SESSION['access_token'] = $token['access_token'];

  //Criar objeto da classe OAuth 2 do serviço Google
  $google_service = new Google_Service_Oauth2($google_client);

  //Obtenha dados de perfil de usuário do google
  $data = $google_service->userinfo->get();

  //Abaixo você pode encontrar Obter dados de perfil e armazenar na variável $ _SESSION
  if(!empty($data['given_name']))
  {
   $_SESSION['user_first_name'] = $data['given_name'];
  }

  if(!empty($data['email']))
  {
   $_SESSION['user_email_address'] = $data['email'];
  }
  
  if(!empty($data['picture']))
  {
   $_SESSION['user_image'] = $data['picture'];
  }

 }
}

//Isso é para verificar se o usuário fez login no sistema usando a conta do Google, se o usuário não fizer login no sistema, ele executará o bloco de código e criará o código para exibir o link de login para fazer login usando a conta do Google.
if(!isset($_SESSION['access_token']))
{
	
 //Crie um URL para obter a autorização do usuário
 $login_button = '<a href="'.$google_client->createAuthUrl().'"><button><img src="Oauth2/botao_google.png" /></button></a>';

}
?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Trabalho Final</title>
		<meta content='width=device-width, initial-scale=1, maximum-scale=1' name='viewport'/>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script type="text/javascript" src="js/ajax.js"></script>
		<script type="text/javascript" src="js/scripts.js"></script>
		<link rel="stylesheet" type="text/css" href="css/style.css" />
	</head>
	<body>
		<br />
		<h1>TRABALHO FINAL</h1>
		<br />
		<div>

<?php
   if($login_button == '')
   {
	echo '<h2>Bem-Vindo '.$_SESSION['user_first_name'].' </h2>';
	echo'<form id="meuForm" action="http://localhost:8001/produtos/add" onsubmit="return validarForm()" method="POST">';
		echo'<h3>Formulário de Cadastro:</h3><br>';
			echo'Produto: <input type="text" placeholder="nome ou marca..." name="produto" id="txtProduto"><br>';
			echo'Preço: <input type="number" pattern="[0-9]+([,\.][0-9]+)?" min="0" step="any" placeholder="ex: 10, 5,5 ou 7.8" name="preco" id="txtPreco"><br>';
		echo'<input type="submit" value="Salvar"><br>';
	echo'</form>';
		echo' <a href="http://localhost:8001/produtos" target="_blank" id="tabela2">Listar Produtos API REST</a><br>';
		echo'<h4>Exibir tabela de Produtos com AJAX</h4><br>';
		echo'<button class="btn1">Ocultar/Mostrar</button>';
   	echo'<div id="trocar"><br>';
		echo'<table border="1" width="500">';
			echo'<thead>';
				echo'<tr>';
					echo'<th>ID</th>';
					echo'<th>Produto</th>';
					echo'<th>Preço</th>';
				echo'</tr>';
			echo'</thead>';
			echo'<tbody id="tabela">';
			echo'</tbody>';
		echo'</table>';
	echo'</div>';
	echo "<br><br><a title='sair' href='?off=true'>Sair</a>";
		$off = filter_input( INPUT_GET, "off", FILTER_VALIDATE_BOOLEAN );
		if($off){
			unset($_SESSION['access_token']);
			header( "Refresh: 0");
		}
		} else {
			echo '<p id="bola"></p>';
			echo '<br><br><hr><br><br><div align="center">'.$login_button.'</div>';
			echo'<br><br><hr><h3>Para continuar faça a autenticação Oauth2 do Google<h3>';
		}
?>
		</div>
	</body>
</html>