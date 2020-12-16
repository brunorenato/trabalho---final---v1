<?php

//config.php

//Incluir biblioteca cliente do Google para arquivo de carregamento automático de PHP
require_once 'vendor/autoload.php';

//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Faça objeto do cliente API do Google para chamar a API do Google
$google_client->setClientId('121673511036-lrg0pc8j9ohb54n198o287cipim7slbc.apps.googleusercontent.com');

//Defina a chave secreta do cliente OAuth 2.0
$google_client->setClientSecret('Tep-tTRUAi0fODRRzSMUnV7U');

//Defina o URI de redirecionamento OAuth 2.0
$google_client->setRedirectUri('http://localhost/Trabalho_Final/index.php');

//Define o escopo email
$google_client->addScope('email');

//Define o escopo perfil
$google_client->addScope('profile');

//Iniciar sessão na página da web
session_start();

?>